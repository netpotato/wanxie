<?php 

namespace app\admin\Controller;

use think\Controller;
use think\Request;
use think\captcha\Captcha;
use think\Session;
use app\admin\model\Admin;
use app\admin\model\Admingroupview;

class Login extends Controller {

	public function index() {

		return $this -> fetch();

	}

	public function getCaptcha()
    {
        $captcha = new Captcha();
        return $captcha -> entry();
    }
	
	public function login(Request $request){

		$adminname = $request -> post('adminname');
		$adminpwd = md5($request -> post('adminpwd'));
		$code = $request -> post('code');
		
		// $captcha = new Captcha();
		// if (!$captcha -> check($code)) {
  //           $this -> error('验证码错误');
  //       } 
		
		$admin = new Admin();
		if($admin -> login($adminname, $adminpwd)){
			Session::set('adminname', $adminname);

			// 根据名称查询该管理员的所有权限
			$agv = new Admingroupview;
			$pids = $agv -> where("adminname", $adminname) -> find();
			Session::set('pids', explode(',', $pids["pids"]));

			$this -> redirect('Index/index');
		} else {
			$this -> error('用户或密码错误，登陆失败!');
		}
	}
}

?>