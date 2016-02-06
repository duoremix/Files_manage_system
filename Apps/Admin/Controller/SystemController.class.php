<?php
namespace Admin\Controller;
use Think\Controller;
class SystemController extends Controller {
	function __construct(){
		parent::__construct();
		if($_SESSION['username'] == ''){
			$this->redirect("User/index");
		}
	}

	public function system_init() {
		$this->assign('usertype', $_SESSION['usertype']);
	    $this->display('system_init');
	}

	public function systemInit() {
		if(md5($_POST['password']) == md5('admin')) {
			echo 'yes';
		}
	}

	public function basedata_setting() {
		$this->assign('usertype', $_SESSION['usertype']);
	    $this->display('basedata_setting');
	}

    public function basedata_init() {
    	$mysql = M($_POST['id']);
    	$mysql_data = $mysql->select();
    	if($mysql_data) {
    		$arraylength = count($mysql_data);
    		$infoData = '<div class="single-row"><input id="content" type="text" name="content" class="short"><span>&nbsp;</span><a id="add" class="btn btn-primary" href="#">添加</a><span>&nbsp;</span><a id="cancel" class="btn btn-default" href="#">返回</a></div><p id='.$_POST['id'].' class="form-title">'.$_POST['name'].'</p><table class="table table-striped"><tr><td>编号</td><td>内容</td><td>操作</td></tr>';
    		for($x=0;$x<$arraylength;$x++) {
    			$infoData = $infoData.'<tr id='.$mysql_data[$x]['id'].'><td>'.$mysql_data[$x]['id'].'</td>'.'<td>'.$mysql_data[$x]['content'].'</td>'.'<td><a class="delete" href="#">删除</a></td>'.'</tr>';
    		}
    		$infoData = $infoData.'</table>';
    	} else {
    		$infoData = '<div class="single-row"><input id="content" type="text" name="content" class="short"><span>&nbsp;</span><a id="add" class="btn btn-primary" href="#">添加</a><span>&nbsp;</span><a id="cancel" class="btn btn-default" href="#">返回</a></div><p id='.$_POST['id'].' class="form-title">尚未有<span>'.$_POST['name'].'</span>的资料</p>';
    	}
    	echo $infoData;
    }

    public function basedata_delete() {
    	$data_id = $_POST['data_id'];
    	$mysql = M($_POST['id']);
    	$mysql->where('id='.$data_id)->delete();
    	$mysql_data = $mysql->select();
    	if($mysql_data) {
    		$arraylength = count($mysql_data);
    		$infoData = '<div class="single-row"><input id="content" type="text" name="content" class="short"><span>&nbsp;</span><a id="add" class="btn btn-primary" href="#">添加</a><span>&nbsp;</span><a id="cancel" class="btn btn-default" href="#">返回</a></div><p id='.$_POST['id'].' class="form-title">'.$_POST['name'].'</p><table class="table table-striped"><tr><td>编号</td><td>内容</td><td>操作</td></tr>';
    		for($x=0;$x<$arraylength;$x++) {
    			$infoData = $infoData.'<tr id='.$mysql_data[$x]['id'].'><td>'.$mysql_data[$x]['id'].'</td>'.'<td>'.$mysql_data[$x]['content'].'</td>'.'<td><a class="delete" href="#">删除</a></td>'.'</tr>';
    		}
    		$infoData = $infoData.'</table>';
    	} else {
    		$infoData = '<div class="single-row"><input id="content" type="text" name="content" class="short"><span>&nbsp;</span><a id="add" class="btn btn-primary" href="#">添加</a><span>&nbsp;</span><a id="cancel" class="btn btn-default" href="#">返回</a></div><p id='.$_POST['id'].' class="form-title">尚未有<span>'.$_POST['name'].'</span>的资料</p>';
    	}
    	echo $infoData;
    }

    public function basedata_add() {
    	$data['content'] = $_POST['content'];
    	$mysql = M($_POST['id']);
    	$mysql_data = $mysql->select();
    	$auto_id = 1;
    	$arraylength = count($mysql_data);
    	for($x=0;$x<$arraylength;$x++) {
    		$ids[$x] = $mysql_data[$x]['id'];
    	}
    	while(in_array($auto_id, $ids)) {
    		$auto_id++;
    	}
    	$data['id'] = $auto_id;
    	$mysql->add($data);
    	$mysql_data = $mysql->select();
    	if($mysql_data) {
    		$arraylength = count($mysql_data);
    		$infoData = '<div class="single-row"><input id="content" type="text" name="content" class="short"><span>&nbsp;</span><a id="add" class="btn btn-primary" href="#">添加</a><span>&nbsp;</span><a id="cancel" class="btn btn-default" href="#">返回</a></div><p id='.$_POST['id'].' class="form-title">'.$_POST['name'].'</p><table class="table table-striped"><tr><td>编号</td><td>内容</td><td>操作</td></tr>';
    		for($x=0;$x<$arraylength;$x++) {
    			$infoData = $infoData.'<tr id='.$mysql_data[$x]['id'].'><td>'.$mysql_data[$x]['id'].'</td>'.'<td>'.$mysql_data[$x]['content'].'</td>'.'<td><a class="delete" href="#">删除</a></td>'.'</tr>';
    		}
    		$infoData = $infoData.'</table>';
    	} else {
    		$infoData = '<div class="single-row"><input id="content" type="text" name="content" class="short"><span>&nbsp;</span><a id="add" class="btn btn-primary" href="#">添加</a><span>&nbsp;</span><a id="cancel" class="btn btn-default" href="#">返回</a></div><p>尚未有'.$_POST['name'].'的资料</p>';
    	}
    	echo $infoData;
    }

