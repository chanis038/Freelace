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
        'registro',
        'unidad_academica',
        'n_carne',
        'departamento',
        'cargo',
        'slug',
        'password',
        'perfil',
    ];

    //valores por defecto al crear un usuario 
protected $attributes  = [
        'p_nombre' => "none",
        's_nombre' => "none",
        'p_apellido' => "none",
        's_apellido'=> "none",
        'edad'=> "none",
        'estdo_civil'=> "none",
        'nacionalidad'=> "none",
        'profesion'=> "none",
        'direccion'=> "none",
        'nit'=> "",
        'correo'=> "correo@none.com",
        'dpi'=> "",
        'municipio' => "Gutemala",
        'n_telefono' => "",
        'n_celular' => "none",
        'registro',
        'unidad_academica' => "none",
        'n_carne'=> "",
        'departamento' => "none",
        'cargo'=> "none",
        'password'=> "",
        'perfil'=> "U",
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'slug','nit','dpi','n_telefono','n_celular','registro','perfil','carga','id'

    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //funcion para manejar el modelo relacional
    public function solicitud(){
       return  $this->hasMany('App\solicitud','registrouser','registro');
    }
}
