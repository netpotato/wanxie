<?php  

namespace app\admin\Controller;

use think\Controller;
use think\Request;
use think\Session;
use app\admin\model\Color;

class Color extends Controller {

	public function index() {

		if(!in_array('1', Session::get('pids'))) {
			$this -> redirect('Index/nopermission'); // 没有权限
		}

		$color = new Color;
		$colors = $color -> getallcolor();
		$this -> assign('colors', $colors);
		return $this -> fetch();
	}

	// 按颜色编号删除颜色
	public function removecolor(Request $request) {

		if(!in_array('4', Session::get('pids'))) {
			return 99; // 没有权限
		}

		$colorid = $request -> post('colorid');
		$color = new Color;
		$result = $color -> removecolor($colorid);
		if(!empty($result)) {
			return 1;
		} else {
			return 0;
		}
	}

	// 按颜色编号批量删除颜色
	public function removecolors(Request $request) {

		if(!in_array('4', Session::get('pids'))) {
			return 99; // 没有权限
		}

		$colorids = $request -> post('arr/a');
		$colorids = implode(",", $colorids);
		$color = new Color;
		$result = $color -> removecolors($colorids);
		if(!empty($result)) {
			return 1;
		} else {
			return 0;
		}
	}

	// 跳转到修改颜色
	public function updatacolor(Request $request) {

		if(!in_array('3', Session::get('pids'))) {
			$this -> redirect('Index/nopermission'); // 没有权限
		}

		$colorid = $request -> get('colorid');

		$color = new Color;
		$result = $color -> getcolorbyid($colorid);

		$this -> assign('color', $result);
		return $this -> fetch();
	}

	// 按颜色编号修改颜色
	public function updatacolorbyid(Request $request) {
		$colorid = $request -> post('colorid');
		$colorname = $request -> post('colorname');
		$colornote = $request -> post('colornote');

		// 判读颜色名称是否存在
		$color = new Color;
		$result = $color -> getcolorbyname($colorname);

		if(!empty($result)) {
			return 2;
		} else {
			$result = $color -> updatacolorbyid($colorid, $colorname, $colornote);
			if(!empty($result)) {
				return 1;
			} else {
				return 0;
			}
		}
	}

	// 跳转到添加颜色
	public function addcolor() {

		if(!in_array('3', Session::get('pids'))) {
			$this -> redirect('Index/nopermission'); // 没有权限
		}

		return $this -> fetch();
	}

	// 添加颜色
	public function addnewcolor(Request $request) {
		$colorname = $request -> post('colorname');
		$colornote = $request -> post('colornote');

		// 判读颜色名称是否存在
		$color = new Color;
		$result = $color -> getcolorbyname($colorname);

		if(!empty($result)) {
			return 0;
		} else {
			$result = $color -> addnewcolor($colorname, $colornote);
			return 1;
		}
	}
}	

?>