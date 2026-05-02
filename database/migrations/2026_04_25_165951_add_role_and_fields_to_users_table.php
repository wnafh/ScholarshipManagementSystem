<?php
// database/migrations/2026_04_25_165951_add_role_and_fields_to_users_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Add first_name, middle_name, last_name if they don't exist
            if (!Schema::hasColumn('users', 'first_name')) {
                $table->string('first_name')->after('id');
                $table->string('middle_name')->nullable()->after('first_name');
                $table->string('last_name')->after('middle_name');
            }
            
            // Add role column if it doesn't exist
            if (!Schema::hasColumn('users', 'role')) {
                $table->enum('role', ['student', 'reviewer', 'admin'])->default('student')->after('email');
            }
            
            // Remove old name column if exists (Laravel default)
            if (Schema::hasColumn('users', 'name')) {
                $table->dropColumn('name');
            }
            
            // Add student education level if it doesn't exist
            if (!Schema::hasColumn('users', 'education_level')) {
                $table->string('education_level')->nullable()->after('role');
            }
            
            // Add reviewer fields if they don't exist
            if (!Schema::hasColumn('users', 'occupation')) {
                $table->string('occupation')->nullable()->after('education_level');
            }
            if (!Schema::hasColumn('users', 'resume_path')) {
                $table->string('resume_path')->nullable()->after('occupation');
            }
            if (!Schema::hasColumn('users', 'proof_of_expertise_path')) {
                $table->string('proof_of_expertise_path')->nullable()->after('resume_path');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'first_name',
                'middle_name',
                'last_name',
                'role',
                'education_level',
                'occupation',
                'resume_path',
                'proof_of_expertise_path'
            ]);
            
            // Add back the name column if needed
            if (!Schema::hasColumn('users', 'name')) {
                $table->string('name')->nullable();
            }
        });
    }
};