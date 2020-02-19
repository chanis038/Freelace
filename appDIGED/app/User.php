<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    protected $primaryKey = 'registro';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
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

    //valores por defecto al crear un usuario 
protected $attributes  = [
        'p_nombre' => "Usuario",
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
}
