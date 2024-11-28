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
        Schema::table('arsips', function (Blueprint $table) {
            $table
                ->foreign('kategorisurat_id')
                ->references('id')
                ->on('kategorisurats')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('arsips', function (Blueprint $table) {
            $table->dropForeign(['kategorisurat_id']);
        });
    }
};
