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
        // Menambahkan kolom yang dibutuhkan aplikasi rental mobil
        $table->string('full_name')->after('id')->nullable();
        $table->text('home_address')->after('full_name')->nullable();
        $table->integer('age')->after('home_address')->nullable();
        $table->string('identity_file')->after('password')->nullable();
    });
}

public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn(['full_name', 'home_address', 'age', 'identity_file']);
    });
}
};
