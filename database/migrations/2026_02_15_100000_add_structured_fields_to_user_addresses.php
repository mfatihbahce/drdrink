<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('user_addresses', function (Blueprint $table) {
            $table->foreignId('city_id')->nullable()->after('user_id')->constrained()->nullOnDelete();
            $table->string('district')->nullable()->after('city_id'); // İlçe
            $table->string('neighborhood')->nullable()->after('district'); // Mahalle
            $table->string('street')->nullable()->after('neighborhood'); // Sokak
            $table->string('avenue')->nullable()->after('street'); // Cadde
            $table->string('building')->nullable()->after('avenue'); // Bina no
            $table->string('apartment')->nullable()->after('building'); // Daire
        });
    }

    public function down(): void
    {
        Schema::table('user_addresses', function (Blueprint $table) {
            $table->dropForeign(['city_id']);
            $table->dropColumn(['district', 'neighborhood', 'street', 'avenue', 'building', 'apartment']);
        });
    }
};
