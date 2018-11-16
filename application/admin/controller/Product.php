<?php  

namespace app\admin\Controller;

use think\Controller;
use think\Request;
use think\Session;
use think\Db;;
use app\admin\model\Product;
use app\admin\model\Type;
use app\admin\model\Brand;
use app\admin\model\Color;
use app\admin\model\Size;
use app\admin\model\Productalltype;
use app\admin\model\Belong;
use app\admin\model\Productimg;

class Product extends Controller {
	
	public function index() {

		if(!in_array('5', Session::get('pids'))) {
			$this -> redirect('Index/nopermission'); // 没有权限
		}

		// 查询商品总数
		$product = new Productalltype;
		$allproductnum = $product -> select();
		$this -> assign('allproductnum', count($allproductnum));

		return $this -> fetch();
	}

	// 分页
	public function getpage(Request $request) {
		$pageindex = $request -> post('pageindex');
		$num = $request -> post('num');
		$start = ($pageindex-1)*$num;

		$product = new Productalltype;
		$products = $product -> getpageproduct($start, $num);
		$this -> assign('products', $products);

		return $products;
	}

	// 跳转到添加商品
	public function addproduct() {

		if(!in_array('6', Session::get('pids'))) {
			$this -> redirect('Index/nopermission'); // 没有权限
		}

		// 获取所有类型
		$type = new Type;
		$types = $type -> getalltype();
		$this -> assign('types', $types);
		// 获取所有品牌
		$brand = new Brand;
		$brands = $brand -> getallbrand();
		$this -> assign('brands', $brands);
		// 获得所有颜色
		$color = new Color;
		$colors = $color -> getallcolor();
		$this -> assign('colors', $colors);
		// 获得所有尺寸
		$size = new Size;
		$sizes = $size -> getallsize();
		$this -> assign('sizes', $sizes);
		return $this -> fetch();
	}

	// 添加商品
	public function toaddproduct(Request $request) {
		$productdata = $request -> post();

		$product = new Product;
		$file = request()->file('file');
	    if (empty($file)) { 
      		return 33; // 未选择图片 
    	}
    	// 获得时间
    	$date = strval(date("Ymd"));

    	$info = $file -> move(ROOT_PATH . 'public/static' . DS . 'uploads');
	    if ($info) {
	    	$filename = $info -> getFilename();
	    	$imgurl = "/uploads/" . $date . "/" . $filename; // 存储图片路径

	    	// 提取一些值
	    	$typeid = $productdata['typeid'];
	    	$brandid = $productdata['brandid'];
	    	$colorid = $productdata['colorid'];
	    	$sizeid = $productdata['sizeid'];
	    	$sex = $productdata['sex'];
	    	unset($productdata['typeid']);
	    	unset($productdata['brandid']);
	    	unset($productdata['colorid']);
	    	unset($productdata['sizeid']);
	    	unset($productdata['sex']);

	   		// 存储product表
	   		$addtime = date("Y-m-d H:i:s");
	   		$productdata['addtime'] = $addtime;
		    Db::name('product') -> insert($productdata);
		    // 获得存储后的productid
		    $productid = Db::name('product') -> getLastInsID();

		    // 存储productimg、belong表
		    $productimg = new Productimg;
		    $productimg -> save([
		      		"productid" => $productid,
		      		"imgurl" => $imgurl
		    ]);

		    $belong = new Belong;
		    $belong -> save([
		        "productid" => $productid,
		      	"typeid" => $typeid,
		      	"brandid" => $brandid,
		      	"colorid" => $colorid,
		      	"sizeid" => $sizeid,
		      	"sex" => $sex
		    ]);
		    return 11;
		} else {
		    $this -> error($file -> getError()); 
		}
	}

