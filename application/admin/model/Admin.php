<?php  

namespace app\admin\model;

use think\Model;
use app\admin\model\Admin as AdminModel;

class Admin extends Model {

	public function login($adminname, $adminpwd) {
		$map['adminname'] = trim($adminname);
		$map['adminpwd'] = trim($adminpwd);

		$admin = new AdminModel();
		$result = $admin -> where($map) -> find();
		return $result;
	}

	// 根据管理员编号删除
	public function removeadminbyid($adminid) {
		$admin = new AdminModel();
		$result = $admin -> where("adminid", $adminid) -> delete();
		return $result;
	}

	// 根据管理员编号批量删除
	public function removeadmins($adminids) {
		$admin = new AdminModel;
		$result = $admin -> where("adminid in ($adminids)") -> delete();
		return $result;
	}

}

?>