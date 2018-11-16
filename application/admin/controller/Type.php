<?php  

namespace app\admin\Controller;

use think\Controller;
use think\Request;
use think\Session;
use app\admin\model\Type;

class Type extends Controller {
	
	public function index() {

		if(!in_array('1', Session::get('pids'))) {
			$this -> redirect('Index/nopermission'); // 没有权限
		}

		$type = new Type;
		$types = $type -> getalltype();
		$this -> assign('types', $types);
		return $this -> fetch();
	}

	// 按类型编号删除类型
	public function removetype(Request $request) {

		if(!in_array('4', Session::get('pids'))) {
			return 99; // 没有权限
		}

		$typeid = $request -> post('typeid');
		$type = new Type;
		$result = $type -> removetype($typeid);
		if(!empty($result)) {
			return 1;
		} else {
			return 0;
		}	
	}

	// 按类型编号批量删除类型
	public function removetypes(Request $request) {

		if(!in_array('4', Session::get('pids'))) {
			return 99; // 没有权限
		}

		$typeids = $request -> post('arr/a');
		$typeids = implode(",", $typeids);
		$type = new Type;
		$result = $type -> removetypes($typeids);
		if(!empty($result)) {
			return 1;
		} else { 
			return 0;
		}
	}

	// 跳转到修改类型
	public function updatatype(Request $request) {

		if(!in_array('3', Session::get('pids'))) {
			$this -> redirect('Index/nopermission'); // 没有权限
		}

		$typeid = $request -> get('typeid');

		$type = new Type;
		$result = $type -> gettypebyid($typeid);

		$this -> assign('type', $result);
		return $this -> fetch();
	}

	// 按类型编号修改类型
	public function updatatypebyid(Request $request) {
		$typeid = $request -> post('typeid');
		$typename = $request -> post('typename');
		$typenote = $request -> post('typenote');

		// 判读类型名称是否存在
		$type = new Type;
		$result = $type -> gettypebyname($typename);

		if(!empty($result)) {
			return 2;
		} else {
			$result = $type -> updatatypebyid($typeid, $typename, $typenote);
			if(!empty($result)) {
				return 1;
			} else {
				return 0;
			}
		}		
	}

	// 跳转到添加类型
	public function addtype() {

		if(!in_array('3', Session::get('pids'))) {
			$this -> redirect('Index/nopermission'); // 没有权限
		}
		
		return $this -> fetch();
	}

	// 添加类型
	public function addnewtype(Request $request) {
		$typename = $request -> post('typename');
		$typenote = $request -> post('typenote');

		// 判读类型名称是否存在
		$type = new Type;
		$result = $type -> gettypebyname($typename);

		if(!empty($result)) {
			return 0;
		} else {
			$result = $type -> addnewtype($typename, $typenote);
			return 1;
		}
	}
}

?>