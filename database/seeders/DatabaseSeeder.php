<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Category::insert([
            ['name' => 'technology'],
            ['name' => 'health'],
            ['name' => 'business'],
            ['name' => 'culture'],
            ['name' => 'politics'],
            ['name' => 'opinion'],
            ['name' => 'science'],
            ['name' => 'other'],
        ]);
    }
}
