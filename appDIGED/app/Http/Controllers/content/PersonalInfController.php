<?php

namespace App\Http\Controllers\content;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Models\validaciones;


class PersonalInfController extends Controller
{
    //
     public function __construct()
    {
        $this->middleware('auth');
    }

 public function personalinf()
    {
        
        return view('dashboard/personalinf');
    }
    
    public function updateinf(Request $request)
    {
    		
    		$data = validaciones::validatesUser($request);
    		//return $data;
             $response= User::where('registro',auth()->user()->registro)
                   ->update($data);

             return redirect()->route('personalinf')->with(['response'=>$response]);      
    }


}
