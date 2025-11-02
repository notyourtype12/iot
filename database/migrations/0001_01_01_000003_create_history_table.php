<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migration.
     */
    public function up(): void
    {
        Schema::create('history', function (Blueprint $table) {
            $table->char('id_history', 10)->primary();
            $table->date('tanggal');
            $table->char('grade', 50);
            $table->char('bobot', 50);
            $table->char('ukuran', 50);
            $table->string('foto', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse migration.
     */
    public function down(): void
    {
        Schema::dropIfExists('histories');
    }
};
