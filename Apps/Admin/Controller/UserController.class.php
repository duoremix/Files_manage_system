<?php
namespace Admin\Controller;
use Think\Controller;
class UserController extends Controller {
    public function index(){
    	unset($_SESSION['usertype']);
		unset($_SESSION['username']);
		unset($_SESSION['newFileId']);
		unset($_SESSION['newEmpId']);
        $this->display('login');
    }

    //验证用户名和密码
    public function redir_consultation() {
		//获取用户名和密码
        if($_POST['emp_id']) {
            $data['username'] = $_POST['username'].'-'.$_POST['emp_id'];
            $data2['username'] = $_POST['username'].'-'.$_POST['emp_id'];
        } else {
            $data['username'] = $_POST['username'];
            $data2['username'] = $_POST['username'];
        }
		$data['password'] = md5($_POST['password']);
		$data2['usertype'] = $_POST['usertype'];

		$user = M('user');

		$user_data = $user->field('id')->select();
		if($user_data) {
			$res = $user->where($data)->select();
			$res2 = $user->where($data2)->select();
			if($res&&$res2){
				session_start();
				$_SESSION['usertype'] = $data2['usertype'];
				$_SESSION['username'] = $_POST['username'];
                if($data2['usertype'] != '超级管理员') {
                    session_start();
                    $_SESSION['newEmpId'] = (int)$_POST['emp_id'];
                }
				$this->redirect('Index/index');
			} else {
				$this->error("用户名或者密码不正确");
			}
		} else {
			if($data['username'] == 'admin' && $data['password'] == md5('admin') && $data2['usertype'] == '超级管理员') {
				session_start();
				$_SESSION['usertype'] = $data2['usertype'];
				$_SESSION['username'] = $data['username'];
				$this->redirect('Index/index');
			} else {
				$this->error("用户名或者密码不正确");
			}
		}
    }

    public function user_add() {
    	$this->assign('usertype', $_SESSION['usertype']);
    	$this->display('user_add');
    }

    public function password_edit() {
    	$this->assign('usertype', $_SESSION['usertype']);
    	$this->display('password_edit');
    }

    public function addUser() {
    	$user = M('user');
    	$mysql_data = $user->field('id, username')->select();
    	$auto_id = 1;
    	$arraylength = count($mysql_data);
    	for($x=0;$x<$arraylength;$x++) {
    		$ids[$x] = $mysql_data[$x]['id'];
    		$usernames[$x] = $mysql_data[$x]['username'];
    	}
    	if(in_array($_POST['username'], $usernames)) {
    		$this->error('新增失败！该用户名已存在');
    	} else {
    		while(in_array($auto_id, $ids)) {
    			$auto_id++;
    		}
    		$_POST['id'] = $auto_id;
    		$_POST['password'] = md5($_POST['password']);
    		$user->create();
    		$user->add();
    		$this->success('新增用户成功！', 'user_add');
    	}
    }

    public function editPassword() {
    	$user = M('user');
    	$data['username'] = $_SESSION['username'];
    	$data['password'] = md5($_POST['password']);
    	$res = $user->where($data)->select();
    	if($res) {
    		$form = '<form id="new_password" action="new_password" method="post"><div class="form-field"><input id="password" type="password" name="password" placeholder="新密码"></div><div class="form-field"><input id="r_password" type="password" name="r_password" placeholder="重复密码"><span class="tips">两次输入的密码不同</span></div><div class="form-field"><a id="submit" class="new_submit" href="#">确认</a></div></form>';
    		echo $form;
    	} else {
    		echo 'error';
    	}
    }

    public function new_password() {
    	$user = M('user');
    	$data = $user->where('username='.'"'.$_SESSION['username'].'"')->select();
    	$user->where(array('username'=>$_SESSION['username']))->delete();
    	$data[0]['password'] = md5($_POST['password']);
    	$user->add($data[0]);
    	$this->success('修改密码成功！', 'password_edit');
    }
}