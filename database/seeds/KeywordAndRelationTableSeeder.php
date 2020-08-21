<?php

use Illuminate\Database\Seeder;

class KeywordAndRelationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('keyword') -> insert([
        	['keyword' => '电影'],
        	['keyword' => '科幻电影'],
        	['keyword' => '人物'],
        	['keyword' => '电视剧'],
        	['keyword' => '角色'],
        	['keyword' => '转基因'],
        ]);

        DB::table('relation') -> insert([
        	['article_id' => rand(1,3),'key_id' => rand(1,6)],
        	['article_id' => rand(1,3),'key_id' => rand(1,6)],
        	['article_id' => rand(1,3),'key_id' => rand(1,6)],
        	['article_id' => rand(1,3),'key_id' => rand(1,6)],
        	['article_id' => rand(1,3),'key_id' => rand(1,6)],
        	['article_id' => rand(1,3),'key_id' => rand(1,6)],
        ]);
    }
}
