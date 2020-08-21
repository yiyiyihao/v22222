<?php

use Illuminate\Database\Seeder;

class PaperTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('jx_paper') -> insert([
        	[
        		'paper_name'	=>	'期中考试语文A卷',
        		'total_score'	=>	'100',
        		'start_time'	=>	time() + 10 * 84600,
        		'duration'		=>	'100',
        		'status'		=>	1
        	],
        	[
        		'paper_name'	=>	'期中考试语文B卷',
        		'total_score'	=>	'100',
        		'start_time'	=>	time() + 10 * 84600,
        		'duration'		=>	'100',
        		'status'		=>	1
        	],
        	[
        		'paper_name'	=>	'期中考试语文C卷',
        		'total_score'	=>	'100',
        		'start_time'	=>	time() + 10 * 84600,
        		'duration'		=>	'100',
        		'status'		=>	1
        	],
        ]);
    }
}
