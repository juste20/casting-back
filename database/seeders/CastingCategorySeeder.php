<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CastingCategory;

class CastingCategorySeeder extends Seeder
{
    public function run(): void
    {
        foreach (['Cinéma','Théâtre','Télévision & Web','Publicité','Autre (autres spécificités ou +18)',] as $cat) {
            CastingCategory::create(['name'=>$cat]);
        }
    }
}
