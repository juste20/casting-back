<?php

namespace App\Events;

use App\Models\Casting;

class CastingCreated
{
    public $casting;

    public function __construct(Casting $casting)
    {
        $this->casting = $casting;
    }
}
