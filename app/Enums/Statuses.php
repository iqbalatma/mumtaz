<?php

namespace App\Enums;

enum Statuses
{
    case PENDING;
    case ON_GOING;
    case DONE;
    case FEEDBACK;
    case REJECT;
}
