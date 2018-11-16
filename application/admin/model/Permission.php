<?php  

namespace app\admin\model;

use think\Model;

class Permission extends Model {

	protected $table = 'permission';

	public function getallpermission() {
		$permission = new Permission;
		$result = $permission -> select();
		return $result;
	}

}

?>