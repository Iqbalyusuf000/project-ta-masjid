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
        Schema::create('donation_transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('donation_code');
            $table->foreignUuid('donation_category_id')->constrained('donation_categories')->cascadeOnDelete();
            $table->string('source');
            $table->string('donation_name')->nullable();
            $table->decimal('amount', 15, 2);
            $table->integer('unique_code');
            $table->decimal('total_amount', 15, 2);
            $table->string('payment_method');
            $table->string('status');
            $table->string('reference_type');
            $table->uuid('reference_id')->nullable();
            $table->foreignUuid('verified_by')->constrained('users')->cascadeOnDelete();
            $table->string('verified_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donation_transactions');
    }
};
