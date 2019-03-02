<?php

namespace App\Repositories;

use App\Repositories\VoteCountersRepositoryInterface;
use DB;

class VoteCountersRepository extends BaseRepository implements VoteCountersRepositoryInterface
{
    protected $table_name = 'vote_counters';

    /**
     * resister a new Vote.
     *
     * @param $params object battle_id, photo_id_like, user_id_voter
     * @return Illuminate\Database\Eloquent
     */
    public function createVoteCount($data)
    {
        $this->table->insert([
            'battle_id'  => $data['battle_id'],
            'photo_id'   => $data['photo_you'],
            'vote'       => $data['default_score'],
            'created_at' => $data['created_at'],
            'owner'      => 1,
        ]);

        $this->table->insert([
            'battle_id'  => $data['battle_id'],
            'photo_id'   => $data['photo_enemy'],
            'vote'       => $data['default_score'],
            'created_at' => $data['created_at'],
            'owner'      => 0,
        ]);
    }

    /**
     * resister a new Vote.
     *
     * @param $params object battle_id, photo_id_like, user_id_voter
     * @return Illuminate\Database\Eloquent
     */
    public function getBattlesWithScore($formatted_date, $resources)
    {
        $sql = DB::table('vote_counters as v1')
            ->where('v1.owner',1)
            ->leftjoin('vote_counters as v2','v1.battle_id','v2.battle_id')
            ->where('v2.owner',0)
            ->join('photos as p1','v1.photo_id','=','p1.id')
            ->join('photos as p2','v2.photo_id','=','p2.id')
            ->orderBy('v1.battle_id','DESC');  

        if ($resources === "current") {
            // when user requests 'Current', return the result that is accepting vote.
            $sql->select('v1.battle_id as id','v1.battle_id as battle_id','v1.created_at',
                'v1.photo_id as photo_you','v1.vote as COUNT_like_you','v1.owner as v1_owner',
                'p1.original_path as p1_path','p1.user_id as u1',
                'v2.photo_id as photo_enemy','v2.vote as COUNT_like_enemy','v2.owner as v2_owner',
                'p2.original_path as p2_path','p2.user_id as u2')
            ->where('v1.created_at','>=', $formatted_date);
        }

        if ($resources === "history") {
            // when user requests 'History', return the result attached winner's info of the current selection above.
            $sql->select('v1.battle_id as id','v1.battle_id as battle_id','v1.created_at',
                'v1.photo_id as photo_you','v1.vote as COUNT_like_you','v1.owner as v1_owner',
                'p1.original_path as p1_path','p1.user_id as u1',
                'v2.photo_id as photo_enemy','v2.vote as COUNT_like_enemy','v2.owner as v2_owner',
                'p2.original_path as p2_path','p2.user_id as u2',
                DB::raw('(CASE 
                        WHEN v1.vote > v2.vote THEN p1.user_id
                        WHEN v1.vote < v2.vote THEN p2.user_id
                        ELSE "draw"
                    END) AS WINNER'),
                DB::raw('(CASE 
                        WHEN v1.vote > v2.vote THEN p1.id
                        WHEN v1.vote < v2.vote THEN p2.id
                        ELSE "draw"
                    END) AS W_photo_id')
                )
            ->where('v1.created_at','<=', $formatted_date);
        }

        return $sql->paginate(4);
    }

    /**
     * resister a new Vote.
     *
     * @param $params object battle_id, photo_id_like, user_id_voter
     * @return Illuminate\Database\Eloquent
     */
    public function updateVote($request)
    {
        return $this->table
            ->where('battle_id', $request->battle_id)
            ->where('photo_id', $request->photo_id)
            ->increment('vote', 1);
    }

    /**
     * Only `Good` is the key to being a Top ranker.
     * Calculate from 2days before.
     * Loser and Draw are not displayed.
     *
     * @return Illuminate\Database\Eloquent
     */
    public function getRankingWithTag($formatted_date)
    {
        return $this->table
            ->select('photos.id as photo_id', 'original_path','name', 'user_id', 'photos.description', DB::raw('sum(vote) as COUNT'), 'photo_tag.tag_id','titles.title_jp','titles.title_en','characters.character')
            ->join('photos','photos.id','=','vote_counters.photo_id')
            ->join('users','photos.user_id','=','users.id')
            ->where('vote_counters.created_at','<=', $formatted_date)
            ->groupBy('vote_counters.photo_id')
            ->groupBy('photos.id','original_path','users.name','photos.user_id','photos.description','photo_tag.tag_id','titles.title_jp','titles.title_en','characters.character')
            ->join('photo_tag','photo_tag.photo_id','=','photos.id')
            ->join('title_character','title_character.tag_id','=','photo_tag.tag_id')
            ->join('titles','title_character.title_id','=','titles.title_id')
            ->join('characters','title_character.character_id','=','characters.character_id')
            ->orderBy('COUNT','DESC')
            ->orderBy('vote_counters.id','ASC')
            ->paginate(5);
    }

