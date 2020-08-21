<?php

use Illuminate\Database\Seeder;

class TestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('test')->insert([
        	['name'=>'yi','phone'=>'1234'],
        	['name'=>'yihao','phone'=>'12345'],
        	['name'=>'yiyi','phone'=>'123456'],
        ]);
    }
}
