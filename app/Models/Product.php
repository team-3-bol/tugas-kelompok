<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    const TYPE_FOOD = 1;
    const TYPE_BEVERAGE = 2;
    const TYPE_MEDICINE = 3;
    const TYPE_UTILITY = 4;

    const TYPES = [
        1 => 'Foods',
        2 => 'Beverages',
        3 => 'Medicines',
        4 => 'Utilities',
    ];
}
