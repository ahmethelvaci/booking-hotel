<?php

namespace App\Enums;

enum RoomType: string
{
    case FullPension = 'full-pension';
    case HalfPension = 'half-pension';
    case BreakfastOnly = 'breakfalt-only';
    case RoomOnly = 'room-only';
}
