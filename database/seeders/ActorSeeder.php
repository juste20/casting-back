<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Actor;

class ActorSeeder extends Seeder
{
    public function run(): void
    {
        Actor::insert([
            [
                'name'=>'Denzel Washington',
                'country'=>'USA',
                'description'=>'Acteur oscarisé',
                'image'=>'https://i.pinimg.com/736x/f2/81/ac/f281acfb077e5e821e2619e2b7f61e33.jpg'
            ],
            [
                'name'=>'Omar Sy',
                'country'=>'France',
                'description'=>'Acteur franco-sénégalais',
                'image'=>'https://i.pinimg.com/736x/2c/d1/ab/2cd1ab857b4ce881fd8b8b244d71fc4b.jpg'
            ]
        ]);
    }
}
