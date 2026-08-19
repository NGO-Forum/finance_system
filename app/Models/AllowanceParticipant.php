<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AllowanceParticipant extends Model
{
    protected $fillable = [
        'allowance_form_id',
        'name',
        'gender',
        'organization',
        'position',
        'province',
        'distance',
        'costs',
        'breakfast',
        'lunch',
        'dinner',
        'accommodation',
        'taxi',
        'local_transport',
        'other',
        'total',
        'remarks',
    ];

    protected $casts = [
        'costs' => 'array',
    ];

    public function allowanceForm()
    {
        return $this->belongsTo(AllowanceForm::class);
    }
}
