<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PhotosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Eloquent::unguard();
        // $path = 'resources/developer_docs/photos.sql';
        // DB::unprepared(file_get_contents($path));
        // $this->command->info('photos data seeded!');
        DB::table('photos')->insert([
            [
                'id' => 1,
                'original_path'  => 'https://cosplay-photo.s3.ap-northeast-1.amazonaws.com/images/MjrhOFlTdR5lYba8yiRFrwI78MbIDfaW.jpeg',
                'description'    => 'Meiko cosplay sample.',
                'user_id'        => 1,
                'created_at'     => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id' => 2,
                'original_path'  => 'https://cosplay-photo.s3.ap-northeast-1.amazonaws.com/images/vx6kuWYt1wlPbqy1gXey03lYfXEkdw40.jpeg',
                'description'    => 'Meiko cosplay sample2.',
                'user_id'        => 1,
                'created_at'     => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id' => 3,
                'original_path'  => 'https://cosplay-photo.s3.ap-northeast-1.amazonaws.com/images/HuGlicfC4hw2aYBZgY3P3Myn3eoPmrLH.jpeg',
                'description'    => 'Sei cosplay sample.',
                'user_id'        => 3,
                'created_at'     => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id' => 4,
                'original_path'  => 'https://cosplay-photo.s3.ap-northeast-1.amazonaws.com/images/GKHQqwvP7FODitnTr00WTMy9OOGU4RRP.jpeg',
                'description'    => 'Sei cosplay sample2.',
                'user_id'        => 3,
                'created_at'     => Carbon::now()->format('Y-m-d H:i:s'),
            ]
        ]);
    }
}