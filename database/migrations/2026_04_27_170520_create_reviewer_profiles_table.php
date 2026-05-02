<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('reviewer_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->text('expertise')->nullable();
            $table->integer('experience_years')->nullable();
            $table->json('assigned_categories')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->datetime('approved_at')->nullable();
            $table->datetime('rejected_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reviewer_profiles');
    }
};