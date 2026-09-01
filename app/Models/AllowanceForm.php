<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AllowanceForm extends Model
{
    protected $fillable = [
        'allowance_no',
        'attendant_list_id',
        'activity',
        'start_date',
        'end_date',
        'program',
        'venue',
        'donor',
        'donor_code',
        'budget_code',
        'created_by',
        'dates',
    ];

    protected $casts = [
        'dates' => 'array',
    ];

    public function participants()
    {
        return $this->hasMany(AllowanceParticipant::class);
    }

    public function donorLogos()
    {
        return $this->belongsToMany(DonorLogo::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function attendantList()
    {
        return $this->belongsTo(
            AttendantList::class,
            'attendant_list_id'
        );
    }
}
