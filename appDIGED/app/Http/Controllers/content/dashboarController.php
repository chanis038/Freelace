<?php

namespace App\Http\Controllers\content;

//content\dashboarController
use App\Http\Controllers\Controller;
use App\solicitud;

class dashboarController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function dashboard()
    {
    	$data = solicitud::getSolicitudes();

        return view('dashboard/dashboard',compact('data'));
    }

}
