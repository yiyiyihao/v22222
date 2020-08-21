<?php

use Illuminate\Database\Seeder;

class ArticleAndAuthorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('article') -> insert([
        	['article_name' => '如何学习php','author_id' => 1],
        	['article_name' => '如何学习java','author_id' => 2],
        	['article_name' => '如何学习python','author_id' => 3],
        ]);


        DB::table('author') -> insert([
        	['author_name' => '李白'],
        	['author_name' => '杜甫'],
        	['author_name' => '李清照'],
        ]);
    }
}
