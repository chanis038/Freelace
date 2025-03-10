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
   
    // funcion que envia la vista de crear solicitud
    public function viewCreateRequest()
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

    //funcion para la vista de modificaion 
    public function viewModifyRequest($slug){

        $datarequest  = solicitud::getFilesRquest($slug);
        //return $solicitud;
        return view('dashboard/modifyRequest',compact('datarequest'));
    }


    //funcion para guardar la solicitud creada
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
        $forms->createForm1($request,$dir.'001_FormAEUSAC.pdf');
        CreateRController::insertFile($newrequest,"001_FormAEUSAC.pdf",$request->slug);
        
        $forms->createForm2($request,$dir.'002_FormAEUSAC.pdf');
        CreateRController::insertFile($newrequest,"002_FormAEUSAC.pdf",$request->slug);       

         if ($handler = opendir($dir)) {
         while (false !== ($file = readdir($handler))) {
            if(!($file== '.' || $file=='..'||$file== '001_FormAEUSAC.pdf' || $file=='002_FormAEUSAC.pdf')){
                ////crea y inserta un nuevp archivo
                    CreateRController::insertFile($newrequest,$file,$request->slug);
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


    //funcion que envia  la vista de ver solicitud
    public function modifyRequest(Request $request)
    {
    validaciones::validatesRequest($request);

    $result;

    try{
        $dir = public_path().'/Solicitudes/'.auth()->user()->registro."/". $request->slug.'/';
        $dirDisk= auth()->user()->registro."/". $request->slug.'/';
        //obtiene la solicitud y coloca los nuevos valore
        $updaerequest = solicitud::findSlug($request->slug);
        if($updaerequest->estado!="EN"){
            return redirect()->route('dashboard')->with(['result'=>'error']);

        }

        $updaerequest->tipo = $request->tipo;
        $updaerequest->monto = $request->monto;
        $updaerequest->monto_letras = $request->monto_letras;
        $updaerequest->justificacion = $request->justificacion;
        $updaerequest->save();
     
        //crea los archivos de formularios para la solicitud
        $forms = new Forms();
        $forms->createForm1($request,$dir.'001_FormAEUSAC.pdf');
        $forms->createForm2($request,$dir.'002_FormAEUSAC.pdf');
        //se elimina el archivo unificado si existe. para luego mandarlo a rehacer
        fileController::deleFileDisk($dirDisk.'SAE_'.$updaerequest->id.'.pdf');
            
         if ($handler = opendir($dir)) {
            while (false !== ($file = readdir($handler))) {
                if(!($file== '.' || $file=='..')){
                    $nombre =substr($file,0,strrpos($file,'.'));

                        //se varifica y ya existia el archivo en la BD
                    $exist= archivo::fileExist($updaerequest->id,$nombre);
                    if($exist==0){

                    //crea y inserta un nuevp archivo   
                        CreateRController::insertFile($updaerequest,$file,$request->slug);
                        $changefile=true;
                    }
               
                } 

            }
            closedir($handler);
        }

            //se crea eñ archivo unificado con los cambios
            fileController::creaArchivoUnificado($request->slug,true);
            //envia correo de Modidificaion 
           // mailController::sendMail($updaerequest,7);
            
        $result = "succesM";
    }

    catch (exception $e){

        $result = $e;

    }
 
        return redirect()->route('dashboard')->with(['result'=>$result]);
}


    public static function insertFile(solicitud $solicitud, $file,$slug){

            $newfile = new archivo;
            $newfile->nombre=substr($file,0,strrpos($file,'.'));
            $newfile->tipo=substr($file,strrpos($file,'.')-strlen($file));
            $newfile->ruta= auth()->user()->registro."/". $slug.'/';
            $newfile->slug= validaciones::newSlug('file');
            $solicitud->archivo()->save($newfile);
    }   


    //funcion para el cambio de estado
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
                    $result=" !Solicitud actualizada correctamente, se ha notificado al catedrático!";
                 break;
            case 'AP':
                     $change="AT";
                     $tipe=3;
                     $result=" !Solicitud actualizada correctamente, se ha notificado al catedrático!";
                 break;
            case 'NA':
                     $change="NA";
                     $tipe=4;
                     $result=" !Solicitud actualizada correctamente, se ha notificado al catedrático!";
                 break;
            case 'AT':
                    $change="AA";
                    $sendmail =false;
                    $result=" !Solicitud actualizada correctamente!";
                 break;
            case 'AA':
                    $change="ET"; 
                    $tipe=5; 
                    $result=" !Solicitud actualizada correctamente, se ha notificado al catedrático y a tesorería!";  
                 break;
            case 'ET':
                    $change="LT";
                    $tipe=6;
                    $result=" !Solicitud actualizada correctamente, se ha notificado al catedrático!"; 
                 break;
            case 'LT':
                    $change="EG";
                    $sendmail =false;
                    $result=" !Solicitud actualizada correctamente!"; 

                 break;
   
             default:
                 $change="EG";
                  $sendmail =false;
                 break;
         }
         try{
            // se acutiliza el estado de la solicitud
         $Mrequest= Solicitud::findSlug($request->slug);
         $Mrequest->estado=$change;
         $Mrequest->save();

         //se verifica si hay que enviar eamil
         if($sendmail){
            mailController::sendMail($Mrequest,$tipe);
         }
          $response=1; 
          ; 
         }
         catch(Exception $e) {
             $result=" !Error al intentar cambiar de estado la solicitud!"; 
         }

        return back()->with(['response'=>$response,'result'=>$result]);

    }


    public function addComment(Request $request){
        //se agrega el comentario a la solicitud
        $solicitud = solicitud::findSlug($request->slug);
        $solicitud->observacion = $request->comment;
        $solicitud->save();

        return 'succes';
    }
    
}



