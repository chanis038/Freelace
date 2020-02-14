<?php

namespace App\Http\Controllers\content;

use App\archivo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Models\Forms;
use iio\libmergepdf\Merger;



class fileController extends Controller
{
    //
     public function __construct()
    {
        $this->middleware('auth');
    }


    //funcion para enviar el archivo y pueda ser visto en el navegador
    public function viewFile($slug)
    {
    	
 
    	return  ;
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

        $slug = $request->slug;
        $name = $request->name;
        $dirDs1 = auth()->user()->registro."/".$slug."/".$name;
        // se recorre el arry de archivos

        $exists = Storage::disk('files')->exists($dirDs1);
                if($exists){
                   Storage::disk('files')->delete( $dirDs1);
                    return "success";
                }
                else{
                    return 'dont found';
                }

        }


     //descarga archivos.
     public function downloadFile($slug, $todo = 0)
     {
    	$dirDs1; //ruta para descarga de archivos

    		// 1 para descarga completa.
    	if ($todo == 1){
    		
			$dirDs1=	fileController::creaArchivoUnificado($slug);				
  
    	}else{

    		// ruta para descarga de archivo simple
    		$archivo = archivo::findSlug($slug);
			$dirDs1 = $archivo->formato.$archivo->nombre.$archivo->tipo;
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

    public static function creaArchivoUnificado($slug,$update = false){

            $archivos = archivo::findSlugSolucitud($slug);
            $dirDs1 = $archivos[0]->formato.'SAE_'.$archivos[0]->id.'.pdf'; //ruta de descarga
            
            //se verifica si existe el archivo
            $exists = Storage::disk('files')->exists($dirDs1);
           
            //solo se crea un nuevo archivo 
            if((!$exists) || $update){
                $rutas=array();
                $x=0;

                //cracion de array para rutas de archivos pdfs
                foreach ($archivos as $archivo) {
                    if($archivo->tipo==".pdf"){
                        $rutas[$x]= public_path().'/Solicitudes/'.$archivo->formato.$archivo->nombre.$archivo->tipo;
                    }
                    else{

                        //si no es pfd se crea el nuevo archivo pdf
                       $creatPdf = new Forms();
                       $creatPdf->ImagePDF($archivo->formato,$archivo->nombre,$archivo->tipo);
                       $rutas[$x]= public_path().'/Solicitudes/'.$archivo->formato.$archivo->nombre.'.pdf';
                        
                    }
                    $x +=1; 
                }
 
                $dirDs2 = public_path().'/Solicitudes/'.$dirDs1;

                // creacion de archivo PDF Unificado
                $merger = new Merger;
                $merger->addIterator($rutas);
                $newPdf = $merger->merge();
                file_put_contents($dirDs2, $newPdf);
                } 
            
                
                  return $dirDs1 ;
    }


}
