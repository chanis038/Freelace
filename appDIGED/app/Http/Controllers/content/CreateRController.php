<?php

namespace App\Http\Controllers\content;

use App\archivo;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Models\Forms;
use App\Http\Controllers\Models\validaciones;
use App\solicitud;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\content\fileController;
use App\Http\Controllers\Mail\mailController;


class CreateRController extends Controller
{
    //construcctor
       public function __construct()
    {

        $this->middleware('auth');
    }

   
    // funcion que envia la vista de crear solicitud
    public function createR()
    {
        $resultado  = validaciones::informantioncomplete();
        if($resultado==""){
            $slug = validaciones::newSlug('request');
        return view('dashboard/createRequest',compact('slug'));
        }
        else{

        return redirect()->route('personalinf')->with(['response'=>'2','txt'=>$resultado]); 
        }
        
        
        
    }

    //funcion que envia  la vista de ver solicitud
    public function viewRequest($slug){
     
            $data = solicitud::getInfSolicitud($slug);
            //return $data;
           return view('dashboard/viewrquest',compact('data'));

    }

    //vista auxiliar para moviles  muestra la soliciutd en PDF
      public function viewRequestM($slug){
     
            $data = solicitud::getInfSolicitud($slug);
                    fileController::creaArchivoUnificado($slug);
            //return $data;
            return view('dashboard/viewrquestM',compact('data'));

        }


    //funcion que envia  la vista de ver solicitud
    public function saveRequest(Request $request)
    {
        validaciones::validatesRequest($request);

        $result;
        try{

        $user= User::find(auth()->user()->registro);
        $dir = public_path().'/Solicitudes/'.auth()->user()->registro."/". $request->slug.'/';

        //crea y inserta una nueva solicitud
        $newrequest = new solicitud;
        $newrequest->tipo = $request->tipo;
        $newrequest->monto = $request->monto;
        $newrequest->monto_letras = $request->monto_letras;
        $newrequest->justificacion = $request->justificacion;
        $newrequest->slug = $request->slug;
        $user->solicitud()->save($newrequest);  
        
        //crea los archivos de formularios para la solicitud
        $forms = new Forms();
        $forms->createForm1($request,$dir.'01_FormAEUSAC.pdf');
        $forms->createForm2($request,$dir.'02_FormAEUSAC.pdf');
       

         if ($handler = opendir($dir)) {
         while (false !== ($file = readdir($handler))) {
            if(!($file== '.' || $file=='..')){
                ////crea y inserta un nuevp archivo
                $newfile = new archivo;
                $newfile->nombre=substr($file,0,strrpos($file,'.'));
                $newfile->tipo=substr($file,strrpos($file,'.')-strlen($file));
                $newfile->ruta= auth()->user()->registro."/". $request->slug.'/';
                $newfile->slug= validaciones::newSlug('file');
                $newrequest->archivo()->save($newfile); 
            } 

        }

        closedir($handler);

        }

        mailController::sendMail($newrequest,1);
//       
        $result = "succes";
        }

        catch (exception $e){

         $result = $e;

        }
 
        return redirect()->route('dashboard')->with(['result'=>$result]);
    }

    public function changeState(Request $request){
         $change="";
         $sendmail= true;
         $tipe=1;
         $response=0;
         $result="";

         switch ($request->estado) {
             case 'EN':
                    $change="AP";
                    $tipe=2;

                 break;
            case 'AP':
                     $change="AT";
                     $tipe=3;
                 break;
            case 'NA':
                     $change="NA";
                     $tipe=4;
                 break;
            case 'AT':
                    $change="AA";
                    $sendmail =false;
                 break;
            case 'AA':
                    $change="ET"; 
                    $tipe=5;   
                 break;
            case 'ET':
                    $change="LT";
                    $tipe=6;
                 break;
            case 'LT':
                    $change="EG";
                    $sendmail =false;
                 break;
   
             default:
                 $change="EG";
                  $sendmail =false;
                 break;
         }
         try{
         $Mrequest= Solicitud::findSlug($request->slug);
         $Mrequest->estado=$change;
         $Mrequest->save();

         if($sendmail){
            mailController::sendMail($Mrequest,$tipe);
         }
          $response=1; 
          $result=" Solicitud Actulizada Correctametne"; 
         }
         catch(Exception $e) {

         }

        return back()->with(['response'=>$response,'result'=>$result]);

    }
    
}



