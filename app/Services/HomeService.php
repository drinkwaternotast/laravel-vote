<?php

namespace App\Services;

use DB;
use Carbon\Carbon;
use App\User;
use App\DataAccess\Eloquent\Photo;
use App\DataAccess\Eloquent\Profile;
use App\Contracts\Util;

class HomeService extends Service
{
    protected $homeRepo;
    protected $voteCounterRepo;
    protected $Util;

    public function __construct(Util $Util)
    {   
        $this->Util = $Util;
    }

    public function getPopularPhotos()
    {
        // 1. Get 7 Photos with user_id, need at least 7 photos on the Top page.
        $rankers = $this->PopularPhotos();

        // 6. Format Data
        $rankers = $this->Util->omitOverString($rankers);

        return $this->Util->attachRank($rankers);
    }

    public function getRandomPhotos()
    {
        return Photo::inRandomOrder()->take(4)->get();
    }

    public function getNewMembersPhotos()
    {
        // It might be better to check if these users have posted photo...
        return Profile::whereNotNull('image')->orderBy('created_at','desc')->take(4)->get();
    }

    /**
     * resister a new Vote.
     *
     * @param $params object battle_id, photo_id_like, user_id_voter
     * @return Illuminate\Database\Eloquent
     */
    private function PopularPhotos()
    {
        // Voting is allowed within 2 Days
        $formatted_date = Carbon::now()->subDay(2)->toDateTimeString();

        return DB::table('votes')
            ->select(
                'users.name',
                'photos.user_id',
                'photos.id as photo_id',
                'original_path',
                'facebook',
                'twitter',
                DB::raw('count(photo_id_like) as vote_count'))
            ->groupBy('photo_id_like')
            ->groupBy('votes.id','profiles.id')
            ->join('photos','photo_id_like','=','photos.id')
            ->join('users','photos.user_id','=','users.id')
            ->join('profiles','users.id','=','profiles.user_id')
            ->where('votes.created_at','<=', $formatted_date)
            ->orderBy('vote_count', 'desc')  
            ->orderBy('battle_id', 'asc')          
            ->take(5)
            ->get();
    }
}
