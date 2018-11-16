<?php  

namespace app\index\model;

use think\Model;

class Color extends Model {

	protected $table = 'color';

	public function getallcolor() {
		$color = new Color;
		$result = $color -> select();
		return $result;
	}
}

?>