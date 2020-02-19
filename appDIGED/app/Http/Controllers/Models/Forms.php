<?php

namespace App\Http\Controllers\Models;

use Codedge\Fpdf\Fpdf\Fpdf;

class Forms{

	 public function __construct(){

	}

	public  function createForm1($dataResquest, $dirfile){
		// CREACION DE FORMULARIO 1
         $fpdf= new Fpdf();
         $fpdf->AddPage();
         $fpdf->SetMargins(22,5,20);
         $fpdf->Image('images/usac.png',10,10,-300,'png');
         $fpdf->Ln(20);
         $fpdf->SetFont('Arial', 'B', 12);
         $fpdf->Cell(0,5, 'SOLITUD Y AUTORIZACION DE AYUDA ECONOMICA',0,2,'C',false);
         $fpdf->Ln(1);
        
         $fpdf->SetFont('Arial','', 10);
         $fpdf->Cell(0,5,'Fecha: '.Date('d').'/ '.date('m').'/ '.date('Y'),0,2,'R');
         $fpdf->Cell(0,5,'A:                                          DR. ALBERTO GARCIA GONZALEZ',1,2);
         $fpdf->Cell(0,5,'Cargo:                                                         DIRECTOR',1,2);
         $fpdf->Cell(0,5,utf8_decode('Unidad Administrativa o Académica:          DIRECCION GENERAL DE DOCENCIA'),1,2);

         $fpdf->SetFont('Arial', 'B', 10);
         $fpdf->Cell(0,5, 'DATOS PERSONALES DEL SOLICITANTE:',1,2,'C');
         $fpdf->SetFont('Arial', '', 10);
         $fpdf-> Cell(50,6,'Primer Apellido:','LR',0,'L');
         $fpdf-> Cell(50,6,'Segundo Apellido:','LR',0,'L');
         $fpdf-> Cell(0,6,'Nombres:','LR',2,'L');
         $fpdf->Ln(1);
         $fpdf-> Cell(50,6,utf8_decode('   '.auth()->user()->p_apellido),'LRB',0,'L');
         $fpdf-> Cell(50,6,utf8_decode('   '.auth()->user()->s_apellido),'LRB',0,'L');
         $fpdf-> Cell(0,6,utf8_decode('   '.auth()->user()->p_nombre.' '.'   '.auth()->user()->s_nombre ),'LRB',2,'L');
         $fpdf->Ln(1);
         $fpdf->Cell(50,6,utf8_decode('Numero de carné:'),'LR',0,'L');
         $fpdf->Cell(50,6,'Numero de registro:','LR',0,'L');
         $fpdf->Cell(0,6,'Numero individual DPI:','LR',2,'L');
         $fpdf->Ln(1);
         $fpdf->Cell(50,6,'   '.auth()->user()->n_carne,'LRB',0,'L');
         $fpdf->Cell(50,6,'   '.auth()->user()->registro,'LRB',0,'L');
         $fpdf->Cell(0,6,'   '.auth()->user()->dpi ,'LRB',2,'L');
         $fpdf->Ln(1);
         $fpdf->Cell(65,6,'Cargo que ocupa:','LR',0,'L');
         $fpdf->Cell(0,6,utf8_decode('Unidad Administrativa o Académica:'),'LR',2,'L');
         $fpdf->Ln(1);
         $fpdf-> Cell(65,6,utf8_decode('   '.auth()->user()->cargo),'LRB',0,'L');
         $fpdf->Cell(0,6,utf8_decode('   '.auth()->user()->unidad_academica),'LRB',2,'L');
         $fpdf->Ln(1);
         $fpdf-> Cell(65,6,utf8_decode('Dirección de residencia:'),'LR',0,'L');
         $fpdf->Cell(50,6,utf8_decode('N.Teléfono: '.'   '.auth()->user()->n_telefono),'LR',0,'L');
         $fpdf-> Cell(0,6,'Numero de NIT:','LR',2,'L');
         $fpdf->Ln(1);
         $fpdf->Cell(65,6,utf8_decode('   '.auth()->user()->direccion),'LRB',0,'L');
         $fpdf->Cell(50,6,'N.Celular: '.'   '.auth()->user()->n_celular,'LRB',0,'L');
         $fpdf->Cell(0,6,'   '.auth()->user()->nit ,'LRB',2,'L');
         $fpdf->Ln(1);
         $fpdf->Cell(0,5, 'Correo electronico: '.utf8_decode('   '.auth()->user()->correo),'LRB',2,'L');

         $fpdf->SetFont('Arial', 'B', 10);
         $fpdf->Cell(0,5, utf8_decode('DATOS DE LA AYUDA ECONÓMICA:'),1,2,'C');
         $fpdf->SetFont('Arial', '', 10);
         $fpdf-> Cell(100,6,'Monto solicitado en letras:','LR',0,'L');
         $fpdf-> Cell(0,6,'Q:','LR',2,'L');
         $fpdf->Ln(1);
         $fpdf-> Cell(100,6,utf8_decode('   '.$dataResquest->monto_letras),'LRB',0,'L');
         $fpdf-> Cell(0,6,'   '.$dataResquest->monto,'LRB',2,'L');
         $fpdf->Ln(1);
         $fpdf->Cell(0,6,utf8_decode('Justificación:'),'LR',2,'L');
         $fpdf->Ln(1);
         $fpdf->MultiCell(0,5,utf8_decode('     '.$dataResquest->justificacion),'LRB','L',false);
         $fpdf->Ln(1);
         $fpdf->MultiCell(0,6,utf8_decode('¿Ha solicitado financiamiento de otras unidades académicas o administrativas de la Universidad de San Carlos de Guatemala o en la DIGED?                Si: ___                          No: _X_ '),'LR','L',false);
          $fpdf->Ln(1); 
          $fpdf->MultiCell(0,6,utf8_decode('De ser afirmativa su respuesta, llenar lo que se le solicita a continuación: '),'LRB','L',false);
         $fpdf->Ln(1);
         $fpdf-> Cell(90,6,utf8_decode('Nombre de la Unidad Administrativa o Académica:'),'LR',0,'L');
         $fpdf-> Cell(0,6,'Monto (Q):','R',2,'L');
         $fpdf->Ln(1);
         $fpdf-> Cell(90,6,'','LRB',0,'L');
         $fpdf-> Cell(0,6,'Monto en letras:','RB',2,'L');
         $fpdf->Ln(1);
         $fpdf-> Cell(50,6,utf8_decode('Motivo de la ayuda económica:'),'L',0,'L');
         $fpdf-> Cell(0,6,'','BR',2,'RB');
         $fpdf->Ln(1);
         $fpdf-> Cell(0,6,utf8_decode('Debidamente certificado por tesorería de su Unidad Académica:'),'LRB',2,'L');
         $fpdf->Ln(1);
         $fpdf-> Cell(0,6,'(F) Tesorero (a)','LRB',2,'R');
         $fpdf->Ln(1);
         $fpdf-> Cell(0,6,'____________________________','LR',2,'C');
         $fpdf->Ln(1);
         $fpdf-> Cell(0,6,'(F) Solicitante:','LRB',2,'C');
         $fpdf->SetFont('Arial', 'B', 10);
         $fpdf->Cell(0,5, utf8_decode('AUTORIZACION DE AYUDA ECONÓMICA:'),1,2,'C');
         $fpdf->SetFont('Arial', '', 10);
         $fpdf->Ln(1);
         $fpdf-> Cell(0,6,'Nombre Completo:       DR. ALBERTO GARCIA GONZALEZ','LR',2,'L');
         $fpdf->Ln(1);
         $fpdf-> Cell(0,6,'Reg de Personal N.:        951035 ','LR',2,'L');
         $fpdf->Ln(1);
         $fpdf-> Cell(100,6,'Cargo que Ocupa:        DIRECTOR GENERAL DE DOCENCIA','L',0,'L');
         $fpdf-> Cell(0,6,'(f) ____________________','R',2,'L');
         $fpdf->Ln(1);
         $fpdf-> Cell(100,6,'','LB',0,'L');
         $fpdf-> Cell(0,6,'   (Autoridad competente)','RB',2,'L');
         $fpdf->Ln(1);
         $fpdf->Cell(25,16,utf8_decode('Observación'),'LRB',0,'C');
         $fpdf->SetFont('Arial', '',7);
         $fpdf-> MultiCell(0,4,utf8_decode('La liquidación de la presente ayuda económica deberá realizarse dentro del plazo de cinco (5) días hábiles después de ejecutada la actividad. Debe presentar los documentos que amparen la liquidación en el lugar donde recibió dicha ayuda económica, de lo contrario se procederá de conformidad a los Acuerdos de Rectoría No. 1276-92 y 571-98 incisos 1, 2, 3, 6 y 5 según amerite el caso.'),'LRB','L',false);

         $fpdf->Output('F',$dirfile); 
	}

