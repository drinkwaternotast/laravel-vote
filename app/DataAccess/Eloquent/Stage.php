<?php

namespace App\DataAccess\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    /** @var string */
    protected $table = 'stages';

    protected $primaryKey = 'id';

    /** @var array */
    protected $fillable = ['user_id', 'photo_id', 'owner'];

    public function user()
    {
    	return $this->belongsTo(App\User::class);
    }

}
