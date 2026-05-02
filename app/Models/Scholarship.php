<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scholarship extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category',
        'amount',
        'start_date',
        'end_date',
        'description',
        'requirements',
        'status',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'amount' => 'decimal:2',
        'requirements' => 'array',
    ];

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'published')
                     ->where('start_date', '<=', now())
                     ->where('end_date', '>=', now());
    }

    // Default requirements that cannot be changed
    public static function getDefaultRequirements()
    {
        return [
            'Report Card / TOR',
            'ALS Accreditation & Equivalency (if applicable)',
            'Certificate of Residency (Original)',
            'Certificate of Good Moral Character (Photocopy)',
            'Certificate of Indigency or Eligibility (Original)',
            'ITR of both parents or Certificate of Tax Exemption (Photocopy)',
            '2x2 I.D. picture'
        ];
    }

    // Format requirements as array
    public function getFormattedRequirementsAttribute()
    {
        if ($this->requirements) {
            return is_array($this->requirements) ? $this->requirements : json_decode($this->requirements, true);
        }
        return self::getDefaultRequirements();
    }

    // Get requirements as HTML list
    public function getRequirementsHtmlAttribute()
    {
        $requirements = $this->getFormattedRequirementsAttribute();
        $html = '<ul class="list-disc list-inside space-y-1">';
        foreach ($requirements as $req) {
            $html .= '<li>' . e($req) . '</li>';
        }
        $html .= '</ul>';
        return $html;
    }
}