	public  function createForm2($dataResquest,$dirfile){
        // CREACION DE FORMULARIO 2
          $PM=$PD=$PB=$PV=$PBV ='';
          $tipo = utf8_decode('Aceptación y/o invitación de la actividad');

           switch($dataResquest->tipo){
                    case "PM":
                        $PM ='X';
                        $tipo = utf8_decode('Trifoliar informativo de Maestria');
                            break;
                    case 'PD':
                        $PD='X';
                        $tipo = utf8_decode('Trifoliar informativo de Doctorado');
                            break;
                    case 'PB':
                        $PB ='X';
                            break;
                    case 'PV':
                        $PV ='X';

                            break;                         
                    default:
                        $PBV='X';
                            break;
           }
                             
         $fpdf2= new Fpdf();
         $fpdf2->AddPage();
         $fpdf2->SetMargins(22,5,20);
         $fpdf2->Image('images/usac.png',10,10,-300,'png');
         $fpdf2->Ln(12);
         $fpdf2->SetFont('Arial', 'B', 12);

         $fpdf2->Cell(0,5, 'REQUISITOS COMPLEMENTARIOS DE SOLITUD DE AYUDA ECONOMICA',0,2,'C',false);
         $fpdf2->SetFont('Arial', 'B', 8);
         $fpdf2->Cell(0,5, '(viaticos, boleto aereo, ayuda becaria)',0,2,'C',false);
         $fpdf2->Ln(1);
         $fpdf2->SetFont('Arial', 'B', 12);
         $fpdf2->Cell(0,5, 'UNIVERSIDAD DE SAN CARLOS DE GUATEMALA',0,2,'C',false);
         $fpdf2->Ln(1);
         $fpdf2->SetFont('Arial', 'B', 10);
         $fpdf2->Cell(0,5, 'DIRECCION GENERAL DE DOCENCIA',0,2,'C',false);
         $fpdf2->Ln(3);
         $fpdf2->Rect(20, 45, 170, 100);
         $fpdf2->SetFont('Arial', '', 10);
         $fpdf2->Cell(80,6, 'Nombre Completo',0,0,'L',false);
         $fpdf2->Cell(0,6, 
           utf8_decode(auth()->user()->p_nombre.' '.        
            auth()->user()->s_nombre.' '.         
            auth()->user()->p_apellido.' '.      
            auth()->user()->s_apellido)

            ,0,2,'L',false);
         $fpdf2->Ln(1);
         $fpdf2->Cell(80,6, 'Registro Personal',0,0,'L',false);
         $fpdf2->Cell(0,6,auth()->user()->registro ,0,2,'L',false);
         $fpdf2->Ln(1);
         $fpdf2->Cell(80,6, 'Titularidad',0,0,'L',false);
         $fpdf2->Cell(0,6, utf8_decode(auth()->user()->titularidad),0,2,'L',false);
         $fpdf2->Ln(1);
         $fpdf2->Cell(80,6, 'Edad',0,0,'L',false);
         $fpdf2->Cell(0,6, auth()->user()->edad,0,2,'L',false);
         $fpdf2->Ln(1);
         $fpdf2->Cell(80,6, 'Estado Civil',0,0,'L',false);
         $fpdf2->Cell(0,6, auth()->user()->estdo_civil,0,2,'L',false);
         $fpdf2->Ln(1);
         $fpdf2->Cell(80,6, 'Nacionaldad',0,0,'L',false);
         $fpdf2->Cell(0,6, auth()->user()->nacionalidad,0,2,'L',false);
         $fpdf2->Ln(1);
         $fpdf2->Cell(80,6, utf8_decode('Profesión'),0,0,'L',false);
         $fpdf2->Cell(0,6, utf8_decode(auth()->user()->profesion),0,2,'L',false);
         $fpdf2->Ln(1);
         $fpdf2->Cell(80,6,'Direccion de Residencia',0,0,'L',false);
         $fpdf2->Cell(0,6, utf8_decode(auth()->user()->direccion),0,2,'L',false);
         $fpdf2->Ln(1);
         $fpdf2->Cell(80,6, 'Direccion de Correo',0,0,'L',false);
         $fpdf2->Cell(0,6,utf8_decode(auth()->user()->correo),0,2,'L',false);
         $fpdf2->Ln(1);
         $fpdf2->Cell(80,6, 'Municipio en que fue extendida',0,0,'L',false);
         $fpdf2->Cell(0,6,utf8_decode(auth()->user()->municipio),0,2,'L',false);
         $fpdf2->Ln(1);
         $fpdf2->Cell(80,6, 'Numero de Celular y Residencia',0,0,'L',false);
         $fpdf2->Cell(0,6, auth()->user()->n_celular.' - '.auth()->user()->n_telefono
            ,0,2,'L',false);
         $fpdf2->Ln(1);
         $fpdf2->Cell(80,6, 'Unidad Academica y Depto,En que labora',0,0,'L',false);
         $fpdf2->Cell(0,6, 
            utf8_decode(auth()->user()->unidad_academica.', '.
            auth()->user()->departamento)
            ,0,2,'L',false);
         $fpdf2->Ln(1);
         $fpdf2->Cell(80,6, 'Cargo que Ocupa',0,0,'L',false);
         $fpdf2->Cell(0,6, utf8_decode(auth()->user()->cargo),0,2,'L',false);
          $fpdf2->Ln(15);
         $fpdf2->Rect(20, 150, 170, 40);
         $fpdf2->SetFont('Arial', 'B', 10);
         $fpdf2->Cell(80,6, 'REQUISITOS COMPLEMENTARIOS',0,2,'L',false);
         $fpdf2->SetFont('Arial','', 10);
         $fpdf2->Ln(1);
         $fpdf2->Cell(80,6, 'Fotocopia de DPI',0,0,'L',false);
         $fpdf2->Cell(5,6, 'X',1,2,'C',false);
         $fpdf2->Ln(1);
         $fpdf2->Cell(80,6, utf8_decode('Fotocopia último voucher'),0,0,'L',false);
         $fpdf2->Cell(5,6, 'X',1,2,'C',false);
         $fpdf2->Ln(1);
         $fpdf2->Cell(80,6, $tipo,0,0,'L',false);
         $fpdf2->Cell(5,6, 'X',1,2,'C',false);
         $fpdf2->Ln(20);
         $fpdf2->Rect(20, 195, 170, 70);
         $fpdf2->SetFont('Arial', 'B', 10);
         $fpdf2->Cell(80,6, 'PARA USO INTERNO DE DIGED',0,2,'L',false);
         $fpdf2->SetFont('Arial', '', 10);
         $fpdf2->Cell(80,6,utf8_decode('Ayuda Económica'),0,0,'L',false);
         $fpdf2->Cell(5,6, '' ,1,0,'C',false);
         $fpdf2->Cell(75,6, utf8_decode('Pago de Doctorado'),0,0,'L',false);
         $fpdf2->Cell(5,6, $PD,1,2,'C',false);
         $fpdf2->Ln(1);
         $fpdf2->Cell(80,6,utf8_decode('Pago de Maestria'),0,0,'L',false);
         $fpdf2->Cell(5,6, $PM,1,0,'C',false);
         $fpdf2->Cell(75,6, utf8_decode('Pago de Boleto Aéreo'),0,0,'L',false);
         $fpdf2->Cell(5,6, $PB,1,2,'C',false);
         $fpdf2->Ln(1);
         $fpdf2->Cell(80,6,utf8_decode('Pago de Viáticos'),0,0,'L',false);
         $fpdf2->Cell(5,6, $PV,1,0,'C',false);
         $fpdf2->Cell(75,6, utf8_decode('Pago de Boleto Aéreo y Viáticos'),0,0,'L',false);
         $fpdf2->Cell(5,6, $PBV,1,2,'C',false);
         $fpdf2->Ln(1);
         $fpdf2->Cell(0,6, utf8_decode('Observaciones:'),0,2,'L',false);
         $fpdf2->Ln(1);
         $fpdf2->MultiCell(0,6, utf8_decode(''),0,'L',false);
         $fpdf2->Output('F',$dirfile); 

	}

