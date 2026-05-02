<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
    'student_id',
    'scholarship_id',
    'reviewer_id',
    'status',
    'score',
    'feedback',
    'applied_date',
    'reviewed_date',
    'personal_statement',
    'transcript_path',
    'recommendation_letter_path',
    'supporting_documents_path',  // ADD THIS
    'academic_score',
    'personal_statement_score',
    'extracurricular_score',
    'recommendations_score',
    'recommendation',
    'evaluated_at',
    ];


    protected $casts = [
    'applied_date' => 'datetime',
    'reviewed_date' => 'datetime',
    'evaluated_at' => 'datetime',
    'score' => 'decimal:2',
    'academic_score' => 'decimal:2',
    'personal_statement_score' => 'decimal:2',
    'extracurricular_score' => 'decimal:2',
    'recommendations_score' => 'decimal:2',
    'supporting_documents_path' => 'array',  // ADD THIS
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function scholarship()
    {
        return $this->belongsTo(Scholarship::class);
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewer_id');
    }
}