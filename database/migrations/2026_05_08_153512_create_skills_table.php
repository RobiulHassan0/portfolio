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
        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            
            $table->enum('category', ['frontend', 'backend'])->default('frontend');
            $table->string('name', 50);
            $table->string('description', 150)->nullable();
            $table->enum('level', ["Beginner", "Intermediate", "Expert"])->default('Beginner');
            $table->string('icon')->nullable();
            $table->boolean('featured')->default(false);

            $table->unsignedTinyInteger('proficiency')->default(80) ;

            $table->unsignedInteger('sort_order')->default(0) ;
            $table->boolean('is_active')->default(true) ;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skills');
    }
};
