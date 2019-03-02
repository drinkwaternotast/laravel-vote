<?php

namespace App\Contracts;

class RankingUtil {

	/**
	 * convert collection to Array.
	 * 
	 * @param object $ret
	 * @return Array
	 *
	 */
	public static function toArray(Object $obj) {
        for ($i=0; $i < $obj->count(); $i++) { 
            $ret[$i] = $obj[$i]->user_id;
        }
        return $ret;
	}

	/**
	 * Plus Score when you find matched object.
	 * 
	 * @param object $ret
	 * @return Array
	 *
	 */
	public static function addScore($obj, $bonus, $point, $search) {
		if (empty($bonus)) {
			return;
		}
		for ($t=0; $t < $bonus->count(); $t++) { 
			for ($i=0; $i < $obj->count(); $i++) { 
				if ($obj[$i]->user_id == $bonus[$t]->user_id) {
					$obj[$i]->$point = $bonus[$t]->$search;
				}
			}
		}
	}
}