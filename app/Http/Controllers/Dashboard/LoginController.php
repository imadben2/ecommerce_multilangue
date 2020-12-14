<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminloginRequest;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class LoginController extends Controller
{

    public function login(){
     //   return view('dashborad\auth\login');
        return view('dashborad.auth.login');
    }

    public function postlogin(AdminloginRequest $request){

        //validation
        $remember_me=$request->has('remember_me')? true:false;
        if (auth()->guard('admin')->attempt(['email'=> $request->input("email"),'password'=>$request->input('password')],$remember_me)){
              return redirect()->route('admin.dashboard');
        }

        return redirect()->back()->with(['error'=>'les information non valide']);

    }
    public function logout(){
        $gaurd=$this->getGaurd();
        $gaurd->logout();
        return redirect()->route('admin.login');

    }

    private function getGaurd()
    {
        return auth('admin');
    }


}
