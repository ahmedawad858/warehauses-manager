<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{

    use HasFactory;

    protected $fillable = [
        'name',
        'warehouse_id',
        'description',
        'quantity',
    ];

    // Define relationships, if any
    // For example:
    // public function transactions() {
    //     return $this->hasMany(Transaction::class);
    // }

    public function warehouse() {
        return $this->belongsTo(Warehouse::class);
    }
}
