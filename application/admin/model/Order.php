<?php  

namespace app\admin\model;

use think\Model;

class Order extends Model {

	protected $table = 'order';

	// 获取所有的订单
	public function getallorder() {
		$order = new Order;
		$result = $order -> select();
		return $result;
	}

	// 根据订单编号改变订单状态
	public function dispose($orderid, $orderstate) {
		$order = new Order;
		$result = $order -> save([
			"orderstate" => $orderstate
		], ['orderid' => $orderid]);
		return $result;
	}

}

?>