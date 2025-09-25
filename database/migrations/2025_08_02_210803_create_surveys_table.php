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
        Schema::create('surveys', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kabkota_id')->constrained('kabkotas')->cascadeOnDelete();
            $table->foreignId('kapkem_id')->constrained('kapkems')->cascadeOnDelete();
            $table->foreignId('kalkel_id')->constrained('kalkels')->cascadeOnDelete();
            $table->foreignId('padkam_id')->constrained('padkams')->cascadeOnDelete();
            $table->string('lokasi');
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->integer('qty')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surveys');
    }
};
