<?php  

namespace app\index\model;

use think\Model;

class Brand extends Model {

	protected $table = 'brand';

	public function getallbrand() {
		$brand = new Brand;
		$result = $brand -> select();
		return $result;
	}
}

?>