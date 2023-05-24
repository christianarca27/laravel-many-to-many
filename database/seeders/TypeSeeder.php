<?php

namespace Database\Seeders;

use App\Models\Type;
use Faker\Generator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Generator $generator)
    {
        $types = ['Front-End', 'Back-end', 'Full-Stack'];

        for ($i = 0; $i < count($types); $i++) {
            $newType = new Type();

            $newType->name = $types[$i];
            $newType->slug = Str::slug($newType->name);
            $newType->description = $generator->text(50);

            $newType->save();
        }
    }
}
