<?php

namespace App\DataAccess\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    /** @var string */
    protected $table = 'favorites';

    protected $primaryKey = 'id';

    /** @var array */
    protected $fillable = ['photo_id', 'user_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
