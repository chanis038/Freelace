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

 public function personalinf($slug='0')
    {
        
        return view('dashboard/personalinf',compact('slug'));
    }
    
    public function updateinf(Request $request)
    {
        $data;
        if(auth()->user()->perfil=='U'){
             $data = validaciones::validatesUser($request);   
            }
            else{
            $data = validaciones::validates($request);                  
            }
    		
    		$response= User::where('registro',auth()->user()->registro)
                   ->update($data);

            //return $data;
            if($request->slug == '0')
             return redirect()->route('createR')->with(['response'=>$response]);  

             else
              return redirect()->route('viewModifyRequest',['slug'=>$request->slug])->with(['response'=>$response]);

    }


}
