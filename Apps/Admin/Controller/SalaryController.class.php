<?php
namespace Admin\Controller;
use Think\Controller;
class SalaryController extends Controller {
	function __construct(){
		parent::__construct();
		if($_SESSION['username'] == ''){
			$this->redirect("User/index");
		}
	}

    public function index(){
    	$this->assign('usertype', $_SESSION['usertype']);
        $this->display('index');
    }
}