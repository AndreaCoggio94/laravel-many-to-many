<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Technology;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Faker\Generator as Faker;

class ProjectTechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $_projects = Project::all();

        $_technologies = Technology::all()->pluck('id')->toArray();

        foreach($_projects as $_project) {
            $_project
            ->technologies()
            ->attach($faker->randomElements($_technologies, random_int(0,3)));
        }

    }
}