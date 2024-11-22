<?php

namespace App\Models\Discount;

use Illuminate\Database\Eloquent\Model;

class DiscountStudent  implements Discount
{
    //
    public static function makeDiscount($amount)
    {
        return $amount - ($amount * .1);
    }
}
