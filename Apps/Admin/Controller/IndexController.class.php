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
        $this->display('index');
    }
}