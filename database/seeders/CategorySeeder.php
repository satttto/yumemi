<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\ParentCategory;
use App\Models\Category;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [ 'id' => Category::REMOTE_TOOL , 'name' => 'リモートツールワーク利用', 'parent_category_id' => ParentCategory::REMOTE_TOOL ],
            [ 'id' => Category::ENVIRONMENT, 'name' => '環境デザイン', 'parent_category_id' => ParentCategory::ENVIRONMENT ],
            [ 'id' => Category::SELF_DISCLOSURE, 'name' => '自己開示', 'parent_category_id' => ParentCategory::PERSONAL ],
            [ 'id' => Category::MENTAL_SAFETY, 'name' => '心理的安全性の確保', 'parent_category_id' => ParentCategory::PERSONAL ],
            [ 'id' => Category::THANKS, 'name' => '感謝', 'parent_category_id' => ParentCategory::FEEDBACK ],
            [ 'id' => Category::FEEDBACK, 'name' => 'フィードバック', 'parent_category_id' => ParentCategory::FEEDBACK ],
            [ 'id' => Category::LIFESTYLE, 'name' => '生活習慣', 'parent_category_id' => ParentCategory::LIFE_HABIT ],
            [ 'id' => Category::EAT_HABIT, 'name' => '食習慣', 'parent_category_id' => ParentCategory::LIFE_HABIT ],
            [ 'id' => Category::EXERCISE, 'name' => 'アクティブレスト・運動習慣', 'parent_category_id' => ParentCategory::EXERCISE ],
            [ 'id' => Category::SLEEP, 'name' => '睡眠', 'parent_category_id' => ParentCategory::SLEEP ],
            [ 'id' => Category::WORK_HABIT, 'name' => '行動管理', 'parent_category_id' => ParentCategory::WORK_HABIT ],
            [ 'id' => Category::PERFORMANCE, 'name' => 'パフォーマンス向上', 'parent_category_id' => ParentCategory::WORK_HABIT ],
            [ 'id' => Category::THNKING_HABIT, 'name' => '思考習慣', 'parent_category_id' => ParentCategory::THNKING_HABIT ],
            [ 'id' => Category::MINDSET, 'name' => 'マインドセットや概念理解', 'parent_category_id' => ParentCategory::THNKING_HABIT ],
            [ 'id' => Category::MEET_UP_100, 'name' => '勉強会月間100件達成', 'parent_category_id' => ParentCategory::COMPANY_GOAL ],
        ]);
    }
}

