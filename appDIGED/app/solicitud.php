<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class solicitud extends Model
{
    //valores por defecto al crear una solicitud
    

        
    protected $attributes  = [
        
        'estado' => "EN",
        'visto' => 0,
        'visto_user' => 0,
        'observacion'=> null,
    ];
        
    // funciones para manejar el modelo relacional
    public function user(){
       return  $this->belongsTo('App\User','registrouser','registro');
    }

    public function archivo(){
       return  $this->hasMany('App\archivo','idsolicitud','id');
    }
    
    // devuelve el objeto modelo de la solcitud con el slug ingresado.
    public static function findSlug($slug){
        $mSolicitud = solicitud::where('slug',$slug)
                    ->first();
                
         return $mSolicitud;
    }

     public static function getFilesRquest($slug){
        $solicitud = solicitud::where('slug',$slug)
                    ->with(['archivo'=>function ($query) {
                            $query->where('nombre', 'Not like', '%FormAEUSAC%')
                                    ->where('nombre', 'Not like', '%ACUERDO_SAE%');
                                    //->select('nombre','tipo','slug','ruta')
                                    //->get();
                            }])
                    ->get();
                
         return $solicitud;
    }


    // QUERYS .. PARA OBTENER INFORMACION 
   public static function getOwnerUser($slug){
        $correo = DB::table('solicituds')
                ->join('users', 'users.registro', '=', 'solicituds.registroUser')
                ->where('solicituds.slug',$slug)
                ->select('users.correo','users.p_nombre','users.p_apellido')
                ->get();
         return $correo;
    }

       public static function getRequestUser($slug){
        $data = DB::table('solicituds')
                ->join('users', 'users.registro', '=', 'solicituds.registroUser')
                ->where('solicituds.slug',$slug)
                ->select('users.p_nombre','users.p_apellido','users.s_nombre','users.s_apellido','users.dpi','users.registro','users.unidad_academica','solicituds.id','solicituds.monto','solicituds.monto_letras','solicituds.justificacion','solicituds.slug')
                ->get();
        return $data;
    }

	public static function getInfSolicitud($slug){
		$data = DB::table('solicituds')
	            ->join('users', 'users.registro', '=', 'solicituds.registroUser')
	            ->join('archivos', 'archivos.idsolicitud', '=', 'solicituds.id')
	            ->where('solicituds.slug',$slug)
	            ->select('users.p_nombre','users.p_apellido','users.unidad_academica', 'users.catedras','solicituds.slug','solicituds.id','solicituds.tipo','solicituds.estado','solicituds.monto','archivos.nombre', 'archivos.ruta',DB::raw('archivos.slug slugA ,archivos.tipo as tipoA, DATE(solicituds.created_at) as created_at'))
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
    		->whereIn('estado',['EN','AP','AT','AA'])
        	->orderBy('created_at', 'desc')
        	->get();
        	
    	}
    	elseif(auth()->user()->perfil == 'D'){
    		$data = solicitud::select('id','tipo','estado','slug','visto','created_at')
    		->whereIn('estado',['AP'])
        	->orderBy('created_at', 'desc')
        	->get();
    	}
    	elseif(auth()->user()->perfil == 'T'){
    		$data = solicitud::select('id','tipo','estado','slug','visto','created_at')
    		->whereIn('estado',['ET','LT'])
        	->orderBy('created_at', 'desc')
        	->get();
    	}
        elseif(auth()->user()->perfil == 'K'){
            $data = solicitud::select('id','tipo','estado','slug','visto','created_at')
            ->orderBy('created_at', 'desc')
            ->limit(20)
            ->get();
        }

    	return $data;
	}
     
}
