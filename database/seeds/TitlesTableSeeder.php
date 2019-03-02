<?php

use Illuminate\Database\Seeder;

class TitlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $SQL_FILES = [
            'resources/developer_docs/titles.sql',
            'resources/developer_docs/title_character.sql'
        ];
        
        Eloquent::unguard();
        for ($i=0; $i < count($SQL_FILES); $i++) { 
            DB::unprepared(file_get_contents($SQL_FILES[$i]));
        }
        $this->command->info('titles data seeded!');
    }
}
