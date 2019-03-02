<?php

namespace App\DataAccess\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    /** @var string */
    protected $table = 'profiles';

    protected $primaryKey = 'id';

    /** @var array */
    protected $fillable = ['user_id','comment','image','facebook','twitter'];

	/**
	 * the person who has a photo
	 * 
	 */
	public function user()
	{
	    return $this->belongsTo('App\User');
	}

}
