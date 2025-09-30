<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MasterItem extends Model
{
    use HasFactory;

    protected $table = 'master_items';

    protected $fillable = ['item_code', 'item_name', 'description'];

    public function items()
    {
        return $this->hasMany(Items::class);
    }
}
