<?php

namespace App\Contracts;

class Util {

	const MAX_FACEBOOK_LENGTH = 12;
	const MAX_TWITTER_LENGTH = 12;
	// const MAX_COMMENT_LENGTH = 33;

	/**
	 * When the number of characters exceeds a certain number,
	 * convert it to ...
	 * 
	 * @param object $ret
	 * @param $max_title_str_length
	 * @return stdClass
	 *
	 */

	public static function omitOverStr($ret) {
		if ($ret->facebook) {
			$ret->facebook_omit = str_limit($ret->facebook, self::MAX_FACEBOOK_LENGTH);
		}

		if ($ret->twitter) {
			$ret->twitter_omit = str_limit($ret->twitter, self::MAX_TWITTER_LENGTH);
		}
		
		return $ret;
	}

	/**
	 * When the number of characters exceeds a certain number,
	 * convert it to ...
	 * 
	 * @param object $ret
	 * @param $max_title_str_length
	 * @return stdClass
	 *
	 */

	public static function omitOverString($object) {
		for ($i=0; $i < $object->count(); $i++) { 
			if (!empty($object[$i]->facebook)) {
				$object[$i]->facebook_omit = str_limit($object[$i]->facebook, self::MAX_FACEBOOK_LENGTH);
			}
			if (!empty($object[$i]->twitter)) {
				$object[$i]->twitter_omit = str_limit($object[$i]->twitter, self::MAX_TWITTER_LENGTH);
			}
		}
		return $object;
	}
	/**
	 * Attach ranking number.
	 * 
	 * @param object $object
	 * @return stdClass
	 *
	 */

	public static function attachRank($object) {
		for ($i=0; $i < $object->count() ; $i++) { 
			$object[$i]->rank = $i + 1;
		}
		return $object;
	}

}