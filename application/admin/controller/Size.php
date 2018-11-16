<?php  

namespace app\admin\Controller;

use think\Controller;
use think\Request;
use think\Session;
use app\admin\model\Size;

class Size extends Controller {

	public function index() {

		if(!in_array('1', Session::get('pids'))) {
			$this -> redirect('Index/nopermission'); // 没有权限
		}

		$size = new Size;
		$sizes = $size -> getallsize();
		$this -> assign('sizes', $sizes);
		return $this -> fetch();
	}

	// 按尺寸编号删除尺寸
	public function removesize(Request $request) {

		if(!in_array('4', Session::get('pids'))) {
			return 99; // 没有权限
		}

		$sizeid = $request -> post('sizeid');
		$size = new Size;
		$result = $size -> removesize($sizeid);
		if(!empty($result)) {
			return 1;
		} else {
			return 0;
		}
	}

	// 按尺寸编号批量删除尺寸
	public function removesizes(Request $request) {

		if(!in_array('4', Session::get('pids'))) {
			return 99; // 没有权限
		}

		$sizeids = $request -> post('arr/a');
		$sizeids = implode(",", $sizeids);
		$size = new Size;
		$result = $size -> removesizes($sizeids);
		if(!empty($result)) {
			return 1;
		} else {
			return 0;
		}
	}

	// 跳转到修改尺寸
	public function updatasize(Request $request) {

		if(!in_array('3', Session::get('pids'))) {
			$this -> redirect('Index/nopermission'); // 没有权限
		}

		$sizeid = $request -> get('sizeid');

		$size = new Size;
		$result = $size -> getsizebyid($sizeid);

		$this -> assign('size', $result);
		return $this -> fetch();
	}

	// 按尺寸编号修改尺寸
	public function updatasizebyid(Request $request) {
		$sizeid = $request -> post('sizeid');
		$sizename = $request -> post('sizename');
		$sizenote = $request -> post('sizenote');

		// 判读尺寸名称是否存在
		$size = new Size;
		$result = $size -> getsizebyname($sizename);

		if(!empty($result)) {
			return 2;
		} else {
			$result = $size -> updatasizebyid($sizeid, $sizename, $sizenote);
			if(!empty($result)) {
				return 1;
			} else {
				return 0;
			}
		}
	}

	// 跳转到添加尺寸
	public function addsize() {

		if(!in_array('3', Session::get('pids'))) {
			$this -> redirect('Index/nopermission'); // 没有权限
		}

		return $this -> fetch();
	}

	// 添加尺寸
	public function addnewsize(Request $request) {
		$sizename = $request -> post('sizename');
		$sizenote = $request -> post('sizenote');

		// 判读尺寸名称是否存在
		$size = new Size;
		$result = $size -> getsizebyname($sizename);

		if(!empty($result)) {
			return 0;
		} else {
			$result = $size -> addnewsize($sizename, $sizenote);
			return 1;
		}
	}
}

?>