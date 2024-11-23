<?php

namespace App\Enums;

enum ticketStatus : string
{
    case ACTIVE = 'ACTIVE';
    case  REFUNDED = 'REFUNDED';
    case INACTIVE = 'INACTIVE';
}
