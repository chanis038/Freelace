<?php

namespace App\Http\Controllers\Mail;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\sendemail;
use App\Solicitud;
use App\User;

class mailController extends Controller
{
    //constructor
       public function __construct()
    {

        $this->middleware('auth');
    }

   
    // funcion que envia mails
    public static function sendMail(Solicitud $solicitud, $tipoEmial)
    {
   
    	$subject='Estado Solicitud';
        $introduction;
    	$to ='';
        $owner= solicitud::getOwnerUser($solicitud->slug);
  
    	switch ($tipoEmial) {
    		case 1: // creacion de solicitud
  					$subject='Nueva Solicitud';
                    $introduction= "Sea creado una nueva solicitud";
    				$revisores = User::getRevisores();
    				if($revisores== null || $revisores==""){
    					return "dont to..";
    				}

    				$first=true;
    				foreach($revisores as $revisor){
    					if($first){
    					$to = $revisor->correo;	
    					}
    					else{
    						$to = $to.','.$revisor->correo;
    					}
    				 	
    				}

    			break;

                case 2: // Correo de aprobacion de papeleria de solcitud
                    $introduction='La solicitud ha sido revisa por un agente de la DIGED, quien a comporbado que toda la papeleria esta correcta y pasara a ser revisada por el director, para su autorizacion'; 
                     $to= $owner[0]->correo;
                break;

                case 3: //  Correo de Autorizacion de solcitud                   
                    $introduction='La solicitud ha sido Autorizada, y pasara ha tesoreria para la generacion del cheque correspondiente';
                    $to= $owner[0]->correo;
                    $revisores = User::getRevisores();
                    if(!($revisores== null || $revisores=="")){
                       foreach($revisores as $revisor){
                           $to = $to.','.$revisor->correo;
                        }  
                    }
                                       

                break;

                case 4: //  Correo de no autorizacion de  solcitud
                    $introduction='La solicitud no ha sido Aprobado por la DIGED'; 
                    $to= $owner[0]->correo;
                break;

                case 5: //  Correo de autorizacion de  solcitud
                    $subject='Nueva Solicitud Autorizada';
                    $introduction='La siguiente solicitud de ayuda economíca ha sido revisa y Autorizada por la DIGED';  
                    $tesoreros = User::getTesoreros();
                    if($tesoreros== null || $tesoreros==""){
                        return "dont to..";
                    }

                    $first=true;
                    foreach($tesoreros as $tesorero){
                        if($first){
                        $to = $tesorero->correo; 
                        }
                        else{
                            $to = $to.','.$tesorero->correo;
                        }
                    } 
                break;

                case 6: // creacion de solicitud;
                    $introduction='El cheque de su solicitud se encuentra listo en tesoreria, puede pasar a recogerlo'; 
                   $to= $owner[0]->correo; 
                break;
    		
    		default:
    			return "dont sent";
    			
    	}
  		
        if($to !='' && $to != null){
            foreach(explode(',',$to) as $a ){
                Mail::to($a)->send(new sendemail($solicitud,$owner,$subject,$introduction));

            }
            
             return "success";
        }
    	else{
            return "dont sent";
        }
       
       
    }


}
