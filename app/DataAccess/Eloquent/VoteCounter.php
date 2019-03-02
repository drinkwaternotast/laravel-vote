<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VoteCounter extends Model
{
    /** @var array */
    protected $fillable = ['battle_id', 'photo_id', 'vote', 'owner'];

}
