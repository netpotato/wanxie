<?php  

namespace app\admin\model;

use think\Model;

class Brand extends Model {

	protected $table = 'brand';

	public function getallbrand() {
		$brand = new Brand;
		$result = $brand -> select();
		return $result;
	}

	// 根据品牌编号删除品牌
	public function removebrand($brandid) {
		$brand = new Brand;
		$result = $brand -> where('brandid', $brandid) -> delete();
		return $result;
	}

	// 根据品牌编号批量删除品牌
	public function removebrands($brandids) {
		$brand = new Brand;
		$result = $brand -> where("brandid in ($brandids)") -> delete();
		return $result;
	}

	// 根据品牌编号获取品牌
	public function getbrandbyid($brandid) {
		$brand = new Brand;
		$result = $brand -> where('brandid', $brandid) -> find();
		return $result;
	}

	// 根据品牌编号修改品牌
	public function updatabrandbyid($brandid, $brandname, $brandnote) {
		$brand = new Brand;
		$result = $brand -> save([
			'brandname' => $brandname,
			'brandnote' => $brandnote
		], ['brandid' => $brandid]);
		return $result;
	}

	// 根据品牌名称获取品牌
	public function getbrandbyname($brandname) {
		$brand = new Brand;
		$result = $brand -> where('brandname', $brandname) -> find();
		return $result;
	}

	// 添加一个品牌
	public function addnewbrand($brandname, $brandnote) {
		$brand = new Brand;
		$result = $brand -> save([
			'brandname' => $brandname,
			'brandnote' => $brandnote
		]);
		return $result;
	}

}

?>