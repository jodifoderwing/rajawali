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
        Schema::create('surveydetails', function (Blueprint $table) {
            $table->id();
            $table->foreignId('survey_id')->nullable()->constrained('surveys')->cascadeOnDelete();
            $table->string('no_bidang')->nullable();
            $table->string('nama')->nullable();
            $table->integer('shmsg_id')->nullable();
            $table->string('alashak_sg')->nullable();
            $table->string('alamat_tanah')->nullable();
            $table->foreignId('adabangunan_id')->nullable()->constrained('adabangunans')->cascadeOnDelete();
            $table->foreignId('kondbangunan_id')->nullable()->constrained('kondbangunans')->cascadeOnDelete();
            $table->foreignId('posisi_id')->nullable()->constrained('posisis')->cascadeOnDelete();
            $table->string('pekerjaan')->nullable();            //Tambahan
            $table->foreignId('umr_id')->nullable()->constrained('umrs')->cascadeOnDelete();
            $table->foreignId('abdi_id')->nullable()->constrained('abdis')->cascadeOnDelete();
            $table->foreignId('utuhseb_id')->nullable()->constrained('utuhsebs')->cascadeOnDelete();
            $table->string('upload_fotolap')->nullable();
            $table->string('upload_surveylap')->nullable();
            $table->foreignId('penggunaan_id')->nullable()->constrained('penggunaans')->cascadeOnDelete();
            $table->string('ket')->nullable();
            $table->date('tgl_ukur')->nullable();
            $table->string('upload_gu')->nullable();
            $table->integer('npk')->nullable();
            $table->string('koordinat')->nullable();
            $table->integer('luas_ukur')->nullable();
            $table->foreignId('berkas_id')->nullable()->constrained('berkas')->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surveydetails');
    }
};
