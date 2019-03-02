<?php

namespace App\DataAccess\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Fan extends Model
{
    /** @var string */
    protected $table = 'fans';

    protected $primaryKey = 'id';

    /** @var array */
    protected $fillable = ['fan_id', 'user_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
