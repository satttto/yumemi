<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\Level;
use App\Models\ParentCategory;
use App\Models\Category;
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

        // Insert parent category samples
        $parentRemoteTool = ParentCategory::create(['name' => 'リモートツール利用']);
        $parentEnvironment = ParentCategory::create(['name' => '環境デザイン']);

        
        // Insert category samples
        $remoteTool = Category::create([
            'name' => 'リモートツールワーク利用',
            'parent_category_id' => $parentRemoteTool->id,
        ]);
        $environment = Category::create([
            'name' => '環境デザイン',
            'parent_category_id' => $parentEnvironment->id,
        ]);


        // Insert level samples
        $beginner = Level::create(['name' => '初級']);
        $intermediate = Level::create(['name' => '中級']);
        $advanced = Level::create(['name' => '上級']);



        // Insert task samples
        Task::create([
            'level_id' => $beginner->id,
            'category_id' => $remoteTool->id,
            'name' => '下記のSlackの基本的な使い方を実施している',
            'description' => '',
        ]);
        Task::create([
            'level_id' => $intermediate->id,
            'category_id' => $remoteTool->id,
            'name' => 'バーチャルオフィスツールoViceを３回以上利用したことがある',
            'description' => '',
        ]);
        Task::create([
            'level_id' => $beginner->id,
            'category_id' => $environment->id,
            'name' => '自宅での作業環境を、自宅の環境・制約がある中でも、自身なりに工夫して構築した。必ずしも最適な環境が整っている必要はない',
            'description' => '',
        ]);
        Task::create([
            'level_id' => $intermediate->id,
            'category_id' => $environment->id,
            'name' => 'SNSに依存しないように、見るタイミングを定めて概ねコントロールができている（１週間の中で４日以上）',
            'description' => '',
        ]);
    }
}
