<?php

namespace App\Http\Controllers;


use App\Models\register;
use App\Models\pengaduan;
use App\Models\tanggapan;
use Carbon\Carbon;
use App\Models\User; /*Untuk cara pertama*/
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// use Illuminate\Support\Facades\DB; /*Untuk cara ke-2*/
// class adminController extends Controller /*Untuk cara ke-2*/

class adminController extends Controller
{
    public function index(){
        $data=DB::table('pengaduans')
        ->leftJoin('users','users.id','=','pengaduans.id_masyarakat')
        ->select('pengaduans.*','users.nik','users.nama')
        ->latest()
        ->get();

        return Inertia::render('admin/home',[
            'datas' => $data
        ]);
    }
    public function userPost(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'level' => 'required',
            'password' => 'required',
            'tlp' => 'required',
            'username' => 'required',
        ], [
                'username.required' => "isiki usernameta",
                'password.required' => "isiki passwordta",
                'nama.required' => "isiki namata",
                'tlp.required' => "isiki nomorta",
                'level.required' => "isiki role ta",
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
    public function user()
    {
        $data = User::oldest()->get(); /*Untuk cara pertama*/
        // $data = DB::table('users')->latest()->get(); /*Untuk cara ke-2*/
        return Inertia::render('admin/user', [
            'data' => $data
        ]);
    }
    public function userEdit($id){
        $data = User::where('id', $id)->first();
        // $data = db::table('users')->where('id', $id)->first();
        return response()->json($data);
    }
    public function userHapus($id){
        if($id){
            $hapus=User::find($id);
            $hapus->delete();
        }
    }
    public function userReg(){
        $reg=register::latest()->get();
        return Inertia::render('admin/register', [
            'reg'=>$reg
        ]);
    }
    public function regPros($id){
        $tangkap = register::where('id', $id)->first();
        user::create([
            'nama' => $tangkap->nama,
            'nik' => $tangkap->nik,
            'tlp' => $tangkap->tlp,
            'username' => $tangkap->username,
            'password' =>bcrypt($tangkap->password),
            'level' => 'masyarakat'

        ]);
        if($tangkap->id){
            $hapus = register::find($tangkap->id);
            $hapus->delete();
        }
        return redirect()->back();
    }
    public function tanggapanProses(Request $request){
        $sekarang =Carbon::now()->format('Y-m-d');
        if($request->id_pengaduan){
            $update = pengaduan::find($request->id_pengaduan);
            $update->update([
                'status'=>'proses'
            ]);
        }
        tanggapan::create([
            'id_pengaduan' => $request->id_pengaduan,
            'tanggapan' => $request->tanggapan,
            'id_petugas' =>Auth()->User()->id,
            'tgl_tanggapan' => $sekarang
        ]);
        return redirect()->back();
    }
    public function tanggapanSelesai(Request $request){
        if($request->id_pengaduan){
            $update = pengaduan::find($request->id_pengaduan);
            $update->update([
                'status'=>'selesai'
            ]);
        }
       $data = tanggapan::where('id_pengaduan', $request->id_pengaduan)->first();
       if($data->id){
        $update = tanggapan::find($data->id);
        $update->update([
            'tanggapan'=>$request->tanggapan
        ]);
    }
    return redirect()->back();
    }
}
