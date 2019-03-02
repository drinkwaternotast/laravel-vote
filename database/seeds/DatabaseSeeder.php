<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
		$this->call(UsersTableSeeder::class);
		$this->call(PhotosTableSeeder::class);
		$this->call(ProfilesTableSeeder::class);
		$this->call(FansTableSeeder::class);
		$this->call(StagesTableSeeder::class);
		$this->call(BattlesTableSeeder::class);
		$this->call(FavoritesTableSeeder::class);
		$this->call(CharactersTableSeeder::class);
		$this->call(VotesTableSeeder::class);
		$this->call(TagsTableSeeder::class);
		$this->call(TitlesTableSeeder::class);
    }
}
