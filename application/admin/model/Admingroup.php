<?php  

namespace app\admin\model;

use think\Model;

class Admingroup extends Model {

	protected $table = 'admingroup';

	// 根据管理员编号删除
	public function removeadminbyid($adminid) {
		$admingroup = new Admingroup();
		$result = $admingroup -> where("adminid", $adminid) -> delete();
		return $result;
	}

	// 根据管理员编号批量删除
	public function removeadmins($adminids) {
		$admingroup = new Admingroup;
		$result = $admingroup -> where("adminid in ($adminids)") -> delete();
		return $result;
	}

	public function updataadmingroup($adminid, $groupid) {
		$admingroup = new Admingroup;

		$result = $admingroup -> save([
			"groupid" => $groupid
		],[
			"adminid" => $adminid
		]);
		return $result;
	}

}

?>