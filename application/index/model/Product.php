<?php  

namespace app\index\model;

use think\Model;

class Product extends Model {

	protected $table = 'product';

	public function get() {
		$user = new User;
		$result = $user -> where("username", $username) -> find();
		return $result;
	}


}

?>