<?php  

namespace app\index\model;

use think\Model;
use think\Db;

class Productalltype extends Model {

	protected $table = 'productalltype';

	// 获取新品球鞋
	public function getnewshoes($newnum) {
		$productalltype = new Productalltype;
		$result = $productalltype -> order('addtime', 'desc') -> limit($newnum) -> select();
		return $result;
	}

	// 获取销量靠前商品
	public function getsalesproducts($salesnum) {
		$productalltype = new Productalltype;
		$result = $productalltype -> order('sales', 'desc') -> limit($salesnum) -> select();
		return $result;
	}

	// 获取所有的男鞋与男女鞋
	public function getallmproduct() {
		$productalltype = new Productalltype;
		$result = $productalltype -> where("sex", 1) -> whereOr("sex", 2) -> select();
		return $result;
	}

	// 获取所有的女鞋与男女鞋
	public function getallwproduct() {
		$productalltype = new Productalltype;
		$result = $productalltype -> where("sex", 0) -> whereOr("sex", 2) -> select();
		return $result;
	}

	// 男鞋页面根据选择的条件查询商品
	public function getproducts($data, $sex) {
		$smprice = $data['smprice'];
		$bigprice = $data['bigprice'];
		unset($data['smprice']);
		unset($data['bigprice']);

		$productalltype = new Productalltype;
		$result = $productalltype -> where($data) -> select();
		// 删除价格不在区间的数据
		$i = 0;
		foreach ($result as $value) {
			if($value['productprice']<$smprice || $value['productprice']>$bigprice) {
				unset($result[$i]);
			}
			if($sex == '1') {
				if($value['sex'] == '0') {
					unset($result[$i]);
				}
			} else if ($sex == '0') {
				if($value['sex'] == '1') {
					unset($result[$i]);
				}
			}
			$i++;
		}
		return $result;
	}

	// 根据商品id查询
	public function getproduct($productid) {
		$productalltype = new Productalltype;
		$result = $productalltype -> where('productid', $productid) -> find();
		return $result;
	}

	// 获取商品名称的所有颜色
	public function getallcolorbyname($productname) {
		$result = Db::name('productalltype') -> where('productname', $productname) -> field('colorname, colornote') -> distinct(true) -> select();
		return $result;
	}

	// 获取商品名称的所有尺寸
	public function getallsizebyname($productname) {
		$result = Db::name('productalltype') -> where('productname', $productname) -> field('sizename, sizenote') -> distinct(true) -> select();
		return $result;
	}
}

?>