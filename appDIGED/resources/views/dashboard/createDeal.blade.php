@extends('commons.dashboardtemplate')

@section('title')
Acuerdo
@endsection
@section('contentDash')

<main class="container " id="dashmain" role="main">

      @php
      $dia =array('uno','dos','tres','cuatro','cinco','seis','siete','ocho','nueve','diez','once','doce','trece','catorce','quince','dieciséis','diecisiete','dieciocho','diecinueve','veinte','veintiun','veintidós','veintitrés','veinticuatro','veinticinco','veintiséis','veintisiete','veintiocho','veintinueve','treinta','treinta y un');
      $mes = array('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');

      $año = array('veinte','veintiuno','veintidós','veintitrés','veinticuatro','veinticinco','veintiséis','veintisiete','veintiocho','veintinueve','treinta','treinta y uno','treinta y dos','treinta y tres','treinta y cuatro','treinta y cinco','treinta y seis','treinta y siete','treinta y ocho','treinta y nueve','cuarenta','cuarenta y uno','cuarenta y dos','cuarenta y tres','cuarenta y cuatro','cuarenta y cinco','cuarenta y seis','cuarenta y siete','cuarenta y ocho','cuarenta y nueve','cincuenta','cincuenta y uno','cincuenta y dos','cincuenta y tres','cincuenta y cuatro','cincuenta y cinco','cincuenta y seis','cincuenta y siete','cincuenta y ocho','cincuenta y nueve','cincuenta y uno','cincuenta y dos','cincuenta y tres','cincuenta y cuatro','cincuenta y cinco','cincuenta y seis','cincuenta y siete','cincuenta y ocho','cincuenta y nueve','sesenta','sesenta y uno','sesenta y dos','sesenta y tres','sesenta y cuatro','sesenta y cinco','sesenta y seis','sesenta y siete','sesenta y ocho','sesenta y nueve','setenta','setenta y uno','setenta y dos','setenta y tres','setenta y cuatro','setenta y cinco','setenta y seis','setenta y siete','setenta y ocho','setenta y nueve','ochenta','ochenta y uno','ochenta y dos','ochenta y tres','ochenta y cuatro','ochenta y cinco','ochenta y seis','ochenta y siete','ochenta y ocho','ochenta y nueve','noventa','noventa y uno','noventa y dos','noventa y tres','noventa y cuatro','noventa y cinco','noventa y seis','noventa y siete','noventa y ocho','noventa y nueve','cien');

      @endphp
   
  		<form action="{{route('createDealFile')}}" method="post">
  			{{csrf_field()}}
  		<div class="my-3 p-3 bg-white rounded shadow-sm justify-content-center">
  			<div class=" col-xs-6 col-ms-8 col-md-8 mb-1">
  			<input type="hidden" " name="slug" value="{{$data[0]->slug}}">
         	<input type="text" class="form-control" name="header1" value="ACUERDO DE DIRECCIÓN  No. 243-2019">
         	<br>
         	</div>
         	<div class=" col-xs-6 col-ms-6 col-md-8 mb-1">
         	<input type="text"  class="form-control " name="header2" value="DIRECIÓN GENERAL DE DOCENCIA">
            <br>
            <br>
            </div>
         	<div class=" col-xs-6 col-ms-8 col-md-8 mb-1">
             <textarea  class="form-control justify-content-center" name="body" rows="25">
                      	LA DIRECIÓN GENERAL DE DOCENCIA DE LA UNIVERSIDAD DE SAN CARLOS DE GUATEMALA, de conformidad con las atribuciones que le confiere el Artículo 129 de los Estatutos de la Universidad de San Carlos de Guatemala, CONSIDERANDO: Primero: Que la Universidad de San Carlos de Guatemala fomenta la formación del docente universitario a nivel de post grado( maestría y doctorado), dentro y fuera del país. Segundo: Que el {{ucwords($data[0]->p_nombre.' '.$data[0]->s_nombre.' '.$data[0]->p_apellido.' '.$data[0]->s_apellido)}}, Profesor interno, de la Facultad de ingeniería, CUI No.{{$data[0]->dpi}}, Registro de personal No.{{$data[0]->registro}}, solicita ayuda económica para {{$data[0]->justificacion}}, año {{date("Y")}} , POR TANTO: ACUERDA: Primero: Autorizar a la Tesorería de la Dirección General de Docencia, erogar la cantidad de  {{$data[0]->monto_letras.'('.$data[0]->monto.')'}} en concepto de ayuda económica para pago de inscripción y cursos. Segundo: Este gasto será a cardo de la Partida Presupuestaria No.4.9.21.1.01.419, como parte del apoyo al Desarrollo y Formación del Profesor Universitario, del Fondo de Desarrollo, Y se entregará a la ingeniera antes mencionada, debiendo presentar la liquidación correspondiente al finalizar dichos estudios, en un plazo de cuarenta y ocho horas. De lo contrario se procederá según lo establecido en los Acuerdos de Rectoría Nos. 1,276-92 y 571-98. Tercero: Así también deberá replicar o socializar el conocimiento adquirido, en su Unidad Académica, a través de la Metodología que usted determine utilizar , lo que deberá evidenciar el decano y/o director de su Unidad Académica , por medio de un informe circunstanciado a esta dirección . COMUNÍQUESE. Dado en la ciudad de Guatemala a los {{$dia[date('j')-1]}} días del mes de {{$mes[date('n')-1]}} del año dos mil {{$año[date('Y')-2020]}}.	
             	             	
                </textarea>
                <br>
                <br>
                </div>
         		<div class=" col-xs-6 col-ms-6 col-md-6 mb-1">
                <input type="text" class="form-control" name="footer" value="Dr.Alberto García González">
                </div>
       

         </div> 
         <div class="my-3 p-3 bg-white rounded shadow-sm">
         	 <button class="btn btn-primary btn-lg btn-block" type="submit"  id= "sentrequest" name="sentrequest"  >Crear archivo de acuerdo</button>
         </div>

  		</form>
      <hr class="mb-4">
  </main>

  @endsection