<?php

namespace App;

enum ticketStatus : string
{
    case ACTIVE = 'ACTIVE';
    case  CANCELED = 'CANCELED';
    case USED = 'USED';
}
