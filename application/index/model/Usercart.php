<?php  

namespace app\index\model;

use think\Model;

class Usercart extends Model {

	protected $table = 'usercart';

	// 根据用户名称获取购物车信息
	public function getallcartbyuserid($userid) {
		$usercart = new Usercart;
		$result = $usercart -> where('userid', $userid) -> select();
		return $result;
	}
}

?>