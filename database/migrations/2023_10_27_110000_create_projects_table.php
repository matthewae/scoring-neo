<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('pekerjaan');
            $table->string('lokasi');
            $table->string('kementerian_lembaga_perangkat_daerah_institusi');
            $table->string('konsultan_perencana');
            $table->string('konsultan_mk');
            $table->string('kontraktor_pelaksana');
            $table->string('metode_pemilihan');
            $table->decimal('nilai_kontrak', 15, 2);
            $table->date('tanggal_spmk');
            $table->string('jangka_waktu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};