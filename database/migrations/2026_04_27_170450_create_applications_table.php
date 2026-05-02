<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('scholarship_id')->constrained('scholarships')->onDelete('cascade');
            $table->foreignId('reviewer_id')->nullable()->constrained('users')->onDelete('set null');
            $table->enum('status', ['pending', 'assigned', 'reviewed', 'approved', 'rejected'])->default('pending');
            $table->decimal('score', 5, 2)->nullable();
            $table->text('feedback')->nullable();
            $table->datetime('applied_date');
            $table->datetime('reviewed_date')->nullable();
            
            // Student submission fields
            $table->text('personal_statement')->nullable();
            $table->string('transcript_path')->nullable();
            $table->string('recommendation_letter_path')->nullable();
            
            // Reviewer scoring fields
            $table->decimal('academic_score', 5, 2)->nullable();
            $table->decimal('personal_statement_score', 5, 2)->nullable();
            $table->decimal('extracurricular_score', 5, 2)->nullable();
            $table->decimal('recommendations_score', 5, 2)->nullable();
            $table->enum('recommendation', ['approve', 'reject'])->nullable();
            $table->datetime('evaluated_at')->nullable();
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('applications');
    }
};