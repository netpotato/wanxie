<?php  

namespace app\index\model;

use think\Model;

class User extends Model {

	protected $table = 'user';

	public function getuserbyname($username) {
		$user = new User;
		$result = $user -> where("username", $username) -> find();
		return $result;
	}

	public function getuserbyid($userid) {
		$user = new User;
		$result = $user -> where("userid", $userid) -> find();
		return $result;
	}

	// 根据用户编号更改用户信息
	public function updatauser($userid, $username, $usersex, $userphone, $useremail) {
		$user = new User;
		$result = $user -> save([
			"username" => $username,
			"usersex" => $usersex,
			"userphone" => $userphone,
			"useremail" => $useremail
		], ['userid' => $userid]);
		return $result;
	}
}

?>