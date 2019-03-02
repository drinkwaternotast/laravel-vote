<?php

namespace App\DataAccess\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Battle extends Model
{
    /** @var string */
    protected $table = 'battles';

    protected $primaryKey = 'id';

    /** @var array */
    protected $fillable = ['battle_id', 'photo_id', 'user_id'];

	/**
	 * the person who start the battle
	 * TO DO ....remove method below
	 */
	public function user()
	{
	    return $this->belongsTo('App\User','user_id','id');
	}

}