   public function ImagePDF($path,$nombre,$tipo){

         $pathOg= public_path().'/Solicitudes/'.$path.'/'.$nombre.$tipo;
         $pathDs= public_path().'/Solicitudes/'.$path.'/'.$nombre.'.pdf';
         $fpdf= new Fpdf();
         $fpdf->AddPage();
         $fpdf->SetMargins(22,5,20);
         $fpdf->Image( $pathOg,20,30,150,100,'jpeg');
         $fpdf->Ln(1);
         $fpdf->Output('F',$pathDs); 

   }

     public static function FileDeal($request,$data){

         
         $pathDs= public_path().'/Solicitudes/'.$data[0]->registro.'/'.$data[0]->slug.'/ACUERDO_'.$data[0]->id.'.pdf';
         $fpdf2= new Fpdf();
         $fpdf2->AddPage();
         $fpdf2->SetMargins(35,5,25);
         $fpdf2->Ln(25);
         $fpdf2->SetFont('Arial','B', 12);
         $fpdf2->Cell(0,5, utf8_decode($request->header1),0,2,'C',false);
         $fpdf2->Cell(0,5, utf8_decode($request->header2),0,2,'C',false);
         $fpdf2->Ln(15);
         $fpdf2->SetFont('Arial','', 12);
         $fpdf2->MultiCell(0,6, utf8_decode($request->body),0,'J',false);
         $fpdf2->Ln(5);
         
         $fpdf2->Cell(0,5, utf8_decode('Atentamente,'),0,2,'C',false);
         $fpdf2->Ln(5);
         $fpdf2->SetFont('Arial','B', 12);
         $fpdf2->Cell(0,5, utf8_decode('"ID Y ENSEÑAD A TODOS"'),0,2,'C',false);
         $fpdf2->Ln(20);

         $fpdf2->Cell(0,5,utf8_decode($request->footer),0,2,'C',false);
         $fpdf2->Cell(0,5,utf8_decode('Director General de Docencia'),0,2,'C',false);
         $fpdf2->Output('F',$pathDs); 

   }

}