<?php  

namespace app\admin\model;

use think\Model;

class User extends Model {

	protected $table = 'user';

	public function getalluser() {
		$user = new User;
		$result = $user -> select();
		return $result;
	}

}

?>