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
        Schema::create('riwayat_pemeriksaan', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_pemeriksaan')->nullable();
            $table->unsignedBigInteger('id_pasien');
            $table->unsignedBigInteger('id_dokter')->nullable();
            $table->text('keluhan')->nullable();
            $table->text('diagnosa')->nullable();
            $table->text('tindakan')->nullable();
            $table->json('resep')->nullable();
            $table->date('tanggal_pemeriksaan')->nullable();
            $table->string('foto_kondisi_gigi')->nullable();

            $table->timestamps();

            // foreign key
            $table->foreign('id_pemeriksaan')->references('id')->on('pemeriksaans')->onDelete('cascade');
            $table->foreign('id_pasien')->references('id')->on('pasien')->onDelete('cascade');
            $table->foreign('id_dokter')->references('id')->on('dokters')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_pemeriksaan');
    }
};
