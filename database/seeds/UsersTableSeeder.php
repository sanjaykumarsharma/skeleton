<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        	'role_id' => '1',
        	'name' => 'sanjay Kumar',
        	'username' => 'admin',
        	'email' => 'saanjaaykumaar@gmail.com',
        	'password' => bcrypt('admin!@#4'),
        ]);

        DB::table('users')->insert([
        	'role_id' => '2',
        	'name' => 'sanjay Kumar',
        	'username' => 'author',
        	'email' => 'sanjaykumar@slicedmango.com',
        	'password' => bcrypt('author!@#4'),
        ]);
    }
}
