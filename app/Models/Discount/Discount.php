<?php

namespace App\Models\Discount;

use Illuminate\Database\Eloquent\Model;

interface Discount
{
    public static function makeDiscount($amount);
}
