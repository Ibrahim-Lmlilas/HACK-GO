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
        Schema::create('accommodations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_id')->constrained('accommodation_types');
            $table->foreignId('destination_id')->constrained('destinations');
            $table->string('name', 100)->notNullable();
            $table->text('description')->nullable();
            $table->decimal('price_per_night', 10, 2)->nullable();
            $table->text('address')->nullable();
            $table->text('images')->nullable()->comment('Stored as JSON array of image URLs');
            $table->text('amenities')->nullable()->comment('Stored as JSON array of amenities');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accommodations');
    }
};
