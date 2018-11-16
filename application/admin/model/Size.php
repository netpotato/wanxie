<?php  

namespace app\admin\model;

use think\Model;

class Size extends Model {

	protected $table = 'size';

	public function getallsize() {
		$size = new Size;
		$result = $size -> select();
		return $result;
	}

	// 根据尺寸编号删除尺寸
	public function removesize($sizeid) {
		$size = new Size;
		$result = $size -> where('sizeid', $sizeid) -> delete();
		return $result;
	}

	// 根据尺寸编号批量删除尺寸
	public function removesizes($sizeids) {
		$size = new Size;
		$result = $size -> where("sizeid in ($sizeids)") -> delete();
		return $result;
	}

	// 根据尺寸编号获取尺寸
	public function getsizebyid($sizeid) {
		$size = new Size;
		$result = $size -> where('sizeid', $sizeid) -> find();
		return $result;
	}

	// 根据尺寸编号修改尺寸
	public function updatasizebyid($sizeid, $sizename, $sizenote) {
		$size = new Size;
		$result = $size -> save([
			'sizename' => $sizename,
			'sizenote' => $sizenote
		], ['sizeid' => $sizeid]);
		return $result;
	}

	// 根据尺寸名称获取尺寸
	public function getsizebyname($sizename) {
		$size = new Size;
		$result = $size -> where('sizename', $sizename) -> find();
		return $result;
	}

	// 添加一个尺寸
	public function addnewsize($sizename, $sizenote) {
		$size = new Size;
		$result = $size -> save([
			'sizename' => $sizename,
			'sizenote' => $sizenote
		]);
		return $result;
	}

}

?>