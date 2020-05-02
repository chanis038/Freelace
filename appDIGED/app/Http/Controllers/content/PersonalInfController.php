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
        $result ='!Datos actualizados correctamente.!';
        $response=0;
        if(auth()->user()->perfil=='U'){
             $data = validaciones::validatesUser($request);   
            }
            else{
            $data = validaciones::validates($request);                  
            }

            try{
                $response= User::where('registro',auth()->user()->registro)
                   ->update($data);

              if($response != 1)
              $result ='!Error, no se pudieron actualizar los datos!';
            }
    		    catch(Exception $e){
              $result ='!Error, no se pudieron actualizar los datos!';
            }  

            //return $data;
            if($request->slug == '0')
             return redirect()->route('createR')->with(['response'=>$response,'result'=>$result]);  

             else
              return redirect()->route('viewModifyRequest',['slug'=>$request->slug])->with(['response'=>$response,'result'=>$result]);

    }


}
