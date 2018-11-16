<?php  

namespace app\admin\model;

use think\Model;

class Group extends Model {

	protected $table = 'group';

	// 获取所有分组
	public function getallGroup() {
		$group = new Group;
		$result = $group -> select();
		return $result;
	}

	// 根据分组编号查询分组
	public function getgroupbyid($groupid) {
		$group = new Group;
		$result = $group -> where("groupid", $groupid) -> find();
		return $result;
	}

}

?>