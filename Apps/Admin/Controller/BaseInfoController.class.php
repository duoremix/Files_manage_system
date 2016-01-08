<?php
namespace Admin\Controller;
use Think\Controller;
class BaseInfoController extends Controller {
	function __construct(){
		parent::__construct();
		if($_SESSION['username'] == ''){
			$this->redirect("User/index");
		}
	}

    public function index() {
        $this->display('index');
    }

    public function create() {
        $personal_info = M('Personal_info');
        $personal_info->create();
        $data['id'] = $personal_info->count();
        $this->assign('data_id', $data['id']);
        $this->display('create');
    }

    public function check() {
    	$this->display('check');
    }

    public function show() {
    	$this->display('show');
    }

    public function BaseInfo_save() {
        $personal_info = M('personal_info');
        $personal_info->create();
        $res = $personal_info->add();
        $duty_info = M('duty_info');
        $duty_info->create();
        $res2 = $duty_info->add();
        if($res&&$res2) {
            $this->success('新建档案成功!即将返回列表', 'check');
        }
    }

}