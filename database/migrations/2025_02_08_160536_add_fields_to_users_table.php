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
            $table->string('phone')->nullable()->after('password'); // Добавляем поле "phone" после "password"
            $table->text('address')->nullable()->after('phone'); // Поле "address"
            $table->enum('role', ['customer', 'admin'])->default('customer')->after('address'); // Поле "role"
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['phone', 'address', 'role']); // Удаляем добавленные поля
        });
    }
};
