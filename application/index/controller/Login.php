<?php  

namespace app\index\Controller;

use think\Controller;
use think\Request;
use think\Session;
use app\index\model\User;

class Login extends Controller {

	public function index() {
		return $this -> fetch();
	}

	public function login() {
		return $this -> fetch();
	}

	// 注册
	public function reg(Request $request) {
		$username = $request -> post('username');
		$userpwd = md5($request -> post('userpwd'));
		
		$user = new User;
		// 根据username查询user
		$userdata = $user -> getuserbyname($username);
		if(!empty($result)) {
			return 22; // 用户名已存在
		} else {
			$result = $user -> save([
				"username" => $username,
				"userpwd" => $userpwd
			]);
			return $result; // 1
		}
	}

	// 登录
	public function tologin(Request $request) {
		$username = $request -> post('username');
		$userpwd = md5($request -> post('userpwd'));

		$user = new User;
		// 根据username查询user
		$result = $user -> getuserbyname($username);
		if(empty($result)) {
			return 22; // 用户名不存在
		} else {
			if($userpwd != $result["userpwd"]) {
				return 11; // 密码错误
			} else {
				Session::set("userid", $result['userid']);
				Session::set("username", $username);
				return 1; // 登录成功
			}
		}
	}


	// yzm
	public function getyzm(Request $request) {
		Loader::import('Ucpaas', EXTEND_PATH);

		$appid = "2a1019d3934945bb84b642d16796f7c4";
		$templateid = "373777";


		$strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
		$str = '';
		$max = strlen($strPol)-1;
		for($i=0;$i<4;$i++){
			$str.=$strPol[rand(0,$max)];
		}

		$param = $str;
		$mobile = $_POST['yzmtel'];
		$uid = "";

		$options['accountsid']='6ce96f348994432e4ac391bc0f716d42';
		$options['token']='174fa64c59c81847c9c84d7d5951f5f6';

		$ucpass = new Ucpaas($options);

		echo $ucpass -> SendSms($appid,$templateid,$param,$mobile,$uid);
	}

}

?>