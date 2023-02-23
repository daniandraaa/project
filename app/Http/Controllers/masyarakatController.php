<?php

namespace App\Http\Controllers;

use App\Models\pengaduan;
use App\Models\tanggapan;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class masyarakatController extends Controller
{
    public function index()
    {
        $data = DB::table('pengaduans')
            ->leftJoin('users', 'users.id', '=', 'pengaduans.id_masyarakat')
            ->select('pengaduans.*', 'users.nik', 'users.nama')
            ->latest()
            ->get();
        return Inertia::render('masyarakat/home', [
            'datas' => $data
        ]);
    }
    public function pengaduan()
    {
        $data = pengaduan::where('id_masyarakat', Auth()->User()->id)->get();
        return Inertia::render('masyarakat/pengaduan', [
            'datas' => $data
        ]);
    }
    public function pengaduanPost(Request $request)
    {
        $sekarang = Carbon::Now()->format('Y-m-d');
        $request->validate([
            'isi' => 'required'
        ]);
        if (empty($request->file('foto'))) {
            pengaduan::create([
                'isi' => $request->isi,
                'id_masyarakat' => Auth()->User()->id,
                'tgl_pengaduan' => $sekarang,
                'status' => '0'
            ]);
        } else {
            $foto = $request->file('foto')->store('pengaduan', 'public');
            pengaduan::create([
                'isi' => $request->isi,
                'foto' => $foto,
                'id_masyarakat' => Auth()->User()->id,
                'tgl_pengaduan' => $sekarang,
                'status' => '0'
            ]);
        }
        return redirect()->back();
    }
    public function pengaduanHapus($id)
    {
        if ($id) {
            $hapus = pengaduan::find($id);
            $hapus->delete();
        }
        return redirect()->back();
    }
    public function tanggapan($id)
    {
        $data = tanggapan::where('id_pengaduan', $id)->first();
        return response()->json($data);
    }
}
