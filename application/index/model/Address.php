<?php  

namespace app\index\model;

use think\Model;

class Address extends Model {

	protected $table = 'address';

	// 获取所有地址
	public function getalladdress($userid) {
		$address = new Address;

		$result = $address -> where("userid", $userid) -> select();
		return $result;
	}

	//
	public function removeaddress($addressid) {
		$address = new Address;

		$result = $address -> where("addressid", $addressid) -> delete();
		return $result;
	}
}

?>