	// 根据编号删除商品
	public function removeproductbyid(Request $request) {

		if(!in_array('8', Session::get('pids'))) {
			return 99; // 没有权限
		}

		$productid = $request -> post('productid');

		$belong = new Belong;
		$belong -> removeproduct($productid);
		
		$productimg = new Productimg;
		$productimg -> removeproduct($productid);

		$product = new Product;
		$result = $product -> removeproduct($productid);
		return $result;
	}

	// 按类型编号批量删除类型
	public function removeproducts(Request $request) {

		if(!in_array('8', Session::get('pids'))) {
			return 99; // 没有权限
		}

		$productids = $request -> post('arr/a');
		$productids = implode(",", $productids);
		
		$belong = new Belong;
		$productimg = new Productimg;
		$product = new Product;
		
		$belong -> removeproducts($productids);
		$productimg -> removeproducts($productids);
		$product -> removeproducts($productids);

		return 1; // 改
	}

	// 跳转到修改商品
	public function updataproduct(Request $request) {

		if(!in_array('7', Session::get('pids'))) {
			$this -> redirect('Index/nopermission'); // 没有权限
		}

		$productid = $request -> get('productid');
		$this -> assign('productid', $productid);
		// 根据商品id查找
		$productalltype = new Productalltype;
		$products = $productalltype -> getproductbyid($productid);
		$this -> assign('products', $products);

		// 获取所有类型
		$type = new Type;
		$types = $type -> getalltype();
		$this -> assign('types', $types);
		// 获取所有品牌
		$brand = new Brand;
		$brands = $brand -> getallbrand();
		$this -> assign('brands', $brands);
		// 获得所有颜色
		$color = new Color;
		$colors = $color -> getallcolor();
		$this -> assign('colors', $colors);
		// 获得所有尺寸
		$size = new Size;
		$sizes = $size -> getallsize();
		$this -> assign('sizes', $sizes);

		return $this -> fetch();
	}

	// 根据商品编号修改商品
	public function toupdataproduct(Request $request) {
		$productdata = $request -> post();

		$product = new Product;

		// 提取一些值
		$productid = $productdata['productid'];
		$typeid = $productdata['typeid'];
		$brandid = $productdata['brandid'];
		$colorid = $productdata['colorid'];
		$sizeid = $productdata['sizeid'];
		$sex = $productdata['sex'];
		unset($productdata['typeid']);
		unset($productdata['brandid']);
		unset($productdata['colorid']);
		unset($productdata['sizeid']);
		unset($productdata['sex']);
		unset($productdata['productid']);

		$file = request()->file('file');
	    if (empty($file)) { 
      		// 存储product表
      		unset($productdata['file']);
		    $product -> save($productdata, ["productid" => $productid]);
		    // 存储belong表
		    $belong = new Belong;
		    $belong -> save([
		      	"typeid" => $typeid,
		      	"brandid" => $brandid,
		      	"colorid" => $colorid,
		      	"sizeid" => $sizeid,
		      	"sex" => $sex
		      ], ["productid" => $productid]);
		      return 11;
    	} else {
    		// 获得时间
	    	$date = strval(date("Ymd"));

	    	$info = $file -> move(ROOT_PATH . 'public/static' . DS . 'uploads');
		    if ($info) {
		    	$filename = $info -> getFilename();
		    	$imgurl = "/uploads/" . $date . "/" . $filename; // 存储图片路径

		    	// 存储product表
			    $product -> save($productdata, ["productid" => $productid]);

			    // 存储productimg、belong表
			    $productimg = new Productimg;
			    $productimg -> save([
			        "imgurl" => $imgurl
			    ], ["productid" => $productid]);

			    $belong = new Belong;
			    $belong -> save([
			        "typeid" => $typeid,
			      	"brandid" => $brandid,
			      	"colorid" => $colorid,
			      	"sizeid" => $sizeid,
			      	"sex" => $sex
			    ], ["productid" => $productid]);
			    return 11;
			} else {
			    $this -> error($file -> getError()); 
			}
    	}
	}
}

?>