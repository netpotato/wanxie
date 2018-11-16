<?php  

namespace app\index\model;

use think\Model;

class Size extends Model {

	protected $table = 'size';

	public function getallsize() {
		$size = new Size;
		$result = $size -> select();
		return $result;
	}
}

?>