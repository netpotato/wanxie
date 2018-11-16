<?php  

namespace app\admin\model;

use think\Model;

class Belong extends Model {

	protected $table = 'belong';

	public function removeproduct($productid) {
		$belong = new Belong;
		$result = $belong -> where('productid', $productid) -> delete();
		return $result;
	}

	public function removeproducts($productids) {
		$belong = new Belong;
		$result = $belong -> where("productid in ($productids)") -> delete();
		return $result;
	}

}

?>