<?php  

namespace app\index\Controller;

use think\Controller;
use think\Request;
use think\Session;
use app\index\model\Productalltype;
use app\index\model\Color;
use app\index\model\Size;
use app\index\model\Cart;

class Detail extends Controller {

	public function index(Request $request) {
		$productid = $request -> get('productid');
		$productname = $request -> get('productname');
		// 根据商品id查询
		$productalltype = new Productalltype;
		$detail = $productalltype -> getproduct($productid);
		$this -> assign('detail', $detail);

		// 获取商品名称的所有颜色
        $colors = $productalltype -> getallcolorbyname($productname);
        $this -> assign('colors', $colors);

        // 获取商品名称的所有尺寸
        $sizes = $productalltype -> getallsizebyname($productname);
        $this -> assign('sizes', $sizes);

		return $this -> fetch();
	}

	// 根据商品名称、颜色查询所有尺寸
	public function getsizes(Request $request) {
		$productalltype = new Productalltype;
		$result = $productalltype -> where([
			"productname" => $request -> get('productname'),
			"colorname" => $request -> get('colorname')
		]) -> field('sizename, sizenote') -> select();
		return $result;
	}

	// 根据商品名称、颜色、尺寸查询价格
	public function getproductprice(Request $request) {
		$productalltype = new Productalltype;
		$result = $productalltype -> where([
			"productname" => $request -> get('productname'),
			"colorname" => $request -> get('colorname'),
			"sizename" => $request -> get('sizename')
		]) -> find();
		return $result;
	}

	// 根据商品编号添加购物车
	public function addcart(Request $request) {
		$productid = $request -> post('productid');
		$productnum = $request -> post('productnum');
		$userid = Session::get('userid');
		$addtime = date("Y-m-d H:i:s");

		$cart = new Cart;
		// 判断该用户是否已有该商品订单
		$result = $cart -> where([
			'userid' => $userid,
			'productid' => $productid
		]) -> find();
		if(!empty($result)) {
			// 已有
			$productnumold = $result['productnum'];
			$result = $cart -> save([
				"productnum" => $productnum+$productnumold,
				"addtime" => $addtime
			], [
				"userid" => $userid,
				"productid" => $productid
			]);
		} else {
			// 没有
			$result = $cart -> addcart($productid, $productnum, $userid, $addtime);
		}
		return $result;
	}
}

?>