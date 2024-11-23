<?php

namespace App\Models\Discount;

use Illuminate\Database\Eloquent\Model;

class DiscountSeniors  implements Discount
{
    //
    public static function makeDiscount($amount)
    {
        $amount = (float) $amount;
        return $amount - ($amount * 0.2);
    }
}
