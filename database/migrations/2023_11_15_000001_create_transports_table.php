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
        Schema::create('transports', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['car', 'bus', 'van', 'motorcycle', 'bicycle', 'boat',]);
            $table->integer('capacity');
            $table->decimal('price_per_day', 10, 2);
            $table->string('image')->nullable();
            $table->foreignId('destination_id')->nullable()->constrained()->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transports');
    }
};
