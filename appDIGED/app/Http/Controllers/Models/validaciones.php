<?php
namespace App\Http\Controllers\Models;


use App\archivo;
use App\Http\Controllers\Controller;
use App\solicitud;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class validaciones
{
        //validaciones para  la  actulizacion de datos de usuario
    public static function validatesUser(Request $request)
    {
        $cotroller = new Controller(); 
        return  $cotroller->validate($request, [
            'p_nombre'         => 'required|string',
            's_nombre'         => 'nullable|string',
            'p_apellido'       => 'required|string',
            's_apellido'       => 'nullable|string',
            'nacionalidad'     => 'required|string',
            'dpi'              => 'required|numeric',
            'municipio'        => 'required|string',
            'edad'             => 'required|numeric',
            'estdo_civil'      => 'required|string',
            'profesion'        => 'required|string',
            'direccion'        => 'required|string',
            'correo'           => 'required|email',
            'nit'              => 'nullable|numeric',
            'n_telefono'       => 'nullable|numeric',
            'n_celular'        => 'nullable|numeric',
            //'registro'         => 'required|string',
            'unidad_academica' => 'required|string',
            'n_carne'          => 'required|numeric',
            'departamento'     => 'required|string',
            'cargo'            => 'required|string',
            'titularidad'      => 'required|string',

        ]);
    }

    //verificacione para el envio de nueva solicitud
    public static function validatesRequest(Request $request)
    {
        $cotroller = new Controller(); 
        return  $cotroller->validate($request, [
            'justificacion'     => 'nullable|string',
            'monto_letras'      => 'required|string',
            'monto'             => 'required|numeric',
            'tipo'              => 'required|string',
            'slug'              => 'required|string'
            
        ]);
    }


        //crea slug ramdom
    public static function newSlug($table){
        
        $exist = True;
         $slug ='';
         $response= 0;

        while ($exist){
            $slug= Str::random(20);

            switch ($table) {
            case 'file':
                  $response= archivo::where('slug',$slug)->count();
                 break;
            case 'request':
                # code...
               $response= solicitud::where('slug',$slug)->count();
                
                break;
            
            default:
                # code...
               $response= user::where('slug',$slug)->count();
                
                break;
            }

        if ($response == 0){
                    
                $exist = False;
                }

        }        
       
        return $slug;
    }
     
}
