<?php  

namespace app\admin\model;

use think\Model;

class Orderdetail extends Model {

	protected $table = 'orderdetail';

	// 获取所有的订单
	public function getallorderdetail() {
		$orderdetail = new Orderdetail;
		$result = $orderdetail -> select();
		return $result;
	}

}

?>