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

      public function createDealFile(Request $request)
    {
        try{

        $data = Solicitud::getRequestUser($request->slug);
        Forms::FileDeal($request, $data);

        $Mrequest= Solicitud::findSlug($request->slug);
        $Mrequest->estado="AA";
        $Mrequest->save();

        $newfile = new archivo;
        $newfile->nombre= 'Acuerdo_'.$data[0]->id;
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

    public static function creaArchivoUnificado($slug,$update = false){

            $archivos = archivo::findSlugSolucitud($slug);
            $dirDs1 = $archivos[0]->ruta.'SAE_'.$archivos[0]->id.'.pdf'; //ruta de descarga
            
            //se verifica si existe el archivo
            $exists = Storage::disk('files')->exists($dirDs1);
           
            //solo se crea un nuevo archivo 
            if((!$exists) || $update){
                $rutas=array();
                $x=0;

                //cracion de array para rutas de archivos pdfs
                foreach ($archivos as $archivo) {
                    if($archivo->tipo==".pdf"){
                        $rutas[$x]= public_path().'/Solicitudes/'.$archivo->ruta.$archivo->nombre.$archivo->tipo;
                    }
                    else{

                        //si no es pfd se crea el nuevo archivo pdf
                       $creatPdf = new Forms();
                       $creatPdf->ImagePDF($archivo->ruta,$archivo->nombre,$archivo->tipo);
                       $rutas[$x]= public_path().'/Solicitudes/'.$archivo->ruta.$archivo->nombre.'.pdf';
                        
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
