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
    	unset($_SESSION['newEmpId']);
	    $personal_info = M('personal_info');
	    $person_data = $personal_info->select();
	    $duty_info = M('duty_info');
	    $duty_data = $duty_info->select();
	    $arraylength = count($person_data);
	    for($x=0;$x<$arraylength;$x++) {
	        if($person_data[$x]['id'] == $duty_data[$x]['id']) {
	            $data[$x]['id'] = $person_data[$x]['id'];
	            $data[$x]['emp_name'] = $person_data[$x]['emp_name'];
	            $data[$x]['emp_sex'] = $person_data[$x]['emp_sex'];
	            $data[$x]['emp_department'] = $duty_data[$x]['emp_department'];
	            $data[$x]['emp_job'] = $duty_data[$x]['emp_job'];
	        }
	    }
	    $arraylength = count($data);
	    $infoData = '<table class="table table-striped"><tr><td>员工编号</td><td>姓名</td><td>性别</td><td>部门</td><td>职务</td><td>操作</td></tr>';
	    for($x=0;$x<$arraylength;$x++) {
	        $infoData = $infoData.'<tr id='.$data[$x]['id'].'>'.'<td>No.'.$data[$x]['id'].'</td>'.'<td>'.$data[$x]['emp_name'].'</td>'.'<td>'.$data[$x]['emp_sex'].'</td>'.'<td>'.$data[$x]['emp_department'].'</td>'.'<td>'.$data[$x]['emp_job'].'</td>'.'<td><a class="list" href="#">查看考勤档案</a></td></tr>';
	    }
	    $infoData = $infoData.'</table>';
	    $this->assign('infoData', $infoData);
    	$this->display('attendence_check');
    }

    public function attendence_list() {
    	if($_POST['id']) {
    		session_start();
    		$_SESSION['newEmpId'] = $_POST['id'];
    	}
    	$duty_info = M('Duty_info');
    	$attendence_info = M('Attendence_info');
    	$emp_name = $duty_info->where('id='.$_SESSION['newEmpId'])->field('emp_name')->select();
    	$this->assign('emp_name', $emp_name[0]['emp_name']);
    	$attendence_data = $attendence_info->where('emp_id='.$_SESSION['newEmpId'])->field('id, fm_num, attendence_status, attendence_reason, attendence_start_date, attendence_end_date, manage_person, manage_date')->select();
    	if($attendence_data) {
    		$infoData = '<table class="table table-striped"><tr><td>档案编号</td><td>考勤状况</td><td>原因</td><td>开始日期</td><td>结束日期</td><td>审批人</td><td>审批日期</td><td>操作</td></tr>';
    		$arraylength = count($attendence_data);
    		for($x=0;$x<$arraylength;$x++) {
    			$infoData = $infoData.'<tr id='.$attendence_data[$x]['id'].'><td>'.$attendence_data[$x]['fm_num'].'</td><td>'.$attendence_data[$x]['attendence_status'].'</td><td>'.$attendence_data[$x]['attendence_reason'].'</td><td>'.$attendence_data[$x]['attendence_start_date'].'</td><td>'.$attendence_data[$x]['attendence_end_date'].'</td><td>'.$attendence_data[$x]['manage_person'].'</td><td>'.$attendence_data[$x]['manage_date'].'</td><td><a class="show" href="#">查看</a><a class="edit" href="#">修改</a><a class="delete" href="#">删除</a></td></tr>';
    		}
    		$infoData = $infoData.'</table>';
    	} else {
    		$infoData = '<div>该员工暂无考勤档案</div>';
    	}
    	$this->assign('infoData', $infoData);
    	$this->display('attendence_list');
    }

    public function attendence_show() {
    	if($_POST['id']) {
    		session_start();
    		$_SESSION['newFileId'] = $_POST['id'];
    	}
    	$attendence_info = M('Attendence_info');
    	$attendence_data = $attendence_info->where('id='.$_SESSION['newFileId'])->select();
    	//写到这里
    	$this->display('attendence_show');
    }

    public function attendence_create() {
    	$department = M('Department');
    	$duty_info = M('Duty_info');
    	if($_SESSION['newEmpId']) {
    		$emp_data = $duty_info->where('id='.$_SESSION['newEmpId'])->field('emp_name, emp_department')->select();
    		$emp_data_str = $emp_data[0]['emp_name'].','.$emp_data[0]['emp_department'];
    		$this->assign('emp_data_str', $emp_data_str);
    		$this->assign('emp_id', $_SESSION['newEmpId']);
    	}

    	$department_data = $department->select();
    	$arraylength = count($department_data);
    	$department_data_str = '';
    	$employee_data_str = '';
    	for($x=0;$x<$arraylength;$x++) {
    		$department_data_str = $department_data_str.'<option value='.$department_data[$x]['department'].'>'.$department_data[$x]['department'].'</option>';
    		$duty_data = $duty_info->where(array('emp_department'=>$department_data[$x]['department']))->field('id, emp_name')->select();
    		$arraylength2 = count($duty_data);
    		for($y=0;$y<$arraylength2;$y++) {
    			$employee_data_str = $employee_data_str.'<input type="hidden" value='.'"<option value='.$duty_data[$y]['emp_name'].' id='.$duty_data[$y]['id'].'>'.$duty_data[$y]['emp_name'].'</option>">';
    		}
    	}
    	$this->assign('department_data_str', $department_data_str);
    	$this->assign('employee_data_str', $employee_data_str);
    	$this->display('attendence_create');
    }

    public function attendence_save() {
    	$attendence_info = M('Attendence_info');
    	$mysql_data = $attendence_info->field('id')->select();
    	$auto_id = 1;
    	$arraylength = count($mysql_data);
    	for($x=0;$x<$arraylength;$x++) {
    		$ids[$x] = $mysql_data[$x]['id'];
    	}
    	while(in_array($auto_id, $ids)) {
    		$auto_id++;
    	}
    	$count = 1;
    	while($auto_id/10 >= 1) {
    		$count++;
    	}
    	$auto_fm_num = 'A';
    	for($x=0;$x<5-$count;$x++) {
    		$auto_fm_num = $auto_fm_num.'0';
    	}
    	$auto_fm_num = $auto_fm_num.$auto_id;
    	$_POST['id'] = $auto_id;
    	$_POST['fm_num'] = $auto_fm_num;
    	$attendence_info->create();
    	$attendence_info->add();
    	session_start();
    	$_SESSION['newEmpId'] = $_POST['emp_id'];
    	$this->success('新建考勤档案成功！', 'attendence_list');
    }

    public function attendence_delete() {
    	$id = $_POST['id'];
    	$attendence_info = M('Attendence_info');
    	$res = $attendence_info->where('id='.$id)->delete();
    }

}