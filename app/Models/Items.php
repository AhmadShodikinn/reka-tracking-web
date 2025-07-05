<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    use HasFactory;

    protected $table = 'items'; 

    protected $fillable = [
        'travel_document_id', 'master_item_id', 'qty_send', 'total_send', 'qty_po', 'unit_id', 'information'
    ];

    public function travelDocument()
    {
        return $this->belongsTo(TravelDocument::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function masterItem()
    {
        return $this->belongsTo(MasterItem::class);
    }

}
