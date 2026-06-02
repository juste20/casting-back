<?php

namespace App\Policies;

use App\Models\Admin;

class PaymentPolicy
{
    public function view(Admin $admin)
    {
        return true;
    }
}
