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
        // Eloquent::unguard();
        // $path = 'resources/developer_docs/users.sql';
        // DB::unprepared(file_get_contents($path));
        // $this->command->info('users data seeded!');
        
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'yoshihara',
                'email' => 'yoshihara@gmail.com',
                'password' => bcrypt('yoshihara'),
            ],
            [
                'id' => 2,
                'name' => 'kazuki',
                'email' => 'kazuki@gmail.com',
                'password' => bcrypt('kazuki'),
            ],
            [
                'id' => 3,
                'name' => 'sei',
                'email' => 'sei@gmail.com',
                'password' => bcrypt('sei@gmail.com'),
            ]
        ]);
    }
}
