<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            if (!Schema::hasColumn('applications', 'academic_score')) {
                $table->decimal('academic_score', 5, 2)->nullable();
            }
            if (!Schema::hasColumn('applications', 'personal_statement_score')) {
                $table->decimal('personal_statement_score', 5, 2)->nullable();
            }
            if (!Schema::hasColumn('applications', 'extracurricular_score')) {
                $table->decimal('extracurricular_score', 5, 2)->nullable();
            }
            if (!Schema::hasColumn('applications', 'recommendations_score')) {
                $table->decimal('recommendations_score', 5, 2)->nullable();
            }
            if (!Schema::hasColumn('applications', 'recommendation')) {
                $table->enum('recommendation', ['approve', 'reject'])->nullable();
            }
            if (!Schema::hasColumn('applications', 'evaluated_at')) {
                $table->timestamp('evaluated_at')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->dropColumn([
                'academic_score',
                'personal_statement_score',
                'extracurricular_score',
                'recommendations_score',
                'recommendation',
                'evaluated_at'
            ]);
        });
    }
};