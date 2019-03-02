<?php

namespace App\DataAccess\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Photo extends Model
{
    use SaveTransactionalTrait;
    use SoftDeletes;

    /** @var string */
    protected $table = 'photos';

    protected $primaryKey = 'id';

    protected $fillable = ['original_path', 'title', 'character', 'description', 'user_id', 'created_at', 'updated_at'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function tags()
    {
        return $this->belongsToMany('App\DataAccess\Eloquent\Tag');
    }

}
