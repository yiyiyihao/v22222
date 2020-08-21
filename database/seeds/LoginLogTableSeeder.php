<?php

use Illuminate\Database\Seeder;

class LoginLogTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('login_log')->insert([
        	['user_id'=>1,'login_time'=>time()],
        	['user_id'=>2,'login_time'=>time()],
        	['user_id'=>3,'login_time'=>time()],
        	['user_id'=>4,'login_time'=>time()],
        	['user_id'=>5,'login_time'=>time()],
        
        ]);
    }
}
