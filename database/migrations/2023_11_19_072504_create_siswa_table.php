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
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 15);
            $table->string('nis', 9)->unique();
            $table->string('nama_siswa', 100);
            $table->string('no_telp', 20);
            $table->string('alamat', 100);
            $table->year('tahun_masuk');
            $table->enum('jenis_kelamin', ['l','p']);
            $table->unsignedBigInteger('kelas_id')->nullable();
            $table->timestamps();

            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};
