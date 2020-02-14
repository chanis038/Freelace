<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class solicitud extends Model
{
    //valores por defecto al crear una solicitud
    protected $attributes  = [
        
        'estado' => "E",
        'visto' => 0,
        'visto_user' => 0,
    ];
        
    // funciones para manejar el modelo relacional
    public function user(){
       return  $this->belongsTo('App\User','registrouser','registro');
    }

    public function archivo(){
       return  $this->hasMany('App\archivo','idsolicitud','id');
    }


    // QUERYS .. PARA OBTENER INFORMACION 
	public static function getInfSolicitud($slug){
		$data = DB::table('solicituds')
	            ->join('users', 'users.registro', '=', 'solicituds.registroUser')
	            ->join('archivos', 'archivos.idsolicitud', '=', 'solicituds.id')
	            ->where('solicituds.slug',$slug)
	            ->select('users.p_nombre','users.p_apellido','users.registro','solicituds.slug','solicituds.id','solicituds.tipo','solicituds.estado','solicituds.created_at','solicituds.monto','archivos.nombre', 'archivos.formato',DB::raw('archivos.slug slugA ,archivos.tipo as tipoA'))
	            ->get();

	     return $data;
	}

	public static function  getSolicitudes(){
    	$data;

    	if(auth()->user()->perfil == 'U'){
    	    $data = solicitud::select('id','tipo','estado','slug','visto','created_at')
    		->where('registrouser',auth()->user()->registro)
        	->orderBy('created_at', 'desc')
        	->limit(5)
        	->get();
    	}
    	elseif(auth()->user()->perfil == 'R'){
    		$data = solicitud::select('id','tipo','estado','slug','visto','created_at')
    		->whereIn('estado',['E','A','AT'])
        	->orderBy('created_at', 'desc')
        	->limit(10)
        	->get();
        	
    	}
    	elseif(auth()->user()->perfil == 'D'){
    		$data = solicitud::select('id','tipo','estado','slug','visto','created_at')
    		->whereIn('estado',['A'])
        	->orderBy('created_at', 'desc')
        	->limit(10)
        	->get();
    	}
    	elseif(auth()->user()->perfil == 'T'){
    		$data = solicitud::select('id','tipo','estado','slug','visto','created_at')
    		->whereIn('estado',['AT'])
        	->orderBy('created_at', 'desc')
        	->limit(10)
        	->get();
    	}

    	return $data;
	}
     
}
