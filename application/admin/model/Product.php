<?php  

namespace app\admin\model;

use think\Model;

class Product extends Model {

	protected $table = 'product';

	// 根据商品编号删除商品
	public function removeproduct($productid) {
		$product = new Product;
		$result = $product -> where('productid', $productid) -> delete();
		return $result;
	}

	// 根据商品编号批量删除商品
	public function removeproducts($productids) {
		$product = new Product;
		$result = $product -> where("productid in ($productids)") -> delete();
		return $result;
	}
}

?>