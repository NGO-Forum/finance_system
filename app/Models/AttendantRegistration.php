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

        'unique_count',

        'signature',

    ];

    public function attendantList()
    {
        return $this->belongsTo(AttendantList::class);
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
