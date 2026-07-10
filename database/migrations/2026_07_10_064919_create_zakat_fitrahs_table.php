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
        Schema::create('zakat_fitrahs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('zakat_code')->unique();
            $table->string('muzakki_name');
            $table->string('address');
            $table->integer('total_people');
            $table->decimal('rice_total', 5, 2);
            $table->enum('zakat_status', ['pending', 'confirmed'])->default('pending');
            $table->string('verified_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zakat_fitrahs');
    }
};
