<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'Web Development',
            'slug' => 'web-development',
            'color' => 'bg-green-100'
        ]);

        Category::create([
            'name' => 'Mobile Development',
            'slug' => 'mobile-development',
            'color' => 'bg-yellow-100'
        ]);

        Category::create([
            'name' => 'Ai Engineer',
            'slug' => 'ai-engineer',
            'color' => 'bg-blue-100'
        ]);
    }
}
