<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Payment;
use Illuminate\Support\Str;

class PaymentSeeder extends Seeder
{
    public function run(): void
    {
        Payment::create([
            'email'=>'test@mail.com',
            'amount'=>2000,
            'method'=>'momo',
            'reference'=>Str::uuid(),
            'status'=>'success'
        ]);
    }
}
