<?php  

namespace app\admin\Controller;

use think\Controller;
use app\admin\model\User;
use app\admin\model\Address;

class User extends Controller {
	
	public function index() {
		$user = new User;
		$users = $user -> getalluser();
		$this -> assign('users', $users);
		return $this -> fetch();
	}

	public function address() {
		$address = new Address;
		$addresses = $address -> getalladdress();
		$this -> assign('addresses', $addresses);
		return $this -> fetch();
	}
}

?>