<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\ParentCategory;

class ParentCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('parent_categories')->insert([
            [ 'id' => ParentCategory::REMOTE_TOOL.id , 'name' => 'リモートツール利用' ],
            [ 'id' => ParentCategory::ENVIRONMENT.id, 'name' => '環境デザイン' ],
            [ 'id' => ParentCategory::PERSONAL.id, 'name' => '自己開示・心理的安全性' ],
            [ 'id' => ParentCategory::FEEDBACK.id, 'name' => 'フィードバック' ],
            [ 'id' => ParentCategory::LIFE_HABIT.id, 'name' => '生活習慣・食習慣' ],
            [ 'id' => ParentCategory::EXERCISE.id, 'name' => 'アクティブレスト・運動習慣' ],
            [ 'id' => ParentCategory::SLEEP.id, 'name' => '睡眠' ],
            [ 'id' => ParentCategory::WORK_HABIT.id, 'name' => 'ワークハッカーマスター' ],
            [ 'id' => ParentCategory::THNKING_HABIT.id, 'name' => '思考習慣' ],
            [ 'id' => ParentCategory::COMPANY_GOAL.id, 'name' => '会社目標達成貢献' ],
        ]);
    }
}