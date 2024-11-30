<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Programming',
                'slug' => 'programming',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Grapich Design',
                'slug' => 'graphic-design',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

       foreach($categories as $category) {  
            Category::create($category);
       }
    }
}
