<?php

namespace App\Helpers;

class DateHelper
{
    public static function now()
    {
        return now()->format('Y-m-d H:i:s');
    }
}
