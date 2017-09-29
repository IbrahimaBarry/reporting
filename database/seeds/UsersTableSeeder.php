<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(['name' => 'BARRY Ibrahima', 'email' => 'ibarry@itelsys.ma',
        	'password' => bcrypt('ibarry'), 'role' => 'admin']);
    }
}
