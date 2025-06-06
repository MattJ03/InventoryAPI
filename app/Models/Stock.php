<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = ['name', 'capacity', 'price', 'inStock'];

    public function user() {
        return $this->belongsTo(User::class);
    }
    
}
