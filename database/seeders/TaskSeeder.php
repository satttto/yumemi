<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Level;
use App\Models\Category;
use App\Models\ParentCategory;
use App\Models\Task;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
        // Create categories 
        ParentCategory::factory(10)->create();
        Category::factory(100)->create();

        // Insert level samples
        Level::create(['text_jp' => '初級']);
        Level::create(['text_jp' => '中級']);
        Level::create(['text_jp' => '上級']);

        // Insert task samples
        Task::factory(100)->create();        
    }
}
