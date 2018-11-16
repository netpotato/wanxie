<?php  

namespace app\index\model;

use think\Model;

class Cart extends Model {

	protected $table = 'cart';

	// 修改购物车记录数量
	public function updatacart($cartid, $productnum) {
		$cart = new Cart;
		$result = $cart -> save([
			"productnum" => $productnum
		], ["cartid" => $cartid]);
		return $result;
	}

	// 删除购物车记录
	public function removecart($cartid) {
		$cart = new Cart;
		$result = $cart -> where('cartid', $cartid) -> delete();
		return $result;
	}

	// 批量删除购物车记录
	public function removecarts($cartids) {
		$cart = new Cart;
		$result = $cart -> where("cartid in ($cartids)") -> delete();
		return $result;
	}

	public function addcart($productid, $productnum, $userid, $addtime) {
		$cart = new Cart;
		$result = $cart -> save([
			"productid" => $productid,
			"productnum" => $productnum,
			"userid" => $userid,
			"addtime" => $addtime
		]);
		return $result;
	}
}

?>