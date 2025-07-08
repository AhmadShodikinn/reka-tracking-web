<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Preorder extends Model
{
    use HasFactory;

    protected $fillable = [
        'partner_id',
        'project_id',
        'po_number',
    ];

    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }

    public function project()
    {
        return $this->belongsTo(Projects::class);
    }

    public function items()
    {
        return $this->hasMany(PreorderItem::class);
    }
}
