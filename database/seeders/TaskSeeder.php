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
        $parentRemoteTool = ParentCategory::create(['text_jp' => 'リモートツール利用']);
        $parentEnvironment = ParentCategory::create(['text_jp' => '環境デザイン']);
        $parentSelf = ParentCategory::create(['text_jp' => '自己開示・心理的安全性']);
        $parentFeedback = ParentCategory::create(['text_jp' => 'フィードバック']);
        $parentHabit = ParentCategory::create(['text_jp' => '生活習慣・食習慣']);
        $parentExercise= ParentCategory::create(['text_jp' => 'アクティブレスト・運動習慣']);
        $parentSleep = ParentCategory::create(['text_jp' => '睡眠']);
        $parentWork = ParentCategory::create(['text_jp' => 'ワークハッカー']);
        $parentMind = ParentCategory::create(['text_jp' => '思考習慣']);
        $parentCompany = ParentCategory::create(['text_jp' => '会社目標達成貢献']);
        
        // Insert category samples
        $remoteTool = Category::create([
            'text_jp' => 'リモートツールワーク利用',
            'parent_category_id' => $parentRemoteTool->id,
        ]);
        $environment = Category::create([
            'text_jp' => '環境デザイン',
            'parent_category_id' => $parentEnvironment->id,
        ]);
        $selfDisclosure = Category::create([
            'text_jp' => '自己開示',
            'parent_category_id' => $parentSelf->id,
        ]);
        $mentalSafety = Category::create([
            'text_jp' => '心理的安全性の確保',
            'parent_category_id' => $parentSelf->id,
        ]);
        $thanks = Category::create([
            'text_jp' => '感謝',
            'parent_category_id' => $parentFeedback->id,
        ]);
        $feedback = Category::create([
            'text_jp' => 'フィードバック',
            'parent_category_id' => $parentFeedback->id,
        ]);
        $lifeStyle = Category::create([
            'text_jp' => '生活習慣',
            'parent_category_id' => $parentHabit->id,
        ]);
        $eatHabit = Category::create([
            'text_jp' => '食習慣',
            'parent_category_id' => $parentHabit->id,
        ]);
        $activeRest = Category::create([
            'text_jp' => 'アクティブレスト',
            'parent_category_id' => $parentExercise->id,
        ]);
        $exercise = Category::create([
            'text_jp' => '運動習慣',
            'parent_category_id' => $parentExercise->id,
        ]);
        $sleep = Category::create([
            'text_jp' => '睡眠',
            'parent_category_id' => $parentSleep->id,
        ]);
        $action = Category::create([
            'text_jp' => '行動管理',
            'parent_category_id' => $parentWork->id,
        ]);
        $performance = Category::create([
            'text_jp' => 'パフォーマンス向上',
            'parent_category_id' => $parentWork->id,
        ]);
        $thinking = Category::create([
            'text_jp' => '思考習慣',
            'parent_category_id' => $parentMind->id,
        ]);
        $mindset = Category::create([
            'text_jp' => 'マインドセットや概念理解',
            'parent_category_id' => $parentMind->id,
        ]);
        $company = Category::create([
            'text_jp' => '勉強会月間100件達成',
            'parent_category_id' => $parentCompany->id,
        ]);


        // Insert level samples
        $beginner = Level::create(['text_jp' => '初級']);
        $intermediate = Level::create(['text_jp' => '中級']);
        $advanced = Level::create(['text_jp' => '上級']);



        // Insert task samples
        // リモートワークツール
        Task::create([
            'level_id' => $beginner->id,
            'category_id' => $remoteTool->id,
            'text_jp' => '下記のSlackの基本的な使い方を実施している',
            'description' => '',
        ]);
        Task::create([
            'level_id' => $beginner->id,
            'category_id' => $remoteTool->id,
            'text_jp' => '下記のPC操作の基本的な使い方を実施している',
            'description' => '',
        ]);
        Task::create([
            'level_id' => $beginner->id,
            'category_id' => $remoteTool->id,
            'text_jp' => '１５分考えても先に進まないことについては他人に質問をする１５分ルールを期間中１度でも実施できた',
            'description' => '',
        ]);
        Task::create([
            'level_id' => $intermediate->id,
            'category_id' => $remoteTool->id,
            'text_jp' => 'バーチャルオフィスツールoViceを３回以上利用したことがある',
            'description' => '',
        ]);
        
        // 環境デザイン
        Task::create([
            'level_id' => $beginner->id,
            'category_id' => $environment->id,
            'text_jp' => '自宅での作業環境を、自宅の環境・制約がある中でも、自身なりに工夫して構築した。必ずしも最適な環境が整っている必要はない',
            'description' => '',
        ]);
        Task::create([
            'level_id' => $beginner->id,
            'category_id' => $environment->id,
            'text_jp' => '音声通話においては、最低限の通話品質を維持する為の工夫を行っている（例：ヘッドセットの利用、ミュートを行うようにする等でも良い）',
            'description' => '',
        ]);
        Task::create([
            'level_id' => $intermediate->id,
            'category_id' => $environment->id,
            'text_jp' => 'SNSに依存しないように、見るタイミングを定めて概ねコントロールができている（１週間の中で４日以上）',
            'description' => '',
        ]);
        Task::create([
            'level_id' => $intermediate->id,
            'category_id' => $environment->id,
            'text_jp' => 'PCにおいて多くのアプリケーションを必要がないのに一度に沢山開くような事はしていない',
            'description' => '',
        ]);

        // 自己開示・心理的安全性
        Task::create([
            'level_id' => $beginner->id,
            'category_id' => $selfDisclosure->id,
            'text_jp' => '自分のOJTチャンネルへの投稿日数が月間平均３日以上となっている',
            'description' => '',
        ]);
        Task::create([
            'level_id' => $beginner->id,
            'category_id' => $selfDisclosure->id,
            'text_jp' => 'オンライン会議における（例えばチェックインよる）雑談・自己開示を期間中１回以上行った',
            'description' => '',
        ]);
        Task::create([
            'level_id' => $intermediate->id,
            'category_id' => $selfDisclosure->id,
            'text_jp' => 'チェックイン、チェックアウト、アイスブレイク、ディープイン、ディープアウトなどslackbotを活用したOJTチャンネルへの投稿を月間平均１件以上実施できている',
            'description' => '',
        ]);
        Task::create([
            'level_id' => $intermediate->id,
            'category_id' => $selfDisclosure->id,
            'text_jp' => '自分が知らないこと、分からないことをOJTチャンネルで披露することが期間中一度でもできた',
            'description' => '',
        ]);
        Task::create([
            'level_id' => $advanced->id,
            'category_id' => $mentalSafety->id,
            'text_jp' => '他人の新しい試み、実験、挑戦に対して、称賛やエールを贈ることが期間中一度でもできた',
            'description' => '',
        ]);
        Task::create([
            'level_id' => $advanced->id,
            'category_id' => $mentalSafety->id,
            'text_jp' => '他人からの異論や反論を快く受け入れることが期間中一度でもできた',
            'description' => '',
        ]);

        // フィードバック
        Task::create([
            'level_id' => $beginner->id,
            'category_id' => $thanks->id,
            'text_jp' => '社内システムFeedit（コマンド /feedit-thanks）を使った他者への感謝を期間中１投稿行っている（ユーザーグループ宛てに一斉投稿は１投稿とカウントする）',
            'description' => '',
        ]);
        Task::create([
            'level_id' => $intermediate->id,
            'category_id' => $feedback->id,
            'text_jp' => '社内システムFeedit（コマンド /feedit-feedback）を使った他者へのフィードバックを期間中１件行っている',
            'description' => '',
        ]);
        Task::create([
            'level_id' => $advanced->id,
            'category_id' => $feedback->id,
            'text_jp' => '社内システムFeedit（コマンド /feedit-feedback）を使った**他者へのフィードバックの中でも、機会点（改善点）につながるものを期間中１件行っている',
            'description' => '',
        ]);
        Task::create([
            'level_id' => $advanced->id,
            'category_id' => $thanks->id,
            'text_jp' => '社内システムFeedit（コマンド /feedit-thanks）を使った自分や身の周りへの感謝を期間中１件行っている（※ /feedit-thanks @自分宛て　のコマンドを使う）',
            'description' => '',
        ]);

        // 生活習慣・食習慣
        Task::create([
            'level_id' => $intermediate->id,
            'category_id' => $lifeStyle->id,
            'text_jp' => '日常的に体重を記録している',
            'description' => '',
        ]);
        Task::create([
            'level_id' => $intermediate->id,
            'category_id' => $lifeStyle->id,
            'text_jp' => '普段から水分をこまめにとる習慣がある（１日１リットルなど、自分なりの目安を決める）',
            'description' => '',
        ]);
        Task::create([
            'level_id' => $intermediate->id,
            'category_id' => $eatHabit->id,
            'text_jp' => '偏った食事を行う事を避けることができている',
            'description' => '',
        ]);
        Task::create([
            'level_id' => $intermediate->id,
            'category_id' => $eatHabit->id,
            'text_jp' => '偏った食事を行う事を避けることができている',
            'description' => '',
        ]);
        


    }
}
