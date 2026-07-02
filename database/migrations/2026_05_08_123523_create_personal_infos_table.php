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
        Schema::create('personal_infos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->unique()
                ->constrained('users')
                ->cascadeOnDelete();
            
            $table->string('designation', 50)->nullable();
            $table->text('bio')->nullable();

            $table->string('profile_photo', 300)->nullable();
            $table->string('resume_url', 300)->nullable();

            $table->json('stack')->nullable();
            $table->string('focus', 150)->nullable();

            $table->boolean('is_available')->default(true);
            $table->string('availability_text', 100)->nullable();

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_infos');
    }
};
