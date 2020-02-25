<?php

namespace App\Http\Controllers\content;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use app\solicitud;
use app\User;


class historyController extends Controller
{
      //construcctor
       public function __construct()
    {

        $this->middleware('auth');
    }

    public function viewHistory(Request $request){
    	$data = null;
  		   if( auth()->user()->perfil =='U'){
  		   	$data = DB::table('users')
            ->join('solicituds', 'users.registro', '=', 'solicituds.registroUser')
			->where('users.registro',auth()->user()->registro)
			->when($request->mes,function ($query,$mes) {
               return  $query->WhereMonth('solicituds.created_at',$mes);
			            
            })
            ->when($request->anio,function ($query,$anio) {
               return  $query->WhereYear('solicituds.created_at',$anio);
			            
            })
           	//->where('estado',$estado)
            ->select('users.p_nombre','users.p_apellido','users.s_nombre','users.s_apellido','users.registro','users.unidad_academica','users.titularidad','solicituds.id','solicituds.monto','solicituds.justificacion','solicituds.slug','solicituds.estado')
            ->paginate(20);
            //return $data
  		   }
  		   else{
  		   	$data = DB::table('users')
            ->join('solicituds', 'users.registro', '=', 'solicituds.registroUser')
			->when($request->registro,function ($query,$registro) {
               return  $query->Where("users.registro",'like','%'.$registro.'%');
            })
			->when($request->nombre,function ($query,$nombre) {
               return  $query ->Where("users.p_nombre",'like','%'.$nombre.'%')
			            ->orWhere("users.s_nombre",'like','%'.$nombre.'%')
			            ->orWhere("users.p_apellido",'like','%'.$nombre.'%')
			            ->orWhere("users.s_apellido",'like','%'.$nombre.'%');
            })
			->when($request->mes,function ($query,$mes) {
               return  $query->WhereMonth('solicituds.created_at',$mes);
			            
            })
            ->when($request->anio,function ($query,$anio) {
               return  $query->WhereYear('solicituds.created_at',$anio);
			            
            })
           	//->where('estado',$estado)
            ->select('users.p_nombre','users.p_apellido','users.s_nombre','users.s_apellido','users.registro','users.unidad_academica','users.titularidad','solicituds.id','solicituds.monto','solicituds.justificacion','solicituds.slug','solicituds.estado','solicituds.observacion')
            ->paginate(20);
            //return $data
  		    		# code...
  		    	} 	
    		;

            
    	   return view("dashboard.history",compact('data'));
    }

}
