<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Projects extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_code',
        'project_name',
        'start_date',
        'end_date',
        'description',
    ];

    public function travelDocuments()
    {
        return $this->hasMany(TravelDocument::class);
    }
}
