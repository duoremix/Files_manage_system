<?php
namespace Admin\Controller;
use Think\Controller;
class BaseInfoController extends Controller {
    public function index(){
        $this->display('index');
    }
}