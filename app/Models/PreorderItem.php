<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PreorderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'preorder_id',
        'master_item_id',
        'unit_id',
        'qty_po',
        'information',
    ];

    public function preorder()
    {
        return $this->belongsTo(Preorder::class);
    }

    public function masterItem()
    {
        return $this->belongsTo(MasterItem::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
