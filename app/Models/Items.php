<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    use HasFactory;

    protected $table = 'items'; 

    protected $fillable = [
        'travel_document_id', 'item_code', 'item_name', 'qty_send', 'total_send', 'qty_po', 'unit', 'description', 'information'
    ];

    public function travelDocument()
    {
        return $this->belongsTo(TravelDocument::class);
    }
}
