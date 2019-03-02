<?php

namespace App\Repositories;

use DB;

abstract class BaseRepository {

	/** @var \Illuminate\Database\Query\Builder */
	protected $table = null;

	protected $id_name = null;

	protected $table_name = null;

	function __construct() {
		$this->init();
	}

	public function getTableName() {
		return $this->table_name;
	}

	protected function init() {
		$class_name = get_class($this);
		$this->table_name = $this->createTableName($class_name);
		$this->table = DB::table($this->table_name);
	}

	private function createTableName($class_name) {
		$spirited_array = explode("\\", str_replace('Repository', '', $class_name));
		$array = str_split(end($spirited_array));
		$table_name = '';
		$is_first = true;
		foreach($array as $char) {
			if($is_first) {
				$is_first = false;
				$table_name = $table_name . $char;
				continue;
			}
			if (ctype_upper($char)) {
				$char = '_' . $char;
			}
			$table_name = $table_name . $char;
		}
		return strtolower($table_name);
	}

	public function findAll() {
		if (empty($this->table)) {
			return null;
		}
		return $this->table
			->whereNull('deleted_at')
			->get();
	}

	public function findById($id, $id_name = 'id', $exceptFlag = 'deleted_at') {
		if (empty($this->table)) {
			return null;
		}
		$id_name = $this->getIdName($id_name);
		if (empty($id_name)) {
			return null;
		}
		$sql = $this->table
			->where($id_name, '=' , $id);

		if ($exceptFlag) {
			$sql->whereNull($exceptFlag);
		}
			
		return $sql->get();
	}

	public function findByIds(array $ids, $id_name = null, $paginate = null, $exceptFlag = 'deleted_at') {
		if (empty($this->table)) {
			return null;
		}
		$id_name = $this->getIdName($id_name);
		if (empty($id_name)) {
			return null;
		}
		$sql = $this->table
			->whereIn($id_name, $ids);

		if ($exceptFlag) {
			$sql->whereNull($exceptFlag);
		}		

		if (empty($paginate)) {
			return $sql->get();
		}
		return $sql->paginate($paginate);
	}

	public function isExistById($id, $id_name = null) {
		$ret = $this->findById($id, $id_name);
		return $ret != null && count($ret) != 0;
	}

	public function isExistByIds(array $ids, $id_name = null) {
		$ret = $this->findByIds($ids, $id_name);
		return $ret != null && count($ret) != 0;
	}

	public function insertGetId(array $vals) {
		return $this->table->insertGetId($vals, $this->id_name);
	}

	public function insertAndGetData(array $vals) {
		$id = $this->table->insertGetId($vals, $this->id_name);
		return $this->findById($id, $id_name = 'id', null);
	}

	public function updateById($id, array $vals, $id_name = null) {
		$id_name = $this->getIdName($id_name);
		if (empty($id_name)) {
			return null;
		}
		$this->table
			->where($id_name, $id)
			->update($vals);
	}

	public function deleteById($id, $id_name = null) {
		if (empty($this->table)) {
			return null;
		}
		$id_name = $this->getIdName($id_name);
		if (empty($id_name)) {
			return null;
		}
		return $this->table
			->where($id_name, $id)
			->delete();
	}

	public function softDelete($id, $id_name = 'id') {
		$id_name = $this->getIdName($id_name);
		if (empty($id_name)) {
			return null;
		}
		$this->table
			->where($id_name, $id)
			->update([
				'deleted_at' => $this->getDate()
			]);
	}

	public function getIdName($id_name = null) {
		if (empty($this->id_name) && empty($id_name)) {
			return null;
		}
		if (empty($id_name)) {
			return $this->id_name;
		}
		return $id_name;
	}

    protected function setTimestamps($data, $createdFlag = true)
    {
        $timestamp = date('Y-m-d H:i:s');
        if ($createdFlag === true) {
            $data->created_at = $timestamp;
        }
        $data->updated_at = $timestamp;
        return $data;
    }

	protected function getDate() {
		return date('Y/m/d H:i:s');
	}

}