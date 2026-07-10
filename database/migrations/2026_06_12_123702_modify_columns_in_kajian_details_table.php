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
        Schema::table('kajian_details', function (Blueprint $table) {
            $table->foreignUuid('location_id')->after('ustadz_id')->constrained('locations')->cascadeOnDelete();
            $table->dropColumn('information');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kajian_details', function (Blueprint $table) {
            $table->dropForeign(['location_id']);
            $table->dropColumn('location_id');
            $table->string('information')->after('poster');
        });
    }
};
