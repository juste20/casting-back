<?php

namespace App\Policies;

use App\Models\Admin;

class SubscriptionPolicy
{
    public function manage(Admin $admin)
    {
        return true;
    }
}
