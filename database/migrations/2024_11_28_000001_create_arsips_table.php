<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('arsips', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nomor_surat')->nullable();
            $table->string('judul');
            $table->string('flie_path')->nullable();
            $table->dateTime('waktu_pengarsipan');
            $table->unsignedBigInteger('kategorisurat_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arsips');
    }
};
