<?php
namespace Admin\Controller;
use Think\Controller;
class PerformanceController extends Controller {
	function __construct(){
		parent::__construct();
		if($_SESSION['username'] == ''){
			$this->redirect("User/index");
		}
	}

    public function attendence_check() {
    	$this->display('attendence_check');
    }

}