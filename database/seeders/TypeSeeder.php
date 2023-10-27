<?php

namespace Database\Seeders;

use App\Models\Type;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Faker\Generator as Faker;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $_names = ["Front-end","Back-end","Full-stack"];

        foreach ($_names as $_name) {
            $type = new Type();
            $type->name = $_name;
            $type->description = $faker->text($maxNbChars = 200);
            $type->colour = $faker->hexColor();
            $type->save();
        }
    }
}