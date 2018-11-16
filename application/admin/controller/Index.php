<?php  

namespace app\admin\Controller;

use think\Controller;
use think\Session;
use think\Request;
use app\admin\model\Admin;

class Index extends Controller {

	public function index() {
		$adminname = Session::get('adminname');
		if(empty($adminname)) {
			$this -> redirect('admin/login/index');
		}

		return $this -> fetch();
	}

	// 跳转到管理员资料
	public function updataadmin() {
		$adminname = Session::get('adminname');

		// 根据管理员名称查询
		$admin = new Admin;
		$admindata = $admin -> where('adminname', $adminname) -> find();
		$this -> assign("admindata", $admindata);

		return $this -> fetch();
	}

	// 管理员修改资料
	public function toupdataadmin(Request $request) {
		$adminid = $request -> post('adminid');
		$frontadminname = $request -> post('frontadminname');
		$adminname = $request -> post('adminname');
		$adminnote = $request -> post('adminnote');

		// 判断名称是否已存在
		$admin = new Admin;
		$return = $admin -> where('adminname', $adminname) -> find();
		if(!empty($result) && $adminname!=$frontadminname) {
			return 22; // 名称已存在
		} else {
			$result = $admin -> save([
				"adminname" => $adminname,
				"adminnote" => $adminnote
			], ["adminid" => $adminid]);

			Session::set("adminname", $adminname);

			return $result;
		}
	}

	// 跳转到修改密码
	public function updatapwd() {
		$adminname = Session::get('adminname');

		// 根据管理员名称查询
		$admin = new Admin;
		$admindata = $admin -> where('adminname', $adminname) -> find();
		$this -> assign("admindata", $admindata);

		return $this -> fetch();
	}

	// 验证原密码
	public function surepwd(Request $request) {
		$adminpwd = md5($request -> post('adminpwd'));

		$adminname = Session::get('adminname');

		// 根据管理员名称查询
		$admin = new Admin;
		$result = $admin -> where([
			'adminname' => $adminname,
			'adminpwd' => $adminpwd
		]) -> find();
		if(empty($result)) {
			return 22; // 密码错误
		} else {
			return 1;
		}
	}

	// 修改密码
	public function updataadminpwd(Request $request) {
		$adminpwd = md5($request -> post('adminpwd'));
		$adminname = Session::get('adminname');

		$admin = new Admin;
		$result = $admin -> save([
			"adminpwd" => $adminpwd
		], ["adminname" => $adminname]);

		return $result;
	}

	// 退出登录
	public function exit() {
		Session::delete('adminname');
		$this -> redirect('admin/login/index');
	}

	// 欢迎页面
	public function welcome() {
		return $this -> fetch();
	}

	// 没权限页面
	public function nopermission() {
		return $this -> fetch();
	}
}	

?>