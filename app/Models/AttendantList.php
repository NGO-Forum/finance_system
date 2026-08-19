<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttendantList extends Model
{
    protected $fillable = [

        'title',

        'activity_date',

        'start_time',
        
        'end_time',

        'venue',

        'donor_logo_id',

        'registration_enabled',

        'registration_token',

        'registration_link',

        'qr_code_path',

        'max_participants',

        'created_by',

    ];

    protected $casts = [

        'activity_date' => 'date',

        'registration_enabled' => 'boolean',

    ];


    public function donorLogos()
    {
        return $this->belongsToMany(
            DonorLogo::class,
            'attendant_list_donor_logo'
        );
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function registrations()
    {
        return $this->hasMany(AttendantRegistration::class);
    }

    public function getRegisteredCountAttribute()
    {
        return $this->registrations()->count();
    }

    public function getRemainingSeatsAttribute()
    {
        if (!$this->max_participants) {
            return null;
        }

        return max(
            $this->max_participants - $this->registrations()->count(),
            0
        );
    }
}
