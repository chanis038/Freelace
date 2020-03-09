@php
 	$data;
	switch ($datarequest[0]->tipo) {
		case 'PM':
			$data = array('duracion' =>$datarequest[0]->duracion,
						'costo_inscripcion' => $datarequest[0]->costo_inscripcion,
						'frecuencia_pago' => $datarequest[0]->frecuencia_pago,
						'costo_parcial' => $datarequest[0]->costo_parcial);

			break;

		case 'PD':
			# code...
			$data = array('duracion' =>$datarequest[0]->duracion,
						'costo_inscripcion' => $datarequest[0]->costo_inscripcion,
						'frecuencia_pago' => $datarequest[0]->frecuencia_pago,
						'costo_parcial' => $datarequest[0]->costo_parcial);

			break;

		case 'PV':
			$data = array('duracion' =>$datarequest[0]->duracion,
						'fecha_viaje' => $datarequest[0]->fecha_viaje,
						'tipo_duracion' => $datarequest[0]->tipo_duracion,
						'lugar' => $datarequest[0]->lugar);
			
			break;

		case 'PB':
			$data = array('duracion'=>$datarequest[0]->duracion,
						'fecha_viaje' => $datarequest[0]->fecha_viaje,
						'tipo_duracion' => $datarequest[0]->tipo_duracion,
						'lugar' => $datarequest[0]->lugar);
			
			break;

		case 'PBV':
			# code...
			$data = array('duracion'=>$datarequest[0]->duracion,
						'fecha_viaje' => $datarequest[0]->fecha_viaje,
						'tipo_duracion' => $datarequest[0]->tipo_duracion,
						'lugar' => $datarequest[0]->lugar);
			
			break;
		case 'PCC':
			# code...
			$data = array('duracion'=>$datarequest[0]->duracion,
						'tipo_duracion' => $datarequest[0]->frecuencia_pago,
						'costo_inscripcion' => $datarequest[0]->costo_inscripcion,
						'costo_parcial' => $datarequest[0]->costo_parcial);
			
			break;
		
		default:
			# code...
		$data = array();

			break;
	}

@endphp