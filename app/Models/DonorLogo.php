<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonorLogo extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'logo',
    ];

    public function fundRequests()
    {
        return $this->belongsToMany(FundRequest::class);
    }

    public function allowanceForms()
    {
        return $this->belongsToMany(AllowanceForm::class);
    }

    public function attendantLists()
    {
        return $this->belongsToMany(
            AttendantList::class,
            'attendant_list_donor_logo'
        );
    }
}
