<?php

namespace App\Services;

use Carbon\Carbon;
use App\Exceptions\PreconditionException;
use App\Repositories\TagsRepositoryInterface;

class TagService extends Service
{
    protected $TagsRepo;

    public function __construct(TagsRepositoryInterface $TagsRepo)
    {
        $this->TagsRepo = $TagsRepo;
    }

    // Insert tag data in photo_tag table.
    public function createTag($created_photo_id, $tagData)
    {
        return $this->TagsRepo->createTag($created_photo_id, $tagData);
    }

    public function getTagsAsSuggest($tagName)
    { 
        // prepare for 'TITLE' search
        $titles = $this->TagsRepo->getExpectedTitles($tagName);

        // if input is intended to "Title search", 
        $title_ids = $this->TagsRepo->getExpectedTitleIds($tagName);
        $tags_title = $this->TagsRepo->getTagsWithTitleSearch($title_ids);

        // if input is intended to "Character search", 
        $character_ids = $this->TagsRepo->getExpectedCharacterIds($tagName);
        $tags_character = $this->TagsRepo->getTagsWithCharacterSearch($character_ids);

        // merge two tables to create tags formed suggest.
        $collection = collect($tags_title);
        $merged = $collection->merge(collect($tags_character));
        
        // should be create 'id' and 'tag'
        $tag_titles = $this->divideMultiLanguageTitleTags($titles);
        $tag_characters = $this->divideMultiLanguageCharacterTags($merged);
        
        $ret = [
            'tag_data' => array_merge($tag_titles, $tag_characters)
        ];

        return $ret;

    }

    public function getTagsByPhotoId($photo_id)
    {
        $tag_ids = $this->TagsRepo->getTagIdsByPhotoId($photo_id);
        $tag = $this->TagsRepo->findByIds($tag_ids, $id_name = 'id', null, null); 

        if ($tag->isEmpty()) {
            throw new PreconditionException('No matching data found');
        }
        $formatted_data = $this->attachTitleAndCharacterKey($tag);

        return $formatted_data;
    }

    public function getCharacterAndTitleByInput($tagName)
    {
        $data = $this->TagsRepo->getCharacterAndTitleByInput($tagName);
        $formatted_data = $this->toCharacterAndTitleTags($data);
        $ret = ['tag_data' => $formatted_data];

        return $ret;
    }

    private function divideMultiLanguageTitleTags($object)
    {
        for ($i=0; $i < $object->count(); $i++) {
                $result[$i]['title_id']  = $object[$i]->title_id;
                $result[$i]['tag_id']  = 'AllChar';
                $result[$i]['tag']  = ' 【Title】 '.$object[$i]->title_jp.' / '.$object[$i]->title_en;
        }
        return $result;
    }

    private function divideMultiLanguageCharacterTags($object)
    {
        for ($i=0; $i < $object->count(); $i++) {
                $result_jp[$i]['title_id']  = $object[$i]->title_id;
                $result_jp[$i]['tag_id']  = $object[$i]->tag_id;
                $result_jp[$i]['tag']  = ' 【Character】 '.$object[$i]->character.' / '.$object[$i]->title_jp;
                $result_en[$i]['tag_id']  = $object[$i]->tag_id;
                $result_en[$i]['tag']  = ' 【Character】 '.$object[$i]->character.' / '.$object[$i]->title_en;
        }
        // return $object;
        $collection = collect($result_jp);
        $merged = $collection->merge(collect($result_en));

        return $merged->all();
    }

    private function divideMultiLanguageTags($object)
    {
        for ($i=0; $i < $object->count(); $i++) {
                $result_jp[$i]['tag_id']  = $object[$i]->tag_id;
                $result_jp[$i]['tag']  = $object[$i]->character.' / '.$object[$i]->title_jp;
                $result_en[$i]['tag_id']  = $object[$i]->tag_id;
                $result_en[$i]['tag']  = $object[$i]->character.' / '.$object[$i]->title_en;
        }
        // return $object;
        $collection = collect($result_jp);
        $merged = $collection->merge(collect($result_en));

        return $merged->all();
    }

    private function attachTitleAndCharacterKey($object)
    {
        for ($i=0; $i < $object->count(); $i++) {

            if ($object[$i]->is_title == 1) {
                $result[$i]['title'] = $object[$i]->tag;
            }
            if ($object[$i]->is_title == 0) {
                $result[$i]['character'] = $object[$i]->tag;
            }
        }
        return collect($result)->collapse();
    }

    private function toCharacterAndTitleTags($object)
    {
        // tag_id is the same value of character_id, refer to the title_character table.
        for ($i=0; $i < $object->count(); $i++) { 
            $result[$i]['tag_id']  = $object[$i]->character_id;
            $result[$i]['tag']  = $object[$i]->character.' 【 '.$object[$i]->title_jp.' / '.$object[$i]->title_en.' 】';
        }
        return $result;
    }

}
