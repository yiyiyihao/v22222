<?php

use Illuminate\Database\Seeder;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //模拟数据
        DB::table('comment') -> insert([
        	['comment' => '为了祖国的明天','article_id' => rand(1,3)],
        	['comment' => '习近平在中央军委政策制度改革工作会议上强调','article_id' => rand(1,3)],
        	['comment' => '握军事竞争和战争主动权，迫切需要适应形势任务发展要','article_id' => rand(1,3)],
        	['comment' => '中央军委委员魏凤和、李作成、苗华、张升民出席会议。军委机关各部门、全军各大单位负责同志参加会议，中央和国家机关有关部门负责同志列席会议。','article_id' => rand(1,3)],
        	['comment' => '为唯一的根本的标准，以调动军事人员积极性、主动性、创造性为着力点，系统谋划、前瞻设计，创新发展、整体重塑，建立健全中国特色','article_id' => rand(1,3)],
        ]);
    }
}
