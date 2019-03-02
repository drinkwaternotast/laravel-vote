<?php

use Illuminate\Database\Seeder;

class BattlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();
        $path = 'resources/developer_docs/battles.sql';
        DB::unprepared(file_get_contents($path));
        $this->command->info('battles data seeded!');
    }
}
