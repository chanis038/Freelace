<?php

namespace App\Http\Controllers\content;

use App\archivo;
use App\Http\Controllers\Controller;
use App\solicitud;
use App\Http\Controllers\Models\Forms;
use App\Http\Controllers\Models\validaciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use iio\libmergepdf\Merger;



class fileController extends Controller
{
    //
     public function __construct()
    {
        $this->middleware('auth');
    }


    //funcion para enviar el archivo y pueda ser visto en el navegador
    public function viewdFileDeal($slug)
    {
        $data = solicitud::getRequestUser($slug);
        //return $data;
    	return view('dashboard.createDeal',compact('data'));
    }


    //funcion para crear el archivo de Acuerdo
    public function createDealFile(Request $request)
    {
        try{

        $data = Solicitud::getRequestUser($request->slug);
        Forms::FileDeal($request, $data);

        $Mrequest= Solicitud::findSlug($request->slug);
        $Mrequest->estado="AA";
        $Mrequest->save();

        $newfile = new archivo;
        $newfile->nombre= '03_Acuerdo_SEA'.$data[0]->id;
        $newfile->tipo= ".pdf";
        $newfile->ruta= $data[0]->registro."/". $request->slug.'/';
        $newfile->slug= validaciones::newSlug('file');
        $Mrequest->archivo()->save($newfile);
        fileController::creaArchivoUnificado($request->slug,true); 

        
        $response=1; 
        $result=" Solicitud Actulizada Correctametne"; 
        }
        catch(exeception $e){

        }
       // return $data;
        return redirect()->route('viewRequest',$request->slug)->with(['response'=>$response,'result'=>$result]);
    }


       //funcion para cargar archivos
    public function loadFiles(Request $request){

        $slug = $request->slug;
        $files = $request->file("file");

        // se recorre el arry de archivos
       foreach($files as $file) {
            
            #se obtiene el nombre y se guarda 
            $name= $file->getClientOriginalName();
            Storage::disk('files')->putFileAs(auth()->user()->registro."/".$slug."/", $file, $name);
            
        }
        
        return "success";
         
    }



     //funcion para eliminar archivos
    public function deleteFiles(Request $request){
        $dirDs = auth()->user()->registro."/".$request->slug."/".$request->name;
        
        //verificaion si existen en el disco
        return fileController::deleFileDisk($dirDs); 

        }


    //funcion para eliminar archivos de un solicitud que esta siendo modificada
    public function deleteFilesM(Request $request){
        $dirDs = auth()->user()->registro."/".$request->slug."/".$request->name;

        //se elimina de BD
         archivo::deletefile($request->slugFile) ;
        
        //se manda a llamar la funcio para eliminar el archivo del disco
        return fileController::deleFileDisk($dirDs) ;        
        }


     //descarga archivos.
    public function downloadFile($slug, $todo = 0)
     {
    	$dirDs1; //ruta para descarga de archivos
    		// 1 para descarga completa.
    	if ($todo == 1){
    		
			$dirDs1=fileController::creaArchivoUnificado($slug);			
  
    	}else{

    		// ruta para descarga de archivo simple
    		$archivo = archivo::findSlug($slug);
			$dirDs1 = $archivo->ruta.$archivo->nombre.$archivo->tipo;
    	}
    	
    	// descarga de archivo unificado
    	$exists = Storage::disk('files')->exists($dirDs1);
				if($exists){
					return Storage::disk('files')->download($dirDs1);
				}
				else{
					return 'dont found';
				}
    }


    //funcion para elimiar archivo del disco.
    public static function deleFileDisk($dirDisk){

        $exists = Storage::disk('files')->exists($dirDisk);
                if($exists){
                    //se borra del disco
                   Storage::disk('files')->delete( $dirDisk);
                    return "success";
                }
                else{
                    return 'dont found';
                }  
    }

    ///funcion para crear el archivo pdf unificado con los archivo subidos 
    public static function creaArchivoUnificado($slug,$update = false){
        try{
            $archivos = archivo::findSlugSolucitud($slug);
            $dirDs1 = $archivos[0]->ruta.'SAE_'.$archivos[0]->id.'.pdf'; //ruta de descarga
            
            //se verifica si existe el archivo
            $exists = Storage::disk('files')->exists($dirDs1);
           
            //solo se crea un nuevo archivo 
            if((!$exists) || $update){
                $rutas=array();
                $temps=array();
                $x=0;
                $tmp=0;

                //cracion de array para rutas de archivos pdfs
                foreach ($archivos as $archivo) {
                    if($archivo->tipo==".pdf"){
                        $rutas[$x]= public_path().'/Solicitudes/'.$archivo->ruta.$archivo->nombre.$archivo->tipo;

                    }
                    else{

                        //si no es pfd se crea el nuevo archivo pdf temporal
                       $creatPdf = new Forms();
                       $creatPdf->ImagePDF($archivo->ruta,$archivo->nombre,$archivo->tipo);
                       $rutas[$x]= public_path().'/Solicitudes/'.$archivo->ruta.$archivo->nombre.'.pdf';
                       $temps[$tmp]= $archivo->ruta.$archivo->nombre.'.pdf';
                       $tmp+=1;
                        
                    }
                    $x +=1; 
                }
 
                $dirDs2 = public_path().'/Solicitudes/'.$dirDs1;

                // creacion de archivo PDF Unificado
                $merger = new Merger;
                $merger->addIterator($rutas);
                $newPdf = $merger->merge();
                file_put_contents($dirDs2, $newPdf);

                //se eliminan los pdf temporales
                foreach ($temps as $temp) {
                    archivo::deleFileDisk($temp);    
                }

                } 
            
                return  $dirDs1;
            }

        catch(exeception $e){

            return "error";
        }
    }


}
