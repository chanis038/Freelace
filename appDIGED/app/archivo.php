<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class archivo extends Model
{
    //  // funciones para manejar el modelo relacional

    public function solicitud(){
       return  $this->hasOne('App\solicitud','idsolicitud','id');
    }


    
    public static function findSlug($slug){

    	$archivo = archivo::select('nombre','tipo','ruta')
    						->where('slug',$slug)
    						->first();
    		return $archivo;
    }

    public static function deletefile($slug){
         $archivo = archivo::where('slug', $slug)
                            ->delete();
        return $archivo;
    }

    public static function fileExist($idsolicitud,$nombre){
        $exits = archivo::where('idsolicitud', $idsolicitud)
                            ->where('nombre',$nombre)
                            ->count();
        return $exits;
    }

    // QUERYS .. PARA OBTENER INFORMACION 
    public static function findSlugSolucitud($slug){

    	$archivos = DB::table('archivos')
	            ->join('solicituds', 'archivos.idsolicitud', '=', 'solicituds.id')
	            ->where('solicituds.slug',$slug)
	            ->select('solicituds.id','solicituds.estado','archivos.nombre', 'archivos.ruta','archivos.tipo')
	            ->get();

    		return $archivos;
    }
    
}