    public function company_frame() {
        $department = M('department');
        $department_data = $department->select();
        $arraylength = count($department_data);
        if($arraylength) {
            $department_init = '<option value="无" checked>无</option>';
            $infoData = '<table class="table table-striped"><tr><td>部门名称</td><td>所属上级部门</td><td>操作</td></tr>';
            for($x=0;$x<$arraylength;$x++) {
                $department_init = $department_init.'<option value='.$department_data[$x]['department'].'>'.$department_data[$x]['department'].'</option>';
                $superior_department = $department->field('department')->where('id='.$department_data[$x]['superior_id'])->select();
                if(!$superior_department[0]['department']) {
                    $superior_department[0]['department'] = '无';
                }
                $infoData = $infoData.'<tr><td>'.$department_data[$x]['department'].'</td><td><select>';
                if($superior_department[0]['department'] == '无') {
                    $infoData = $infoData.'<option value="无" checked>无</option>';
                } else {
                    $infoData = $infoData.'<option value="无">无</option>';
                }
                for($y=0;$y<$arraylength;$y++) {
                    if($y != $x) {
                        if($superior_department[0]['department'] == $department_data[$y]['department']) {
                            $infoData = $infoData.'<option value='.$department_data[$y]['department'].' checked>'.$department_data[$y]['department'].'</option>';
                        } else {
                            $infoData = $infoData.'<option value='.$department_data[$y]['department'].'>'.$department_data[$y]['department'].'</option>';
                        }
                    }
                }
                $infoData = $infoData.'</select></td><td><a class="delete" href="#">删除</a></td></tr>';
            }
            $infoData = $infoData.'</table><div class="single-row"><a id="save" class="btn btn-primary" style="display:none">保存更改</a></div>';
        } else {
            $infoData = '<p class="form-title">尚未有部门信息</p>';
        }
        $this->assign('infoData', $infoData);
        $this->assign('department_init', $department_init);
        $this->display('company_frame');
    }

    public function department_add() {
        $department = M('department');
        $data['department'] = $_POST['new_department'];
        $superior_id = $department->field('id')->where(array('department'=>$_POST['superior_department']))->select();
        $data['superior_id'] = $superior_id[0]['id'];
        if(!$data['superior_id']) {
            $data['superior_id'] = 0;
        }
        $mysql_data = $department->select();
        $auto_id = 1;
        $arraylength = count($mysql_data);
        for($x=0;$x<$arraylength;$x++) {
            $ids[$x] = $mysql_data[$x]['id'];
        }
        while(in_array($auto_id, $ids)) {
            $auto_id++;
        }
        $data['id'] = $auto_id;
        $department->add($data);
    }

    public function department_delete() {
        $department = M('department');
        $superior_id = $department->field('id')->where(array('department'=>$_POST['department']))->select();
        $inferior_id = $department->field('id')->where(array('superior_id'=>$superior_id[0]['id']))->select();
        $arraylength = count($inferior_id);
        for($x=0;$x<$arraylength;$x++) {
            $data = $department->where(array('id'=>$inferior_id[$x]['id']))->select();
            $data[0]['superior_id'] = 0;
            $department->where(array('id'=>$inferior_id[$x]['id']))->delete();
            $department->add($data[0]);
        }
        $department->where(array('department'=>$_POST['department']))->delete();
    }

    public function department_edit() {
        $department = M('department');
        $department_post = $_POST['department'];
        $superior_department_post = $_POST['superior_department'];
        $arraylength = count($department_post);
        for($x=0;$x<$arraylength;$x++) {
            $data = $department->where(array('department'=>$department_post[$x]))->select();
            $new_superior_id = $department->field('id')->where(array('department'=>$superior_department_post[$x]))->select();
            if(!$new_superior_id) {
                $data[0]['superior_id'] = 0;
            } else {
                $data[0]['superior_id'] = $new_superior_id[0]['id'];
            }
            $department->where(array('department'=>$department_post[$x]))->delete();
            $department->add($data[0]);
        }
    }
}