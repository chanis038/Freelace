<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use App\User;
use lawiet\src\NuSoapClient;

class authController extends Controller
{
    //contructor
    public function __construct()
    {
        //middlwware para manejo de autorizacion de acceso
        $this->middleware('guest', ['only' => 'index']);
    }


    // fucncion para reortar la vista login
    public function index()
    {
        return view('login.login');
    }


    //fucion temporal de login
   /* public function login()
    {

        $credentials = $this->validate(request(), [
            $this->username() => 'required|numeric',
            'password'        => 'required|string',
        ]);
        

        if (Auth::attempt($credentials)) {

            return redirect()->route('dashboard');
        }

        return back()
            ->withErrors(['registro' => 'Usuario y password incorrectos...'])
            ->withInput(request([$this->username()]));
    }*/


    // funcion de login con WS de SIIF
    public function loginWs(){
         //validacion de datos requeridos
        $credentials = $this->validate(request(), [
            $this->username() => 'required|numeric',
            'password'        => 'required|string',
        ]);
            
           
        if (Auth::loginUsingId(request()->registro)) {

            return redirect()->route('dashboard');
        }
        else{
            try{
               //contruccion de informacion para la solicitud a web services
               $wsdl = "https://siif.usac.edu.gt/WSAutenticacion/WSAutenticacionSIIFSoapHttpPort?WSDL";
                
                $params = array("pxml" => "<AUTENTICACION>
                    <TIPO_USUARIO>TRABAJADOR</TIPO_USUARIO>
                    <USUARIO>".request()->registro."</USUARIO>
                    <PASSWORD>".request()->password."</PASSWORD>
                </AUTENTICACION>");
                
                $metodo = 'validarAutenticacion';


                try {
                    // creacion de objecto cliente para la petision 
                   $client = new NuSoapClient($wsdl, 'wsdl');
                    $respuestas = $client->call($metodo, $params); //respuesta
                    
                    $err = $client->getError();
                    if ($err) {
                         return $err;
                    }else{
                        //obtencion del xml de la respuesta
                        $xml = new \SimpleXMLElement(utf8_encode($respuestas['result']));
                        $rx = $xml->CODIGO_RESP; //resulado*/    
            
                      //validacion de respuesta
                       //$rx =1;
                        if($rx==1){

                            // se valida al usuario por su registro  para saber si exite en el sistema
                            // si no existe se crea al usuario
                        if (!(Auth::loginUsingId(request()->registro))) {
                            $newUser = new user();
                            $newUser->registro = request()->registro;
                            $newUser->correo= $xml->CORREO;
                            $newUser->save();
                            Auth::loginUsingId(request()->registro);
                        }

                        // se redirecciona al dashboard del usuario
                         return redirect()->route('dashboard');

                        }else{
                            // el Ws responde con un false en la autenticacion se regresa al login
                           return back()
                            ->withErrors(['registro' => 'Numero de registro y clave incorrectos.'])
                            ->withInput(request([$this->username()]));
                        }
                        } // fin else
                } catch (Exception $e) {
                    return 'error ';
                }
            }catch(Exception $e){
               return 'error';            }     
        

        }
        
    }


    ///funcion log out
    public function logout()
    {
        Auth::logout();

        return redirect('/');;
    }

    //funcion para cambiar el nombre de campo Id
    public function username()
    {
        return 'registro';
    }

}
