<?php

namespace App\Events;

use App\Models\Casting;

class CastingValidated
{
    public $casting;

    public function __construct(Casting $casting)
    {
        $this->casting = $casting;
    }
}
