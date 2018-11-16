<?php  

namespace app\admin\model;

use think\Model;

class Address extends Model {

	protected $table = 'address';

	// 获取所有的地址
	public function getalladdress() {
		$address = new Address;
		$result = $address -> select();
		return $result;
	}

}

?>