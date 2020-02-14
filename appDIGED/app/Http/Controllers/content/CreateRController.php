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
        $slug = validaciones::newSlug('request');
        return view('dashboard/createRequest',compact('slug'));
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
                $newfile->formato= auth()->user()->registro."/". $request->slug.'/';
                $newfile->slug= validaciones::newSlug('file');
                $newrequest->archivo()->save($newfile); 
            } 
        }
        closedir($handler);
        }

//
        $result = "succes";
        }

        catch (exception $e){

         $result = $e;

        }
 
        return redirect()->route('dashboard')->with(['result'=>$result]);
    }

    
}



