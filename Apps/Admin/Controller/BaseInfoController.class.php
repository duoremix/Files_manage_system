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

    public function check() {
    	$this->display('check');
    }

    public function show() {
        $emp_name = "李小龙";
        $this->assign('emp_name',$emp_name);
    	$this->display('show');
    }

    public function editInfo() {
    	echo "s";
    }
}