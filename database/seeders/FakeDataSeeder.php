<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subscription;

class FakeDataSeeder extends Seeder
{
    public function run(): void
    {
        Subscription::create([
            'fullname'=>'Test User',
            'email'=>'user@mail.com',
            'country'=>'CI',
            'actor_id'=>1,
            'categories'=>['Cinéma','Théâtre'],
            'status'=>'pending'
        ]);
    }
}
