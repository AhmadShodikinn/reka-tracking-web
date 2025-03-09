<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class TravelDocument extends Model
{
    use HasFactory;

    protected $table = 'travel_document';

    protected $fillable = [
        'no_travel_document', 'date_no_travel_document', 'send_to', 'po_number', 'reference_number', 'project', 'status',
    ];

    public function items()
    {
        return $this->hasMany(Items::class);
    }

    public function trackingSystems()
    {
        return $this->hasMany(TrackingSystem::class);
    }
}
