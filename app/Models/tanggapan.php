<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tanggapan extends Model
{
    protected $table = "tanggapans";
    public $fillable = ['tgl_tanggapan', 'id_pengaduan', 'tanggapan', 'id_petugas'];
}
