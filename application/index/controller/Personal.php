<?php  

namespace app\index\Controller;

use think\Controller;

class Personal extends Controller {

	public function index() {

		return $this -> fetch();

	}

}

?>