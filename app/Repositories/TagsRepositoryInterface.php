<?php

namespace App\Repositories;

interface TagsRepositoryInterface

{
    /**
     * Get all Tags.
     *
     */
    public function getExpectedTags($tagName);   
}
