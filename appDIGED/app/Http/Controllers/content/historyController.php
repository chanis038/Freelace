<?php

namespace App\Http\Controllers\content;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use app\solicitud;
use app\User;


class historyController extends Controller
{
      //construcctor
       public function __construct()
    {

        $this->middleware('auth');
    }

    public function viewHistory(Request $request){
    	$data = User::gethistory($request);

    	   return view("dashboard.history",compact('data'));
    }

}
