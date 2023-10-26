<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Type;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

use Faker\Generator as Faker;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // $_projects = config('projects');

        $_types = Type::all()->pluck('id');

        $_types[] = null;
        
        

        // in preparation to real data

        // foreach($_projects as $_project) {

        //     $_type_id = $faker->randomElement($_types);

        //     $project = new Project();
        //     $project->type_id = $_type_id;
        //     $project->name = $_project['name'];
        //     $project->slug = Str::slug($project->name);
        //     $project->description = $_project['description'];
        //     $project->repository = $_project['repository'];
        //     $project->save();

        // }

        for($i = 0; $i < 40; $i++) {
            $_type_id = $faker->randomElement($_types);
      
            $project = new Project();
            $project->type_id = $_type_id;
            $project->name = $faker->name;
            $project->slug = Str::slug($project->name);
            $project->description = $faker->text;
            $project->repository = $faker->url;
            $project->save();
        }

     }
}