<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    const TYPES = [
        1 => 'Foods',
        2 => 'Beverages',
        3 => 'Medicines',
        4 => 'Utilities',
    ];
}