    /**
     * Only `Good` is the key to being a Top ranker.
     * Calculate from 2days before.
     * Loser and Draw are not displayed.
     *
     * @return Illuminate\Database\Eloquent
     */
    public function getBattlesByIdWithScore($id, $resources, $formatted_date)
    {
        $sql = DB::table('vote_counters as v1')
            ->where('v1.owner',1)
            ->leftjoin('vote_counters as v2','v1.battle_id','v2.battle_id')
            ->where('v2.owner',0)
            ->join('photos as p1','v1.photo_id','=','p1.id')
            ->join('photos as p2','v2.photo_id','=','p2.id')
            ->orderBy('v1.battle_id','DESC')
            ->where(function($query) use($id){
                $query->orWhere('p1.user_id','=',$id)
                   ->orWhere('p2.user_id','=',$id);
            });  

        if ($resources === "current") {
            // when user requests 'Current', return the result that is accepting vote.
            $sql->select('v1.battle_id as id','v1.battle_id as battle_id','v1.created_at',
                'v1.photo_id as photo_you','v1.vote as COUNT_like_you','v1.owner as v1_owner',
                'p1.original_path as p1_path','p1.user_id as u1',
                'v2.photo_id as photo_enemy','v2.vote as COUNT_like_enemy','v2.owner as v2_owner',
                'p2.original_path as p2_path','p2.user_id as u2')
            ->where('v1.created_at','>=', $formatted_date);
        }

        if ($resources === "history") {
            // when user requests 'History', return the result attached winner's info of the current selection above.
            $sql->select('v1.battle_id as id','v1.battle_id as battle_id','v1.created_at',
                'v1.photo_id as photo_you','v1.vote as COUNT_like_you','v1.owner as v1_owner',
                'p1.original_path as p1_path','p1.user_id as u1',
                'v2.photo_id as photo_enemy','v2.vote as COUNT_like_enemy','v2.owner as v2_owner',
                'p2.original_path as p2_path','p2.user_id as u2',
                DB::raw('(CASE 
                        WHEN v1.vote > v2.vote THEN p1.user_id
                        WHEN v1.vote < v2.vote THEN p2.user_id
                        ELSE "draw"
                    END) AS WINNER'),
                DB::raw('(CASE 
                        WHEN v1.vote > v2.vote THEN p1.id
                        WHEN v1.vote < v2.vote THEN p2.id
                        ELSE "draw"
                    END) AS W_photo_id')
                )
            ->where('v1.created_at','<=', $formatted_date);
        }
            
        return $sql->paginate(4);
    }

    /**
     * Only `Good` is the key to being a Top ranker.
     * Calculate from 2days before.
     * Loser and Draw are not displayed.
     *
     * @return Illuminate\Database\Eloquent
     */
    public function getBattlesByPhotoIdWithScore($resources, $formatted_date, $option)
    {
        $sql = DB::table('vote_counters as v1')
            ->where('v1.owner',1)
            ->leftjoin('vote_counters as v2','v1.battle_id','v2.battle_id')
            ->where('v2.owner',0)
            ->join('photos as p1','v1.photo_id','=','p1.id')
            ->join('photos as p2','v2.photo_id','=','p2.id')
            ->orderBy('v1.battle_id','DESC');

        if (isset($option['photo_id'])) {
            $sql->where(function($query) use($option){
                $query->orWhere('p1.id','=',$option['photo_id'])
                   ->orWhere('p2.id','=',$option['photo_id']);
            });
        }

        if (isset($option['order'])) {
            $sql->orderBy('v1.created_at', $option['order']);
        }

        if ($resources === "current") {
            // when user requests 'Current', return the result that is accepting vote.
            $sql->select('v1.battle_id as id','v1.battle_id as battle_id','v1.created_at',
                'v1.photo_id as photo_you','v1.vote as COUNT_like_you','v1.owner as v1_owner',
                'p1.original_path as p1_path','p1.user_id as u1',
                'v2.photo_id as photo_enemy','v2.vote as COUNT_like_enemy','v2.owner as v2_owner',
                'p2.original_path as p2_path','p2.user_id as u2')
            ->where('v1.created_at','>=', $formatted_date);
        }

        if ($resources === "history") {
            // when user requests 'History', return the result attached winner's info of the current selection above.
            $sql->select('v1.battle_id as id','v1.battle_id as battle_id','v1.created_at',
                'v1.photo_id as photo_you','v1.vote as COUNT_like_you','v1.owner as v1_owner',
                'p1.original_path as p1_path','p1.user_id as u1',
                'v2.photo_id as photo_enemy','v2.vote as COUNT_like_enemy','v2.owner as v2_owner',
                'p2.original_path as p2_path','p2.user_id as u2',
                DB::raw('(CASE 
                        WHEN v1.vote > v2.vote THEN p1.user_id
                        WHEN v1.vote < v2.vote THEN p2.user_id
                        ELSE "draw"
                    END) AS WINNER'),
                DB::raw('(CASE 
                        WHEN v1.vote > v2.vote THEN p1.id
                        WHEN v1.vote < v2.vote THEN p2.id
                        ELSE "draw"
                    END) AS W_photo_id')
                )
            ->where('v1.created_at','<=', $formatted_date);
        }
            
        return $sql->paginate(4);
    }

