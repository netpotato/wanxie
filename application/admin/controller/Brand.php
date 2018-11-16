<?php  

namespace app\admin\Controller;

use think\Controller;
use think\Request;
use think\Session;
use app\admin\model\Brand;

class Brand extends Controller {

	public function index() {

		if(!in_array('1', Session::get('pids'))) {
			$this -> redirect('Index/nopermission'); // 没有权限
		}

		$brand = new Brand;
		$brands = $brand -> getallbrand();
		$this -> assign('brands', $brands);
		return $this -> fetch();
	}

	// 按品牌编号删除品牌
	public function removebrand(Request $request) {

		if(!in_array('4', Session::get('pids'))) {
			return 99; // 没有权限
		}

		$brandid = $request -> post('brandid');
		$brand = new Brand;
		$result = $brand -> removebrand($brandid);
		if(!empty($result)) {
			return 1;
		} else {
			return 0;
		}
	}

	// 按品牌编号批量删除品牌
	public function removebrands(Request $request) {

		if(!in_array('4', Session::get('pids'))) {
			return 99; // 没有权限
		}

		$brandids = $request -> post('arr/a');
		$brandids = implode(",", $brandids);
		$brand = new Brand;
		$result = $brand -> removebrands($brandids);
		if(!empty($result)) {
			return 1;
		} else {
			return 0;
		}
	}

	// 跳转到修改品牌
	public function updatabrand(Request $request) {

		if(!in_array('3', Session::get('pids'))) {
			$this -> redirect('Index/nopermission'); // 没有权限
		}

		$brandid = $request -> get('brandid');

		$brand = new Brand;
		$result = $brand -> getbrandbyid($brandid);

		$this -> assign('brand', $result);
		return $this -> fetch();
	}

	// 按品牌编号修改品牌
	public function updatabrandbyid(Request $request) {
		$brandid = $request -> post('brandid');
		$brandname = $request -> post('brandname');
		$brandnote = $request -> post('brandnote');

		// 判读品牌名称是否存在
		$brand = new Brand;
		$result = $brand -> getbrandbyname($brandname);

		if(!empty($result)) {
			return 2;
		} else {
			$result = $brand -> updatabrandbyid($brandid, $brandname, $brandnote);

			if(!empty($result)) {
				return 1;
			} else {
				return 0;
			}
		}
	}

	// 跳转到添加品牌
	public function addbrand() {

		if(!in_array('3', Session::get('pids'))) {
			$this -> redirect('Index/nopermission'); // 没有权限
		}

		return $this -> fetch();
	}

	// 添加品牌
	public function addnewbrand(Request $request) {
		$brandname = $request -> post('brandname');
		$brandnote = $request -> post('brandnote');

		// 判读品牌名称是否存在
		$brand = new Brand;
		$result = $brand -> getbrandbyname($brandname);

		if(!empty($result)) {
			return 0;
		} else {
			$result = $brand -> addnewbrand($brandname, $brandnote);
			return 1;
		}
	}
}	

?>