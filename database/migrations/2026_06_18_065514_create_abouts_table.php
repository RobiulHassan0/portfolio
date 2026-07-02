<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->unique()->constrained()->cascadeOnDelete();

            $table->text('description');

            $table->json('highlights')->nullable();

            $table->string('location')->nullable();
            $table->string('availability')->nullable();
            $table->string('workflow')->nullable();

            $table->enum('status', [
                'available_for_work',
                'not_available'
            ])->default('available_for_work');

            $table->string('image_path', 300)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abouts');
    }
};