    /**
     * get the number of battles specified photo entried.
     * -After 2days-
     * 
     */
    public function getEntriedCountByPhotoId($photo_id, $formatted_date)
    {
        // Within 2days
        return $this->table
            ->where('photo_id', $photo_id)
            ->where('created_at','<=', $formatted_date)
            ->count();
    }

    /**
     * Only `Good` is the key to being a Top ranker.
     * Calculate from 2days before.
     * Loser and Draw are not displayed.
     *
     * @return Illuminate\Database\Eloquent
     */
    public function getWonCountByPhotoId($photo_id, $formatted_date)
    {
        return DB::table('vote_counters as v1')
            ->where('v1.owner',1)
            ->leftjoin('vote_counters as v2','v1.battle_id','v2.battle_id')
            ->where('v2.owner',0)
            ->join('photos as p1','v1.photo_id','=','p1.id')
            ->join('photos as p2','v2.photo_id','=','p2.id')
            ->orderBy('v1.battle_id','DESC')
            ->select('v1.battle_id as id','v1.battle_id as battle_id','v1.created_at',
                'v1.photo_id as photo_you','v1.vote as COUNT_like_you','v1.owner as v1_owner',
                'p1.original_path as p1_path','p1.user_id as u1',
                'v2.photo_id as photo_enemy','v2.vote as COUNT_like_enemy','v2.owner as v2_owner',
                'p2.original_path as p2_path','p2.user_id as u2',
                DB::raw('(CASE 
                        WHEN v1.vote > v2.vote THEN p1.user_id
                        WHEN v1.vote < v2.vote THEN p2.user_id
                        ELSE "draw"
                    END) AS WINNER'),
                DB::raw('(CASE 
                        WHEN v1.vote > v2.vote THEN p1.id
                        WHEN v1.vote < v2.vote THEN p2.id
                        ELSE "draw"
                    END) AS W_photo_id')
                )
            ->where('v1.created_at','<=', $formatted_date)
            ->having('W_photo_id','=', $photo_id)
            ->get()
            ->count();
    }

    /**
     * Calculate battle results by user id.
     * Params will be win,lose,draw,total.
     *
     * @return Illuminate\Database\Eloquent
     */
    public function getBattleResultsById($user_id, $term, $status)
    {
        $sql = DB::table('vote_counters as v1')
            ->where('v1.owner',1)
            ->leftjoin('vote_counters as v2','v1.battle_id','v2.battle_id')
            ->where('v2.owner',0)
            ->join('photos as p1','v1.photo_id','=','p1.id')
            ->join('photos as p2','v2.photo_id','=','p2.id')
            ->orderBy('v1.battle_id','DESC')
            ->select('v1.battle_id as id','v1.battle_id as battle_id','v1.created_at',
                'v1.photo_id as photo_you','v1.vote as COUNT_like_you','v1.owner as v1_owner',
                'p1.original_path as p1_path','p1.user_id as u1',
                'v2.photo_id as photo_enemy','v2.vote as COUNT_like_enemy','v2.owner as v2_owner',
                'p2.original_path as p2_path','p2.user_id as u2',
                DB::raw('(CASE 
                        WHEN v1.vote > v2.vote THEN p1.user_id
                        WHEN v1.vote < v2.vote THEN p2.user_id
                        ELSE "draw"
                    END) AS user_id_WINNER'),
                DB::raw('(CASE 
                        WHEN v1.vote > v2.vote THEN p2.user_id
                        WHEN v1.vote < v2.vote THEN p1.user_id
                    END) AS user_id_LOSER')
                );
            if ($status === 'win') {
                $sql->having('user_id_WINNER','=', $user_id);
            }
            if ($status === 'lose') {
                $sql->having('user_id_LOSER','=', $user_id);
            }

            return $sql
                ->whereBetween('v1.created_at', $term)
                ->get()
                ->count();
    }
}
