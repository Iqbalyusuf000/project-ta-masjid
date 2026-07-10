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
        Schema::table('donation_transactions', function (Blueprint $table) {
            $table->foreignUuid('verified_by')->nullable()->change();
        });

        Schema::table('donation_categories', function (Blueprint $table) {
            $table->string('icon')->nullable();
            $table->decimal('target_amount', 15, 2)->nullable();
            $table->string('badge')->nullable();
        });

        Schema::table('donation_settings', function (Blueprint $table) {
            $table->decimal('rice_weight', 4, 2)->default(3.00);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('donation_transactions', function (Blueprint $table) {
            $table->foreignUuid('verified_by')->nullable(false)->change();
        });

        Schema::table('donation_categories', function (Blueprint $table) {
            $table->dropColumn(['icon', 'target_amount', 'badge']);
        });

        Schema::table('donation_settings', function (Blueprint $table) {
            $table->dropColumn('rice_weight');
        });
    }
};
