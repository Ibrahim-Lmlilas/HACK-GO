<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('city');
            $table->float('rating', 2, 1)->default(0);
            $table->decimal('price_mad', 10, 2);
            $table->text('description')->nullable();
            $table->string('address')->nullable();
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
            $table->string('image_url')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hotels');
    }
};
