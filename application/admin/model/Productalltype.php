<?php  

namespace app\admin\model;

use think\Model;

class Productalltype extends Model {

	protected $table = 'productalltype';

	public function getpageproduct($start, $num) {
		$products = new Productalltype;
		$result = $products -> limit($start, $num) -> select();
		return $result;
	}

	public function getproductbyid($productid) {
		$products = new Productalltype;
		$result = $products -> where('productid', $productid) -> find();
		return $result;
	}

}

?>