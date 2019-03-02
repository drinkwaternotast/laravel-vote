<?php

use Illuminate\Database\Seeder;

class ProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Eloquent::unguard();
        // $path = 'resources/developer_docs/profiles.sql';
        // DB::unprepared(file_get_contents($path));
        // $this->command->info('profiles data seeded!');
        DB::table('profiles')->insert([
            [
                'user_id'  => '1',
                'comment'  => 'hello, I\'m yoshihara.',
                'image'    => 'https://cosplay-photo.s3.ap-northeast-1.amazonaws.com/profiles/hF0hgQelQzTlfPF34JIIJid3JrIMu5YO.jpeg',
                'facebook' => 'https://www.facebook.com/profile.php?id=100015623216540&fref=pymk',
                'twitter'  => 'https://twitter.com/Ludtck002',
            ],
            [
                'user_id'  => '3',
                'comment'  => 'hello, I\'m sei.',
                'image'    => 'https://cosplay-photo.s3.ap-northeast-1.amazonaws.com/profiles/Vx7Lmn0YeA807Oe4JkR0iF0BHQPjcuup.jpeg',
                'facebook' => 'https://www.facebook.com/profile.php?id=100012738472628&fref=pymk',
                'twitter'  => 'https://twitter.com/Sei9373',
            ]
        ]);
    }
}
