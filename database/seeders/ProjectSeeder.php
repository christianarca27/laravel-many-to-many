<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Type;
use Faker\Generator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Generator $generator)
    {
        $types = Type::all();

        for ($i = 0; $i < 10; $i++) {
            $newProject = new Project();

            $newProject->title = $generator->sentence(3);
            $newProject->type_id = $generator->randomElement($types)->id;
            $newProject->description = $generator->paragraph();
            $newProject->url = 'https://github.com/christianarca27/' . $generator->word() . '.git';
            $newProject->slug = Str::slug($newProject->title);

            $newProject->save();
        }
    }
}
