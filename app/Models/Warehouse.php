<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
    ];

    // Define relationships
    // public function transactions() {
    //     return $this->hasMany(Transaction::class);
    // }
    // Define the one-to-many relationship with items
    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
