@extends('commons.dashboardtemplate')

@section('title')
Acuerdo
@endsection
@section('contentDash')

<main class="container " id="dashmain" role="main">
   
  		<form action="{{route('createDealFile')}}" method="post">
  			{{csrf_field()}}
  		<div class="my-3 p-3 bg-white rounded shadow-sm justify-content-center">
  			<div class=" col-xs-6 col-ms-8 col-md-8 mb-1">
  			<input type="hidden" " name="slug" value="{{$data[0]->slug}}">
         	<input type="text" class="form-control" name="header1" value="ACUERDO DE DIRECCIÓN  No. 243-2019">
         	<br>
         	</div>
         	<div class=" col-xs-6 col-ms-6 col-md-8 mb-1">
         	<input type="text"  class="form-control " name="header2" value="DIRECION GENERAL DE DOCENCIA">
            <br>
            <br>
            </div>
         	<div class=" col-xs-6 col-ms-8 col-md-8 mb-1">
             <textarea  class="form-control justify-content-center" name="body" rows="25">
                      	El DIRECTOR GENERAL DE DOCENCIA DE LA UNIVERSIDAD DE SAN CARLOS DE GUATEMALA, de conformidad con las atribuciones que le confiere el Artículo 129 de los Estatutos de la Universidad de San Carlos de Guatemala, CONSIDERANDO: Primero: Que la Universidad de San Carlos de Guatemala fomenta la formación del docente universitario a nivel de post grado( maestría y doctorado), dentro y fuera del país. Segundo: Que el {{ucwords($data[0]->p_nombre.' '.$data[0]->s_nombre.' '.$data[0]->p_apellido.' '.$data[0]->s_apellido)}}, Profesor interno, de la Facultad de ingeniería, CUI No.{{$data[0]->dpi}}, Registro de personal No.{{$data[0]->registro}}, solicita ayuda económica para {{$data[0]->justificacion}}, año {{date("Y")}} , POR TANTO: ACUERDA: Primero: Autorizar a la Tesorería de la Dirección General de Docencia, erogar la cantidad de  {{$data[0]->monto_letras.'('.$data[0]->monto.')'}} en concepto de ayuda económica para pago de inscripción y cursos. Segundo: Este gasto será a cardo de la Partida Presupuestaria No.4.9.21.1.01.419, como parte del apoyo al Desarrollo y Formación del Profesor Universitario, del Fondo de Desarrollo, Y se entregará a la ingeniera antes mencionada, debiendo presentar la liquidación correspondiente al finalizar dichos estudios, en un plazo de cuarenta y ocho horas. De lo contrario se procederá según lo establecido en los Acuerdos de Rectoría Nos. 1,276-92 y 571-98. Tercero: Así también deberá replicar o socializar el conocimiento adquirido, en su Unidad Académica, a través de la Metodología que usted determine utilizar , lo que deberá evidenciar el decano y/o director de su Unidad Académica , por medio de un informe circunstanciado a esta dirección . COMUNÍQUESE. Dado en la ciudad de Guatemala a los {{date('d')}} días del mes de {{date('F')}} del año {{date('Y')}}.	
             	             	
                </textarea>
                <br>
                <br>
                </div>
         		<div class=" col-xs-6 col-ms-6 col-md-6 mb-1">
                <input type="text" class="form-control" name="footer" value="Dr. Olmedo España Calderon">
                </div>
       

         </div> 
         <div class="my-3 p-3 bg-white rounded shadow-sm">
         	 <button class="btn btn-primary btn-lg btn-block" type="submit"  id= "sentrequest" name="sentrequest"  >Crear Archivo de Acuerdo</button>
         </div>

  		</form>

  </main>

  @endsection