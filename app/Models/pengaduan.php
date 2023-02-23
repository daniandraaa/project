<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengaduan extends Model
{
    protected $table = "pengaduans";
    protected $fillable = ['tgl_pengaduan', 'id_masyarakat', 'isi', 'foto', 'status'];
}
