<?php

namespace App\Http\Controllers;

use App\Models\register;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Models\User;

class appController extends Controller
{
    public function show()
    {
        return Inertia::render('home');
    }
    public function rpl(){
        $data = "haloo ini dari backend";
        return Inertia::render('about',[
            'datas'=>$data
        ]);
    }
    public function register()
    {
        return inertia::render('register');
    }
    public function registerUser(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'level' => 'required',
            'password' => 'required',
            'tlp' => 'required',
            'username' => 'required',
        ], [
                'username.required' => "Isi dulu usernamenya goblok!",
                'password.required' => "Isi dulu passwordnya goblok!",
                'nama.required' => "Lu siapa goblok!",
                'tlp.required' => "Gimana mau dihubungi goblok!",
                'level.required' => "Peringkatlu mana goblok!",
            ]);

        User::updateOrCreate(['id' => $request->id], [
            'nik' => $request->nik,
            'password' => bcrypt($request->password),
            'tlp' => $request->tlp,
            'level' => $request->level,
            'username' => $request->username,
            'nama' => $request->nama,
        ]);

        return redirect()->back();
    }
    public function registerPost(Request $request){
        $request->validate([
            'nama' => 'required',
            'nik' => 'required',
            'tlp' => 'required',
            'username' => 'required',
            'password' => 'required',

        ],[
            'nama.required' =>"nama wajib diisi",
            'nik.required' =>"nik wajib diisi",
            'tlp.required' =>"tlp wajib diisi",
            'username.required' =>"username wajib diisi",
            'password.required' =>"password wajib diisi",
        ]);
        register::create([
            'nama'=>$request->nama,
            'nik'=>$request->nik,
            'tlp'=>$request->tlp,
            'username'=>$request->username,
            'password'=>$request->password,
        ]);
        return to_route('login');
    }
}
