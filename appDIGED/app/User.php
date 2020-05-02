<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class User extends Authenticatable
{
    use Notifiable;
    protected $primaryKey = 'registro';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
   /* protected $fillable = [
        'p_nombre',
        's_nombre',
        'p_apellido',
        's_apellido',
        'edad',
        'estdo_civil',
        'nacionalidad',
        'profesion',
        'direccion',
        'nit',
        'correo',
        'dpi',
        'municipio',
        'n_telefono',
        'n_celular',
        'unidad_academica',
        'n_carne',
        'departamento',
        'cargo',
        'slug',
        'password',
        'perfil',
        'catedras',
    ];
*/
    //valores por defecto al crear un usuario 
protected $attributes  = [
        'p_nombre' => null,
        's_nombre' => null,
        'p_apellido' => null,
        's_apellido'=> null,
        'edad'=> null,
        'estdo_civil'=> null,
        'nacionalidad'=> null,
        'profesion'=> null,
        'direccion'=>   null,
        'nit'=> null,
        'correo'=> null,
        'dpi'=> null,
        'municipio' => "Guatemala",
        'n_telefono' => null,
        'n_celular' => null,
        'unidad_academica' => null,
        'n_carne'=> null,
        'departamento' => null,
        'cargo'=> null,
        'password'=> null,
        'perfil'=> "U",
        'catedras'=>null,
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'slug','nit','dpi','n_telefono','n_celular','registro','perfil','carga','id'

    ];

    
   
    //funcion para manejar el modelo relacional
    public function solicitud(){
       return  $this->hasMany('App\solicitud','registrouser','registro');
    }

   /* //query scopes
     //query Scopes
    public function scopeRegistro($query, $registro){
            return $query->where("registro",'like','%'.$registro.'%');
    }
     //query Scopes
    public function scopeNombre($query, $nombre){
        return $query->where("p_nombre",'like','%'.$nombre.'%')
                    ->orWhere("s_nombre",'like','%'.$nombre.'%')
                    ->orWhere("p_apellido",'like','%'.$nombre.'%')
                    ->orWhere("s_apellido",'like','%'.$nombre.'%');
    }*/

    //  QUERYS PARA OBTENER INFORMACION
    public static function getRevisores(){
        return  User::where('perfil','R')
                    ->select('correo')
                     ->get();
    }

    public static function getTesoreros(){
        return  User::where('perfil','T')
                    ->select('correo')
                     ->get();
    }

    public static function gethistory(Request $request){

        $tesorero = $request->perfil == "T";
        try{
        if( auth()->user()->perfil =='U'){
            return  DB::table('users')
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
             return DB::table('users')
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
            ->when($tesorero,function ($query,$perfil) {
               return  $query->whereIn('estado',['ET','LT','EG']);          
            })
            ->select('users.p_nombre','users.p_apellido','users.s_nombre','users.s_apellido','users.registro','users.unidad_academica','users.titularidad','solicituds.id','solicituds.monto','solicituds.justificacion','solicituds.slug','solicituds.estado','solicituds.observacion')
            ->paginate(20);
            //return $data
                    # code...
                } 
            }
            catch(exception $e){
                 return [];
            }    
    }
}
