<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // ID unik akun Google; dipakai untuk mengenali user yang sama saat login berikutnya.
            $table->string('google_id')->nullable()->unique()->after('email');
            // URL foto profil dari Google.
            $table->string('avatar')->nullable()->after('google_id');
            // User yang login lewat Google tidak punya password, jadi kolom ini harus boleh kosong.
            $table->string('password')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique(['google_id']);
            $table->dropColumn(['google_id', 'avatar']);
            $table->string('password')->nullable(false)->change();
        });
    }
};
