<?php

use Illuminate\Database\Seeder;

class VotesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $SQL_FILES = [
            'resources/developer_docs/votes.sql',
            'resources/developer_docs/votes_counters.sql'
        ];
        
        Eloquent::unguard();
        for ($i=0; $i < count($SQL_FILES); $i++) { 
            DB::unprepared(file_get_contents($SQL_FILES[$i]));
        }
        $this->command->info('votes data seeded!');
    }
}
