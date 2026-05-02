<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'password',
        'role',
        'status',
        'education_level',
        'occupation',
        'resume_path',
        'proof_of_expertise_path',
        'address',
        'phone',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Helper methods
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isStudent()
    {
        return $this->role === 'student';
    }

    public function isReviewer()
    {
        return $this->role === 'reviewer';
    }

    public function getFullNameAttribute()
    {
        return trim("{$this->first_name} {$this->middle_name} {$this->last_name}");
    }

    // Relationships
    public function scholarships()
    {
        return $this->belongsToMany(Scholarship::class, 'applications', 'student_id', 'scholarship_id');
    }

    public function reviewerAssignments()
    {
        return $this->hasMany(Application::class, 'reviewer_id');
    }
    
    public function applications()
    {
        return $this->hasMany(Application::class, 'student_id');
    }
    
    public function reviewerProfile()
    {
        return $this->hasOne(ReviewerProfile::class);
    }
}