<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewerProfile extends Model
{
    use HasFactory;

    protected $table = 'reviewer_profiles';

    protected $fillable = [
        'user_id',
        'assigned_categories',
        'status',
        'approved_at',
        'rejected_at',
    ];

    protected $casts = [
        'assigned_categories' => 'array',
        'approved_at' => 'datetime',
        'rejected_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isApproved()
    {
        return $this->status === 'approved';
    }

    public function isPending()
    {
        return $this->status === 'pending';
    }

    public function isRejected()
    {
        return $this->status === 'rejected';
    }

    public function getAssignedCategoriesListAttribute()
    {
        if (!$this->assigned_categories) {
            return 'Unassigned';
        }
        
        $categories = is_array($this->assigned_categories) 
            ? $this->assigned_categories 
            : json_decode($this->assigned_categories, true);
            
        return implode(', ', $categories);
    }
}