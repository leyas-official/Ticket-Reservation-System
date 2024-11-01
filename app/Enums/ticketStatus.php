<?php

namespace App\Enums;

enum ticketStatus : string
{
    case ACTIVE = 'ACTIVE';
    case  CANCELED = 'CANCELED';
    case USED = 'USED';
}
