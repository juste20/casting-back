<?php

namespace App\Helpers;

class HashHelper
{
    public static function make($value)
    {
        return hash('sha256',$value);
    }
}
