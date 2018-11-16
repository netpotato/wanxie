<?php   

namespace app\admin\model;

use think\Model;

class Color extends Model {

	protected $table = 'color';

	public function getallcolor() {
		$color = new Color;
		$result = $color -> select();
		return $result;
	}

	// 根据颜色编号删除颜色
	public function removecolor($colorid) {
		$color = new Color;
		$result = $color -> where('colorid', $colorid) -> delete();
		return $result;
	}

	// 根据颜色编号批量删除颜色
	public function removecolors($colorids) {
		$color = new Color;
		$result = $color -> where("colorid in ($colorids)") -> delete();
		return $result;
	}

	// 根据颜色编号获取颜色
	public function getcolorbyid($colorid) {
		$color = new Color;
		$result = $color -> where('colorid', $colorid) -> find();
		return $result;
	}

	// 根据颜色编号修改颜色
	public function updatacolorbyid($colorid, $colorname, $colornote) {
		$color = new Color;
		$result = $color -> save([
			'colorname' => $colorname,
			'colornote' => $colornote
		], ['colorid' => $colorid]);
		return $result;
	}

	// 根据颜色名称获取颜色
	public function getcolorbyname($colorname) {
		$color = new Color;
		$result = $color -> where('colorname', $colorname) -> find();
		return $result;
	}

	// 添加一个颜色
	public function addnewcolor($colorname, $colornote) {
		$color = new Color;
		$result = $color -> save([
			'colorname' => $colorname,
			'colornote' => $colornote
		]);
		return $result;
	}

}

?>