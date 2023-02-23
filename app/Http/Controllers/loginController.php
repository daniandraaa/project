<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class loginController extends Controller
{
    public function login(Request $request){
        $request->validate([
            'username' => 'required',
            'password'=> 'required'
        ],[
           'username.required'=>"Isi dulu usernamenya goblok!",
           'password.required'=>"Isi dulu passwordnya goblok!",
        ]);

        if(Auth::attempt(['username'=>$request->username, 'password'=>$request->password, 'level'=>'admin'])){
            return redirect('/admin');
        } elseif(Auth::attempt(['username' => $request->username, 'password' => $request->password, 'level' => 'masyarakat'])){
            return redirect('masyarakat');
        }elseif(Auth::attempt(['username' => $request->username, 'password' => $request->password, 'level' => 'petugas'])){
            return redirect('petugas');
        }
        else{
            return redirect('/');
        }
    }
    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
