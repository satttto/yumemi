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
            [ 'id' => ParentCategory::REMOTE_TOOL , 'name' => 'リモートツール利用' ],
            [ 'id' => ParentCategory::ENVIRONMENT, 'name' => '環境デザイン' ],
            [ 'id' => ParentCategory::PERSONAL, 'name' => '自己開示・心理的安全性' ],
            [ 'id' => ParentCategory::FEEDBACK, 'name' => 'フィードバック' ],
            [ 'id' => ParentCategory::LIFE_HABIT, 'name' => '生活習慣・食習慣' ],
            [ 'id' => ParentCategory::EXERCISE, 'name' => 'アクティブレスト・運動習慣' ],
            [ 'id' => ParentCategory::SLEEP, 'name' => '睡眠' ],
            [ 'id' => ParentCategory::WORK_HABIT, 'name' => 'ワークハッカーマスター' ],
            [ 'id' => ParentCategory::THNKING_HABIT, 'name' => '思考習慣' ],
            [ 'id' => ParentCategory::COMPANY_GOAL, 'name' => '会社目標達成貢献' ],
        ]);
    }
}