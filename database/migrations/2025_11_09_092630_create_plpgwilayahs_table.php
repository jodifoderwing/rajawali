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
        Schema::create('plpgwilayahs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plpg_id')->constrained('plpgs')->cascadeOnDelete();
            $table->foreignId('skwwilayah_id')->constrained('skwwilayahs')->cascadeOnDelete();
            $table->string('nama');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plpgwilayahs');
    }
};
