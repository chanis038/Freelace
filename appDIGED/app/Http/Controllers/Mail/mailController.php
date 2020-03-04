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
   
    	$subject='Estado solicitud';
        $introduction;
    	$to ='';
        $owner= solicitud::getOwnerUser($solicitud->slug);
  
    	switch ($tipoEmial) {
    		case 1: // creacion de solicitud
  					$subject='Nueva solicitud';
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
                    $introduction='La solicitud ha sido revisada por un agente de la DIGED, quien ha comprobado que toda la papelería es correcta, pasará a ser revisada por el director, para su autorización:'; 
                     $to= $owner[0]->correo;
                break;

                case 3: //  Correo de Autorizacion de solcitud                   
                    $introduction='La solicitud ha sido autorizada,  pasará a tesorería DIGED para continuar con el proceso. El sistema le notificará en un lapso de 20 días hábiles para que  pueda pasar a recoger el cheque de la ayuda económica solicitada.';
                    $to= $owner[0]->correo;
                    $revisores = User::getRevisores();
                    if(!($revisores== null || $revisores=="")){
                       foreach($revisores as $revisor){
                           $to = $to.','.$revisor->correo;
                        }  
                    }
                                       

                break;

                case 4: //  Correo de no autorizacion de  solcitud
                    $introduction='La solicitud no ha sido aprobada por la DIGED, en este momento no es posible concederle esta solicitud.'; 
                    $to= $owner[0]->correo;
                break;

                case 5: //  Correo de autorizacion de  solcitud
                    $subject='Nueva solicitud autorizada';
                    $introduction='La siguiente solicitud de ayuda económica ha sido revisa y autorizada por la DIGED.';  
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
    		    case 7:
                    $subject='Modificaion de solicitud';
                    $introduction= "El usuario ".auth()->user()->p_nombre.",ha modificado la solicitud:";
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
