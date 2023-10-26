<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Faker\Generator as Faker;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $_labels = ["HTML", "CSS", "SQL", "JavaScript", "PHP", "GIT", "Blade","Vue"];

        foreach($_labels as $_label) {
            $technology = new Technology();
            $technology->label = $_label;
            $technology->colour = $faker->hexColor();
            $technology->save();
        }
    }
}