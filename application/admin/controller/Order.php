<?php  

namespace app\admin\Controller;

use think\Controller;
use think\Request;
use think\Session;
use app\admin\model\Order;
use app\admin\model\Orderdetail;

class Order extends Controller {

	public function index() {

		if(!in_array('9', Session::get('pids'))) {
			$this -> redirect('Index/nopermission'); // 没有权限
		}

		// 获得所有订单
		$order = new Order;
		$orders = $order -> getallorder();
		$this -> assign('orders', $orders);

		return $this -> fetch();
	}

	// 根据订单编号改变订单状态
	public function dispose(Request $request) {

		if(!in_array('10', Session::get('pids'))) {
			return 99; // 没有权限
		}

		$orderid = $request -> post('orderid');
		$orderstate = $request -> post('orderstate');
		if($orderstate == '1') {
			$orderstate = '0';
		} else {
			$orderstate = '1';
		}
		$order = new Order;
		$result = $order -> dispose($orderid, $orderstate);
		return $result;
	}

	// 跳转到订单详情
	public function detail() {

		if(!in_array('9', Session::get('pids'))) {
			$this -> redirect('Index/nopermission'); // 没有权限
		}

		$orderdetail = new Orderdetail;
		$details = $orderdetail -> getallorderdetail();
		$this -> assign('details', $details);
		return $this -> fetch();
	}
}

?>