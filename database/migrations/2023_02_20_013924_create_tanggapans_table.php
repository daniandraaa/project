<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tanggapans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_pengaduan')->unsigned();
            $table->text('tanggapan');
            $table->bigInteger('id_petugas')->unsigned();
            $table->date('tgl_tanggapan');
            $table->timestamps();
            $table->foreign('id_pengaduan')->references('id')->on('pengaduans')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_petugas')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tanggapans');
    }
};
