<?php 

namespace app\admin\model;

use think\Model;

class Type extends Model {

	protected $table = 'type';

	// 获取所有类型
	public function getalltype() {
		$type = new Type;
		$result = $type -> select();
		return $result;
	}

	// 根据类型编号删除类型
	public function removetype($typeid) {
		$type = new Type;
		$result = $type -> where('typeid', $typeid) -> delete();
		return $result;
	}

	// 根据类型编号批量删除类型
	public function removetypes($typeids) {
		$type = new Type;
		$result = $type -> where("typeid in ($typeids)") -> delete();
		return $result;
	}

	// 根据类型编号获取类型
	public function gettypebyid($typeid) {
		$type = new Type;
		$result = $type -> where('typeid', $typeid) -> find();
		return $result;
	}

	// 根据类型编号修改类型
	public function updatatypebyid($typeid, $typename, $typenote) {
		$type = new Type;
		$result = $type -> save([
			'typename' => $typename,
			'typenote' => $typenote
		], ['typeid' => $typeid]);
		return $result;
	}

	// 根据类型名称获取类型
	public function gettypebyname($typename) {
		$type = new Type;
		$result = $type -> where('typename', $typename) -> find();
		return $result;
	}

	// 添加一个类型
	public function addnewtype($typename, $typenote) {
		$type = new Type;
		$result = $type -> save([
			'typename' => $typename,
			'typenote' => $typenote
		]);
		return $result;
	}

}

?>