<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'warehouse_id',
        'item_id',
        'status',
        'transaction_date',
    ];

    // Define relationships
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function warehouse() {
        return $this->belongsTo(Warehouse::class);
    }

    public function item() {
        return $this->belongsTo(Item::class);
    }
}
