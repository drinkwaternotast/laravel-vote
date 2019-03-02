<?php

namespace App\Contracts\Explore;

use App\Http\Component\Posts\AbstractClass\AbstractPostExplore;
use App\Http\Component\Util;

class CommentRankingExplore extends AbstractPostExplore {

	public function explore(array $options = []) {

		$options['order'] = 'comment_count';
		$ret = $this->postsDao->getList($options);

		return Util::omitOverStrWithComments($ret);
	}
}