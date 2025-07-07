<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Partner extends Model
{
    use HasFactory;

    protected $fillable = [
        'contact_name',
        'company_name',
        'company_address',
        'company_phone',
        'company_email',
    ];

    public function travelDocuments()
    {
        return $this->hasMany(TravelDocument::class, 'send_to_id');
    }
}
