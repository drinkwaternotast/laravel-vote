<?php

namespace App\DataAccess\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use SaveTransactionalTrait;

    /** @var string */
    protected $table = 'votes';

    /** @var array */
    protected $fillable = ['battle_id', 'photo_id_winner','user_id_voter'];

}
