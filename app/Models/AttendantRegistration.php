<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendantRegistration extends Model
{
    use HasFactory;

    protected $fillable = [

        'attendant_list_id',

        'full_name',

        'gender',

        'age_group',

        'indigenous',

        'poor_status',

        'disability',

        'vulnerable_women',

        'residence_type',

        'dsa_covered_by',

        'village',

        'commune',

        'district',

        'province',

        'institution',

        'position',

        'phone',

        'email',

        'allow_photos',

        'remark',

        'network',

        'dsa',

        'unique_count',

        'signature',

        'dsa_status',

        'dsa_approved_by',

        'dsa_approved_at',

        'dsa_rejection_reason',

    ];

    protected $casts = [

        'dsa_approved_at' => 'datetime',

    ];

    public function attendantList()
    {
        return $this->belongsTo(AttendantList::class);
    }

    public function dsaApprover()
    {
        return $this->belongsTo(
            User::class,
            'dsa_approved_by'
        );
    }


    public function getFullAddressAttribute()
    {
        if ($this->residence_type === 'Phnom Penh') {
            return 'Phnom Penh';
        }

        return collect([
            $this->village,
            $this->commune,
            $this->district,
            $this->province,
        ])->filter()->implode(', ');
    }
}
