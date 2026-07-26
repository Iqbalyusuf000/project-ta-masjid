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
        Schema::create('itikaf_registrations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('itikaf_code')->unique();
            $table->string('name');
            $table->string('whatsapp');
            $table->enum('gender', ['L', 'P']);
            $table->json('days_selected');
            $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('itikaf_registrations');
    }
};
