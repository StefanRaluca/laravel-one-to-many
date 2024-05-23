<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            [
                'name' => 'Web Development',
                'slug' => Str::of('name')->slug('-'),
                'description' => 'Projects related to AI development.',
                'active' => true,
            ],
            [
                'name' => 'Mobile App Dev',
                'slug' => Str::of('name')->slug('-'),
                'description' => 'Projects related to mobile application.',
                'active' => true,
            ],
            [
                'name' => 'Graphic Design',
                'slug' => Str::of('name')->slug('-'),
                'description' => 'Projects related to UI design.',
                'active' => true,
            ]
        ];
        foreach ($types as $type) {
            Type::create($type);
        }
    }
}