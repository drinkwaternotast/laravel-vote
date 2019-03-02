<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $SQL_FILES = [
            'resources/developer_docs/tags.sql',
            'resources/developer_docs/photo_tag.sql'
        ];
        
        Eloquent::unguard();
        for ($i=0; $i < count($SQL_FILES); $i++) { 
            DB::unprepared(file_get_contents($SQL_FILES[$i]));
        }
        $this->command->info('tags data seeded!');
    }
}
