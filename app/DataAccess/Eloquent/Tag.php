<?php

namespace App\DataAccess\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /** @var string */
    protected $table = 'tags';

    protected $primaryKey = 'id';

    /** @var array */
    protected $fillable = ['tag','tag_en'];

}
