<?php  

namespace app\admin\model;

use think\Model;

class Productimg extends Model {

	protected $table = 'productimg';

	public function removeproduct($productid) {
		$productimg = new Productimg;
		$result = $productimg -> where('productid', $productid) -> delete();
		return $result;
	}

	public function removeproducts($productids) {
		$productimg = new Productimg;
		$result = $productimg -> where("productid in ($productids)") -> delete();
		return $result;
	}

}

?>