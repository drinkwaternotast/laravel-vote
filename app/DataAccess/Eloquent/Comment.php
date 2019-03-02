<?php

namespace App\DataAccess\Eloquent;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Comment
 *
 * @property integer $id
 * @property integer $entry_id
 * @property string $name
 * @property string $comment
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\DataAccess\Eloquent\Comment whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\DataAccess\Eloquent\Comment whereEntryId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\DataAccess\Eloquent\Comment whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\DataAccess\Eloquent\Comment whereComment($value)
 * @method static \Illuminate\Database\Query\Builder|\App\DataAccess\Eloquent\Comment whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\DataAccess\Eloquent\Comment whereUpdatedAt($value)
 */
class Comment extends Model
{
    use SaveTransactionalTrait;

    /** @var string */
    protected $table = 'comments';

    /** @var array */
    protected $fillable = ['photo_id', 'user_id_commentator','body'];

    /**
     * @param $id
     *
     * @return mixed
     */
    public function getAllByPhotoId($id)
    {
        return $this->query()
            ->where('photo_id', $id)
            ->orderBy($this->primaryKey, 'ASC')->get();
    }

}
