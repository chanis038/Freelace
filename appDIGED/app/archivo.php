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

    	$archivo = archivo::select('nombre','tipo','formato')
    						->where('slug',$slug)
    						->first();
    		return $archivo;
    }



    // QUERYS .. PARA OBTENER INFORMACION 
    public static function findSlugSolucitud($slug){

    	$archivos = DB::table('archivos')
	            ->join('solicituds', 'archivos.idsolicitud', '=', 'solicituds.id')
	            ->where('solicituds.slug',$slug)
	            ->select('solicituds.id','solicituds.estado','archivos.nombre', 'archivos.formato','archivos.tipo')
	            ->get();

    		return $archivos;
    }
    
}
