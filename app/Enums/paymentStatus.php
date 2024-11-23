<?php

namespace App\Enums;

enum paymentStatus : string
{
    case PENDING = 'pending';
    case  REFUNDED = 'refunded';
    case PAID = 'paid';
}
