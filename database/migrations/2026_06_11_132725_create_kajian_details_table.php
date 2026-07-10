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
        Schema::create('kajian_details', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('kajian_id')->constrained('kajians')->cascadeOnDelete();
            $table->foreignUuid('ustadz_id')->constrained('ustadzs')->cascadeOnDelete();
            $table->string('sub_title');
            $table->date('date');
            $table->string('time_type');
            $table->time('start_time');
            $table->string('time_phrase');
            $table->string('note');
            $table->string('poster');
            $table->string('information');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kajian_details');
    }
};
