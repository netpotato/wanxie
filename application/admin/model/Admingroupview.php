<?php  

namespace app\admin\model;

use think\Model;

class Admingroupview extends Model {

	protected $table = 'admingroupview';

	// 根据编号查询管理员
	public function getadminbyid($adminid) {
		$agv = new Admingroupview;
		$result = $agv -> where("adminid", $adminid) -> find();
		return $result;
	}

}

?>