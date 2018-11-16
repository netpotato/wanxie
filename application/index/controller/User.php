<?php  

namespace app\index\Controller;

use think\Controller;
use think\Request;
use think\Session;
use think\Db;
use app\index\model\User;
use app\index\model\Cart;
use app\index\model\Usercart;
use app\index\model\Address;
use app\index\model\Order;
use app\index\model\Orderdetail;
use app\index\model\Userorder;

class User extends Controller {

	public function index() {
		$userid = Session::get('userid');

		// 根据用户名查询用户
		$user = new User;
		$userdata = $user -> getuserbyid($userid);
		$this -> assign("userdata", $userdata);

		return $this -> fetch();
	}

	// 跳转到购物车
	public function cart() {
		// 根据用户名称获取购物车信息
		$userid = Session::get('userid');

		$usercart = new Usercart;
		$cartdata = $usercart -> getallcartbyuserid($userid);
		$this -> assign("cartdata", $cartdata);

		return $this -> fetch();
	}

	// 更改用户信息
	public function updatauser(Request $request) {
		$username = $request -> post('username');
		$usersex = $request -> post('usersex');
		$userphone = $request -> post('userphone');
		$useremail = $request -> post('useremail');

		$userid = Session::get('userid');
		// 根据用户编号更改用户信息
		$user = new User;
		$result = $user -> updatauser($userid, $username, $usersex, $userphone, $useremail);
		return $result;
	}

	// 修改购物车记录数量
	public function updatacart(Request $request) {
		$cartid = $request -> post('cartid');
		$productnum = $request -> post('productnum');

		$cart = new Cart;
		$result = $cart -> updatacart($cartid, $productnum);

		return $result;
	}

	// 删除购物车记录
	public function removecart(Request $request) {
		$cartid = $request -> post('cartid');

		$cart = new Cart;
		$result = $cart -> removecart($cartid);
		
		return $result;
	}

	// 批量删除购物车记录
	public function removecarts(Request $request) {
		$cartids = $request -> post('cartidarr/a');
		$cartids = implode(",", $cartids);

		$cart = new Cart;
		$result = $cart -> removecarts($cartids);
		return $result;
	}

	// 跳转到订单
	public function order() {
		$userid = Session::get('userid');

		$userorder = new Userorder;
		$orderdata = $userorder -> where('userid', $userid) -> select();
		$this -> assign('orderdata', $orderdata);

		return $this -> fetch();
	}

	// 跳转到收货地址
	public function address() {
		$userid = Session::get('userid');

		$address = new Address;
		$result = $address -> getalladdress($userid);
		$this -> assign('address', $result);

		return $this -> fetch();
	}

	// 添加地址
	public function addaddress(Request $request) {
		$userid = Session::get('userid');

		$address = new Address;
		$result = $address -> save([
			"userid" => $userid,
			"addressarea" => $request -> post('addressarea'),
			"addressdetail" => $request -> post('addressdetail'),
			"postal" => $request -> post('postal'),
			"nickname" => $request -> post('nickname'),
			"phone" => $request -> post('phone')
		]);

		return $result;
	}

	// 根据编号删除地址
	public function removeaddress(Request $requset) {
		$addressid = $requset -> post('addressid');

		$address = new Address;
		$result = $address -> removeaddress($addressid);

		return $result;
	}

	// 设置本次登录使用的地址
	public function setdefaddress(Request $request) {
		$addressid = $request -> post("addressid");

		Session::set("addressid", $addressid);
		return;
	}

	// 添加订单
	public function addorder(Request $request) {
		$orderid = date("0000YmdHis");
		$orderdate = date("Y-m-d H:i:s");
		$ordermoney = $request -> post('ordermoney');
		$userid = Session::get('userid');
		$allproductnum = $request -> post('allproductnum');
		$addressid = Session::get('addressid');

		// 存储order表
		$order = new Order;
		$result = $order -> save([
			"orderid" => $orderid,
			"orderdate" => $orderdate,
			"ordermoney" => $ordermoney,
			"userid" => $userid,
			"allproductnum" => $allproductnum,
			"addressid" => $addressid
		]);

		$productids = $request -> post('productids');
		$buycounts = $request -> post('buycounts');
		$productids = explode(",", $productids);
		$buycounts = explode(",", $buycounts);

		// 批量添加
		$data = [];
		for($x=0; $x < count($productids); $x++) {
			$data[] = ["orderid" => $orderid, "productid" => $productids[$x], "buycount" => $buycounts[$x]];
		}

		$result = Db::name('orderdetail') -> insertAll($data);

		// 删除cart表
		$cart = new Cart;
		$productids = $request -> post('productids');
		$cart -> where("productid in ($productids)") -> where("userid", $userid) -> delete();

		return $result;
	}

	// 跳转到支付页面
	public function pay() {
		return $this -> fetch();
	}

}

?>