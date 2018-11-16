<?php  

namespace app\index\model;

use think\Model;

class Type extends Model {

	protected $table = 'type';

	public function getalltype() {
		$type = new Type;
		$result = $type -> select();
		return $result;
	}

	
}

?>