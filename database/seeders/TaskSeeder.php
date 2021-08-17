<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\Level;
use App\Models\Category;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
        // TODO: IDのマジックナンバーを定数に置き換える。
        DB::table('tasks')->insert([
            [  'id' =>  1, 'level_id' => Level::BEGINNER, 'category_id' => Category::REMOTE_TOOL, 'description' => ''],
            [  'id' =>  2, 'level_id' => Level::INTERMEDIATE, 'category_id' => Category::REMOTE_TOOL, 'description' => '' ],
            [  'id' =>  3, 'level_id' => Level::BEGINNER, 'category_id' => Category::ENVIRONMENT, 'description' => '' ],
            [  'id' =>  4, 'level_id' => Level::INTERMEDIATE, 'category_id' => Category::ENVIRONMENT, 'description' => '' ],
            [  'id' =>  5, 'level_id' => Level::BEGINNER, 'category_id' => Category::SELF_DISCLOSURE, 'description' => '' ],
            [  'id' =>  6, 'level_id' => Level::INTERMEDIATE, 'category_id' => Category::SELF_DISCLOSURE, 'description' => '' ],
            [  'id' =>  7, 'level_id' => Level::ADVANCED, 'category_id' => Category::MENTAL_SECURITY, 'description' => '' ],
            [  'id' =>  8, 'level_id' => Level::BEGINNER, 'category_id' => Category::THANKS, 'description' => '' ],
            [  'id' =>  9, 'level_id' => Level::INTERMEDIATE, 'category_id' => Category::FEEDBACK, 'description' => '' ],
            [  'id' =>  10, 'level_id' => Level::ADVANCED, 'category_id' => Category::FEEDBACK, 'description' => '' ],
            [  'id' =>  11, 'level_id' => Level::ADVANCED, 'category_id' => Category::THANKS, 'description' => '' ],
            [  'id' =>  12, 'level_id' => Level::INTERMEDIATE, 'category_id' => Category::LIFESTYLE, 'description' => '' ],
            [  'id' =>  13, 'level_id' => Level::INTERMEDIATE, 'category_id' => Category::EAT_HABIT, 'description' => '' ],
            [  'id' =>  14, 'level_id' => Level::INTERMEDIATE, 'category_id' => Category::EXERCISE, 'description' => '' ],
            [  'id' =>  15, 'level_id' => Level::ADVANCED, 'category_id' => Category::SLEEP, 'description' => '' ],
            [  'id' =>  16, 'level_id' => Level::ADVANCED, 'category_id' => Category::WORK_MANAGEMENT, 'description' => '' ],
            [  'id' =>  17, 'level_id' => Level::ADVANCED, 'category_id' => Category::PERFORMANCE, 'description' => '' ],
            [  'id' =>  18, 'level_id' => Level::ADVANCED, 'category_id' => Category::THINKING_HABIT, 'description' => '' ],
            [  'id' =>  19, 'level_id' => Level::ADVANCED, 'category_id' => Category::MINDSET, 'description' => '' ],
            [  'id' =>  20, 'level_id' => '', 'category_id' => Category::MEET_UP_100, 'description' => '' ],
            [  'id' =>  21, 'level_id' => '', 'category_id' => Category::MEET_UP_100, 'description' => '' ],
        ]);
    }
}
