<?php

namespace App\Models\Discount;

use Illuminate\Database\Eloquent\Model;

class DiscountMilitary implements Discount

{
    //
    public static function makeDiscount($amount)
    {
        $amount = (float) $amount;
        return $amount - ($amount * 0.15);
    }
}
