<?php  

namespace app\index\controller;

use think\Controller;
use think\Request;
use app\index\model\Brand;
use app\index\model\Type;
use app\index\model\Color;
use app\index\model\Size;
use app\index\model\Productalltype;

class Type extends Controller {
    
    public function index() {
        // 获取所有品牌
    	$brand = new Brand;
    	$brands = $brand -> getallbrand();
    	$this -> assign('brands', $brands);

        // 获取所有类型
        $type = new Type;
        $types = $type -> getalltype();
        $this -> assign('types', $types);

        // 获取所有颜色
        $color = new Color;
        $colors = $color -> getallcolor();
        $this -> assign('colors', $colors);

        // 获取所有尺寸
        $size = new Size;
        $sizes = $size -> getallsize();
        $this -> assign('sizes', $sizes);

        // 获取所有男鞋与男女鞋
        $productalltype = new Productalltype;
        $mproducts = $productalltype -> getallmproduct();
        $this -> assign('productsnum', count($mproducts));
        $this -> assign('mproducts', $mproducts);

        return $this -> fetch();
    }

    // 按条件查询商品
    public function getproducts(Request $request) {
        $data = $request -> get();
        if($data['brandname'] == '') {
            unset($data['brandname']);
        }
        if($data['typename'] == '') {
            unset($data['typename']);
        }
        if($data['colorname'] == '') {
            unset($data['colorname']);
        }
        if($data['sizename'] == '') {
            unset($data['sizename']);
        }
        $sex = $data['sex'];
        unset($data['sex']);

        $productalltype = new Productalltype;
        $products = $productalltype -> getproducts($data, $sex);
        return $products;
    }

    // 跳转到女鞋页面
    public function female() {
        // 获取所有品牌
        $brand = new Brand;
        $brands = $brand -> getallbrand();
        $this -> assign('brands', $brands);

        // 获取所有类型
        $type = new Type;
        $types = $type -> getalltype();
        $this -> assign('types', $types);

        // 获取所有颜色
        $color = new Color;
        $colors = $color -> getallcolor();
        $this -> assign('colors', $colors);

        // 获取所有尺寸
        $size = new Size;
        $sizes = $size -> getallsize();
        $this -> assign('sizes', $sizes);

        // 获取所有女鞋与男女鞋
        $productalltype = new Productalltype;
        $wproducts = $productalltype -> getallwproduct();
        $this -> assign('productsnum', count($wproducts));
        $this -> assign('wproducts', $wproducts);

    	return $this -> fetch();
    }
}

?>