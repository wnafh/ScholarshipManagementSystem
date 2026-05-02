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
        Schema::table('applications', function (Blueprint $table) {
            if (!Schema::hasColumn('applications', 'personal_statement' )){
                $table->text('personal_statement')->nullable()->after('feedback');
            }
            if (!Schema::hasColumn('applications', 'transcript_path' )){
                $table->string('transcript_path')->nullable()->after('personal_statement');
            }
             if (!Schema::hasColumn('applications', 'recommendation_letter_path' )){
                $table->string('recommendation_letter_path')->nullable()->after('transcript_path');
            }
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
        $table->dropColumn(['personal_statement', 'transcript_path', 'recommendation_letter_path']);
        });
    }
};
