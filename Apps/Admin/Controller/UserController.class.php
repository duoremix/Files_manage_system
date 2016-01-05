<?php
namespace Admin\Controller;
use Think\Controller;
class UserController extends Controller {
    public function index(){
    	unset($_SESSION['job']);
		unset($_SESSION['username']);
        $this->display('login');
    }

    //验证用户名和密码
    public function redir_consultation() {
		//获取用户名和密码
		$data['username'] = $_POST['username'];
		$data['password'] = md5($_POST['password']);
		$data2['job'] = $_POST['usertype'];
		$data2['username'] = $_POST['username'];
		//dump($data);exit;
		//实例化对象
		$user = M('User');
		//查询数据库中的用户名和密码
		$res = $user->where($data)->select();
		//查询数据库中的用户名和职位
		$res2 = $user->where($data2)->select();
		//检验用户名和职位的合法性
		if($res2){
		}else{
			$this->error("用户与职位不匹配，请重选");
		}
		//检验用户名和密码的合法性
		if($res){
			session_start();
			$_SESSION['job'] = $data['job'];
			$_SESSION['username'] = $data['username'];
			$this->redirect('Index/index');
		}else{
			$this->error("用户名或者密码不正确");
		}
    }
}