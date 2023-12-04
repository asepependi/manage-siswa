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
        Schema::table('users', function (Blueprint $table) {
            $table->string('username', 50)->unique();
            $table->string('alamat')->nullable();
            $table->string('no_telp', 14);
            $table->date('tgl_lahir')->nullable();
            $table->string('avatar');
            $table->boolean('is_admin_tu')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('username');
            $table->dropUnique('username');
            $table->dropColumn('alamat');
            $table->dropColumn('no_telp');
            $table->dropColumn('tgl_lahir');
            $table->dropColumn('avatar');
            $table->dropColumn('is_admin_tu');
        });
    }
};
