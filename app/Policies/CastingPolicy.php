<?php

namespace App\Policies;

use App\Models\Admin;

class CastingPolicy
{
    public function manage(Admin $admin)
    {
        return true;
    }
}
