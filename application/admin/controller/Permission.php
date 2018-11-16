<?php  

namespace app\admin\Controller;

use think\Controller;
use think\Request;
use think\Session;
use think\Db;
use app\admin\model\Group;
use app\admin\model\Admin;
use app\admin\model\Admingroup;
use app\admin\model\Admingroupview;
use app\admin\model\Permission;

class Permission extends Controller {

	// 跳转到查看管理员
	public function admin() {

		if(!in_array('11', Session::get('pids'))) {
			$this -> redirect('Index/nopermission'); // 没有权限
		}

		$agview = new Admingroupview;
		$admins = $agview -> select();
		$this -> assign("admins", $admins);

		return $this -> fetch();
	}

	// 跳转到添加管理员
	public function addadmin() {
		// 查询所有分组
		$group = new Group;
		$groups = $group -> getallGroup();
		$this -> assign("groups", $groups);

		return $this -> fetch();
	}

	// 根据管理员编号删除
	public function removeadmin(Request $request) {
		$adminid = $request -> post('adminid');

		// 先删除admingroup表
		$admingroup = new Admingroup;
		$result = $admingroup -> removeadminbyid($adminid);

		if(!empty($result)) {
			$admin = new Admin;
			$result = $admin -> removeadminbyid($adminid);
			return $result;
		}
	}

	// 根据管理员编号批量删除
	public function removeadmins(Request $request) {
		$adminids = $request -> post('arr/a');
		$adminids = implode(",", $adminids);

		// 先删除admingroup表
		$admingroup = new Admingroup;
		$result = $admingroup -> removeadmins($adminids);

		if(!empty($result)) {
			$admin = new Admin;
			$result = $admin -> removeadmins($adminids);
			if(!empty($result)) {
				return 1;
			} else {
				return 0;
			}
		}
	}

	// 添加管理员
	public function addoneadmin(Request $request) {
		$adminname = $request -> post('adminname');
		$adminpwd = md5($request -> post('adminpwd'));
		$adminnote = $request -> post('adminnote');
		$groupid = $request -> post('groupid');

		// 判断名称是否已存在
		$admin = new Admin;
		$result = $admin -> where("adminname", $adminname) -> find();
		if(!empty($result)) {
			return 22; // 名称已存在
		} else {
			// 存储admin表返回id
			$adminid = Db::name('admin') -> insertGetId([
				"adminname" => $adminname,
				"adminpwd" => $adminpwd,
				"adminnote" => $adminnote
			]);

			// 存储admingroup表
			$admingroup = new Admingroup;
			$result = $admingroup -> save([
				"adminid" => $adminid,
				"groupid" => $groupid
			]);

			return $result;
		}
	}

	// 跳转到修改管理员分组
	public function updataadmin(Request $request) {
		$adminid = $request -> get('adminid');

		// 根据编号查询管理员
		$agv = new Admingroupview;
		$admindata = $agv -> getadminbyid($adminid);
		$this -> assign("admindata", $admindata);

		// 查询所有分组
		$group = new Group;
		$groups = $group -> getallGroup();
		$this -> assign("groups", $groups);

		return $this -> fetch();
	}

	// 根据管理员编号修改管理员分组
	public function updataadmingroup(Request $request) {
		$adminid = $request -> post('adminid');
		$groupid = $request -> post('groupid');

		$admingroup = new Admingroup;
		$result = $admingroup -> updataadmingroup($adminid, $groupid);
		return $result;
	}

	// 跳转到管理分组
	public function group() {

		if(!in_array('11', Session::get('pids'))) {
			$this -> redirect('Index/nopermission'); // 没有权限
		}

		// 查询所有分组
		$group = new Group;
		$groups = $group -> getallGroup();
		$this -> assign("groups", $groups);

		return $this -> fetch();
	}

	// 跳转到添加分组
	public function addgroup() {

		// 查询所有权限
		$permission = new Permission;
		$permissions = $permission -> getallpermission();
		$this -> assign("permissions", $permissions);

		return $this -> fetch();
	}

	// 添加分组
	public function addonegroup(Request $request) {
		$groupname = $request -> post('groupname');
		$pids = $request -> post('pids/a');
		$pids = $pids[0];

		if(empty($groupname)) {
			return 11; // 分组名称为空
		}

		// 判断分组名称是否已存在
		$group = new Group;
		$result = $group -> where("groupname", $groupname) -> find();
		if(!empty($result)) {
			return 22; // 名称已存在
		} else {
			$result = $group -> save([
				"groupname" => $groupname,
				"pids" => $pids
			]);

			return $result;
		}
	}

	// 根据分组编号删除分组
	public function removegroup(Request $request) {
		$groupid = $request -> post('groupid');

		// 判断该分组是否有成员
		$admingroup = new Admingroup;
		$result = $admingroup -> where('groupid', $groupid) -> select();
		if(!empty($result)) {

			return 11; // 该分组有成员,不能删除
		} else {
			$group = new Group;
			$result = $group -> where("groupid", $groupid) -> delete();

			return $result;
		}
	}

	// 跳转到修改分组
	public function updatagroup(Request $request) {
		$groupid = $request -> get('groupid');

		// 查询所有权限
		$permission = new Permission;
		$permissions = $permission -> getallpermission();
		$this -> assign("permissions", $permissions);

		// 根据分组编号查询
		$group = new Group;
		$groupdata = $group -> getgroupbyid($groupid);
		$this -> assign("groupdata", $groupdata);

		return $this -> fetch();
	}

	// 修改分组
	public function toupdatagroup(Request $request) {
		$groupid = $request -> post('groupid');
		$frontname = $request -> post('frontname');
		$groupname = $request -> post('groupname');
		$pids = $request -> post('pids/a');
		$pids = $pids[0];

		// 判断分组名称是否已存在
		$group = new Group;
		$result = $group -> where("groupname", $groupname) -> find();
		if(!empty($result) && $frontname!=$groupname) {
			return 22; // 名称已存在
		} else {
			$result = $group -> save([
				"groupname" => $groupname,
				"pids" => $pids
			], ["groupid" => $groupid]);

			return $result;
		}
	}

	// 跳转到查看权限
	public function permission() {

		if(!in_array('11', Session::get('pids'))) {
			$this -> redirect('Index/nopermission'); // 没有权限
		}

		// 查询所有权限
		$permission = new Permission;
		$permissions = $permission -> getallpermission();
		$this -> assign("permissions", $permissions);

		return $this -> fetch();
	}
}	

?>