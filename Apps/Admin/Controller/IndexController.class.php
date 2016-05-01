<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
	function __construct(){
		parent::__construct();
		if($_SESSION['username'] == ''){
			$this->redirect("User/index");
		}
	}

    public function index(){
    	$user = M('user');
    	$data = $user->where('id=0')->select();
    	if($data) {
    		$initPwdFlag = true;
    	} else {
    		$initPwdFlag = false;
    	}
    	$this->assign('usertype', $_SESSION['usertype']);
    	$this->assign('initPwdFlag', $initPwdFlag);
        $this->display('index');
    }

    public function initPwdSetting() {
        $user = M('user');
        $data['id'] = 0;
        $data['password'] = md5($_POST['password']);
        $data['username'] = 'admin';
        $user->add($data);
    }
}