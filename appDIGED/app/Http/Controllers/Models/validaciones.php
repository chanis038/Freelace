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
           'p_nombre'         =>'required|string',
           's_nombre'         =>'nullable|string',
           'p_apellido'       =>'required|string',
           's_apellido'       =>'nullable|string',
           'nacionalidad'     =>'required|string',
           'dpi'              =>'required|numeric',
           'municipio'        =>'required|string',
           'edad'             =>'required|numeric',
           'estdo_civil'      =>'required|string',
           'profesion'        =>'required|string',
           'direccion'        =>'required|string',
           'correo'           =>'required|email',
           'nit'              =>'nullable|numeric',
           'n_telefono'       =>'nullable|numeric',
           'n_celular'        =>'nullable|numeric',
            //'registro'         =>'required|string',
           'unidad_academica' =>'required|string',
           'n_carne'          =>'nullable|numeric',
           'departamento'     =>'required|string',
           'cargo'            =>'required|string',
           'titularidad'      =>'required|string',
           'catedras'         => 'required|string',

        ]);
    }

     public static function validates(Request $request)
    {
        $cotroller = new Controller(); 
        return  $cotroller->validate($request, [
           'p_nombre'         =>'required|string',
           's_nombre'         =>'nullable|string',
           'p_apellido'       =>'nullable|string',
           's_apellido'       =>'nullable|string',
           'nacionalidad'     =>'nullable|string',
           'dpi'              =>'nullable|numeric',
           'municipio'        =>'nullable|string',
           'edad'             =>'nullable|numeric',
           'estdo_civil'      =>'nullable|string',
           'profesion'        =>'nullable|string',
           'direccion'        =>'nullable|string',
           'correo'           =>'required|email',
           'nit'              =>'nullable|numeric',
           'n_telefono'       =>'nullable|numeric',
           'n_celular'        =>'nullable|numeric',
            //'registro'         =>'nullable|string',
           'unidad_academica' =>'nullable|string',
           'n_carne'          =>'nullable|numeric',
           'departamento'     =>'nullable|string',
           'cargo'            =>'nullable|string',
           'titularidad'      =>'nullable|string',
           'catedras'         => 'nullable|string',

        ]);
    }

    //verificacione para el envio de nueva solicitud
    public static function validatesRequest(Request $request)
    {
        $cotroller = new Controller(); 
        return  $cotroller->validate($request, [
           'justificacion'     =>'nullable|string',
           'monto_letras'      =>'required|string',
           'monto'             =>'required|numeric',
           'tipo'              =>'required|string',
           'slug'              =>'required|string'
            
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
            case'file':
                  $response= archivo::where('slug',$slug)->count();
                 break;
            case'request':
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

    public static function informantioncomplete(){
        $resultado="";

        if(auth()->user()->p_nombre ==""){
            $resultado=' nombre,' ;
        }       
        if(auth()->user()->p_apellido ==""){
            $resultado= $resultado.' apellido,' ;
        }                  
        if(auth()->user()->nacionalidad ==""){
            $resultado= $resultado.' nacionalidad,' ;
        }            
        if(auth()->user()->dpi ==""){
            $resultado= $resultado.' DPI,' ;
        }                    
        if(auth()->user()->municipio ==""){
            $resultado= $resultado.' municipio,' ;
        }               
        if(auth()->user()->edad ==""){
            $resultado= $resultado.' edad,' ;
        }                   
        if(auth()->user()->estdo_civil ==""){
            $resultado= $resultado.' estado civil,' ;
        }             
        if(auth()->user()->profesion ==""){
            $resultado= $resultado.' profesión,' ;
        }               
        if(auth()->user()->direccion ==""){
            $resultado= $resultado.' dirección,' ;
        }               
        if(auth()->user()->correo ==""){
            $resultado= $resultado.' correo electronico,' ;
        }                  
        /*if(auth()->user()->nit ==""){
            $resultado= $resultado.'Nombre,' ;
        }*/                     
        if(auth()->user()->n_telefono =="" && auth()->user()->n_celular ==""){
            $resultado= $resultado.'tiene que llenar el campo teléfono o celular,' ;
        }              
                              
        if(auth()->user()->unidad_academica ==""){
            $resultado= $resultado.' unidad académica' ;
        }        
        if(auth()->user()->n_carne ==""){
            $resultado= $resultado.' carné,' ;
        }                
        if(auth()->user()->departamento ==""){
            $resultado= $resultado.' departamento en que labora,' ;
        }            
        if(auth()->user()->cargo ==""){
            $resultado= $resultado.' cargo que ocupa,';
        }                   
        if(auth()->user()->titularidad ==""){
            $resultado= $resultado.' titularidad,' ;
        }             
        if(auth()->user()->catedras ==""){
            $resultado= $resultado.' cátedras que imparte';
        }  

        return $resultado;      

    }
     
}
