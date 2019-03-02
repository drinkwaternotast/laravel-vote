<?php

use Illuminate\Database\Seeder;

class CharactersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();
        $path = 'resources/developer_docs/characters.sql';
        DB::unprepared(file_get_contents($path));
        $this->command->info('characters data seeded!');
    }
}
