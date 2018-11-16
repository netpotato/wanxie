<?php

namespace app\index\controller;

use think\Controller;
use think\Session;
use app\index\model\Productalltype;

class Index extends Controller {
    
    public function index() {
    	// 获取新品球鞋(4个)
    	$newnum = 4;
    	$productalltype = new Productalltype;
    	$products = $productalltype -> getnewshoes($newnum);
    	$this -> assign("newproducts", $products);

    	// 获取销量排名前8个
    	$salesnum = 8;
    	$salesproducts = $productalltype -> getsalesproducts($salesnum);
    	$this -> assign("salesproducts", $salesproducts);

        return $this -> fetch();
    }

    public function exit() {
    	Session::delete('username');
    	return 1;
    }
}

?>
