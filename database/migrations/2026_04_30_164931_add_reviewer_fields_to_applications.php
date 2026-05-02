<?php
// database/migrations/2026_04_30_000001_add_reviewer_fields_to_applications.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('applications', function (Blueprint $table) {
            if (!Schema::hasColumn('applications', 'academic_score')) {
                $table->decimal('academic_score', 5, 2)->nullable()->after('score');
            }
            if (!Schema::hasColumn('applications', 'personal_statement_score')) {
                $table->decimal('personal_statement_score', 5, 2)->nullable()->after('academic_score');
            }
            if (!Schema::hasColumn('applications', 'extracurricular_score')) {
                $table->decimal('extracurricular_score', 5, 2)->nullable()->after('personal_statement_score');
            }
            if (!Schema::hasColumn('applications', 'recommendations_score')) {
                $table->decimal('recommendations_score', 5, 2)->nullable()->after('extracurricular_score');
            }
            if (!Schema::hasColumn('applications', 'recommendation')) {
                $table->enum('recommendation', ['approve', 'reject'])->nullable()->after('feedback');
            }
            if (!Schema::hasColumn('applications', 'evaluated_at')) {
                $table->datetime('evaluated_at')->nullable()->after('reviewed_date');
            }
        });
    }

    public function down()
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