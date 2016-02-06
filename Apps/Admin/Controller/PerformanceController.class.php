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
	    if($arraylength) {
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
        } else {
            $infoData = '<div>尚未有考勤档案</div>';
        }
	    $this->assign('infoData', $infoData);
        $this->assign('usertype', $_SESSION['usertype']);
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
    			$infoData = $infoData.'<tr id='.$attendence_data[$x]['id'].'><td>'.$attendence_data[$x]['fm_num'].'</td><td>'.$attendence_data[$x]['attendence_status'].'</td><td>'.$attendence_data[$x]['attendence_reason'].'</td><td>'.$attendence_data[$x]['attendence_start_date'].'</td><td>'.$attendence_data[$x]['attendence_end_date'].'</td><td>'.$attendence_data[$x]['manage_person'].'</td><td>'.$attendence_data[$x]['manage_date'].'</td><td><a class="show" href="#">查看</a><a class="edit super" href="#">修改</a><a class="delete super" href="#">删除</a></td></tr>';
    		}
    		$infoData = $infoData.'</table>';
    	} else {
    		$infoData = '<div>该员工暂无考勤档案</div>';
    	}
    	$this->assign('infoData', $infoData);
        $this->assign('usertype', $_SESSION['usertype']);
    	$this->display('attendence_list');
    }

    public function attendence_show() {
    	if($_POST['id']) {
    		session_start();
    		$_SESSION['newFileId'] = $_POST['id'];
    	}
    	$attendence_info = M('Attendence_info');
    	$attendence_data = $attendence_info->where('id='.$_SESSION['newFileId'])->select();
    	
        if($attendence_data[0]['department'] != '') {
            $data['department'] = $attendence_data[0]['department'];
            $this->assign('department', $data['department']);
        }

        if($attendence_data[0]['employee'] != '') {
            $data['employee'] = $attendence_data[0]['employee'];
            $this->assign('employee', $data['employee']);
        }

        if($attendence_data[0]['emp_id'] != '') {
            $data['emp_id'] = $attendence_data[0]['emp_id'];
            $this->assign('emp_id', $data['emp_id']);
        }

        if($attendence_data[0]['attendence_status'] != '') {
            $data['attendence_status'] = $attendence_data[0]['attendence_status'];
            $this->assign('attendence_status', $data['attendence_status']);
        }

        if($attendence_data[0]['attendence_reason'] != '') {
            $data['attendence_reason'] = $attendence_data[0]['attendence_reason'];
            $this->assign('attendence_reason', $data['attendence_reason']);
        }

        if($attendence_data[0]['attendence_money'] != '') {
            $data['attendence_money'] = $attendence_data[0]['attendence_money'];
            $this->assign('attendence_money', $data['attendence_money']);
        }

        if($attendence_data[0]['attendence_start_date'] != '') {
            $data['attendence_start_date'] = $attendence_data[0]['attendence_start_date'];
            $this->assign('attendence_start_date', $data['attendence_start_date']);
        }

        if($attendence_data[0]['attendence_end_date'] != '') {
            $data['attendence_end_date'] = $attendence_data[0]['attendence_end_date'];
            $this->assign('attendence_end_date', $data['attendence_end_date']);
        }

        if($attendence_data[0]['manage_person'] != '') {
            $data['manage_person'] = $attendence_data[0]['manage_person'];
            $this->assign('manage_person', $data['manage_person']);
        }

        if($attendence_data[0]['manage_date'] != '') {
            $data['manage_date'] = $attendence_data[0]['manage_date'];
            $this->assign('manage_date', $data['manage_date']);
        }

        if($attendence_data[0]['attendence_content'] != '') {
            $data['attendence_content'] = $attendence_data[0]['attendence_content'];
            $this->assign('attendence_content', $data['attendence_content']);
        }

        $this->assign('fileId', $_SESSION['newFileId']);
        $this->assign('usertype', $_SESSION['usertype']);
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
            $employee_data_str = $employee_data_str.'<input type="hidden" value="';
    		for($y=0;$y<$arraylength2;$y++) {
    			$employee_data_str = $employee_data_str.'<option value='.$duty_data[$y]['emp_name'].' id='.$duty_data[$y]['id'].'>'.$duty_data[$y]['emp_name'].'</option>';
    		}
            $employee_data_str = $employee_data_str.'">';
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

    public function attendence_edit() {
        if($_POST['id']) {
            session_start();
            $_SESSION['newFileId'] = $_POST['id'];
        }

        $attendence_info = M('Attendence_info');
        $attendence_data = $attendence_info->where('id='.$_SESSION['newFileId'])->select();
        
        if($attendence_data[0]['department'] != '') {
            $data['department'] = $attendence_data[0]['department'];
            $this->assign('department', $data['department']);
        }

        if($attendence_data[0]['employee'] != '') {
            $data['employee'] = $attendence_data[0]['employee'];
            $this->assign('employee', $data['employee']);
        }

        if($attendence_data[0]['emp_id'] != '') {
            $data['emp_id'] = $attendence_data[0]['emp_id'];
            $this->assign('emp_id', $data['emp_id']);
        }

        if($attendence_data[0]['attendence_status'] != '') {
            $data['attendence_status'] = $attendence_data[0]['attendence_status'];
            $this->assign('attendence_status', $data['attendence_status']);
        }

        if($attendence_data[0]['attendence_reason'] != '') {
            $data['attendence_reason'] = $attendence_data[0]['attendence_reason'];
            $this->assign('attendence_reason', $data['attendence_reason']);
        }

        if($attendence_data[0]['attendence_money'] != '') {
            $data['attendence_money'] = $attendence_data[0]['attendence_money'];
            $this->assign('attendence_money', $data['attendence_money']);
        }

        if($attendence_data[0]['attendence_start_date'] != '') {
            $data['attendence_start_date'] = $attendence_data[0]['attendence_start_date'];
            $this->assign('attendence_start_date', $data['attendence_start_date']);
        }

        if($attendence_data[0]['attendence_end_date'] != '') {
            $data['attendence_end_date'] = $attendence_data[0]['attendence_end_date'];
            $this->assign('attendence_end_date', $data['attendence_end_date']);
        }

        if($attendence_data[0]['manage_person'] != '') {
            $data['manage_person'] = $attendence_data[0]['manage_person'];
            $this->assign('manage_person', $data['manage_person']);
        }

        if($attendence_data[0]['manage_date'] != '') {
            $data['manage_date'] = $attendence_data[0]['manage_date'];
            $this->assign('manage_date', $data['manage_date']);
        }

        if($attendence_data[0]['attendence_content'] != '') {
            $data['attendence_content'] = $attendence_data[0]['attendence_content'];
            $this->assign('attendence_content', $data['attendence_content']);
        }

        $this->assign('id', $_SESSION['newFileId']);
        $this->assign('fm_num', $attendence_data[0]['fm_num']);
        $this->assign('usertype', $_SESSION['usertype']);
        $this->display('attendence_edit');

    }

    public function attendence_edit_save() {
        $attendence_info = M('Attendence_info');
        $attendence_info->where('id='.$_POST['id'])->delete();
        $attendence_info->create();
        $attendence_info->add();
        $this->success('修改档案成功！', 'attendence_show');
    }

    public function attendence_delete() {
    	$id = $_POST['id'];
    	$attendence_info = M('Attendence_info');
    	$res = $attendence_info->where('id='.$id)->delete();
        unset($_SESSION['newFileId']);
        if($res) {
            $this->success('档案删除成功！', 'attendence_list');
        }
    }

    public function rnp_check() {
        unset($_SESSION['newEmpId']);
        $personal_info = M('personal_info');
        $person_data = $personal_info->select();
        $duty_info = M('duty_info');
        $duty_data = $duty_info->select();
        $arraylength = count($person_data);
        if($arraylength) {
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
                $infoData = $infoData.'<tr id='.$data[$x]['id'].'>'.'<td>No.'.$data[$x]['id'].'</td>'.'<td>'.$data[$x]['emp_name'].'</td>'.'<td>'.$data[$x]['emp_sex'].'</td>'.'<td>'.$data[$x]['emp_department'].'</td>'.'<td>'.$data[$x]['emp_job'].'</td>'.'<td><a class="list" href="#">查看奖惩档案</a></td></tr>';
            }
            $infoData = $infoData.'</table>';
        } else {
            $infoData = '<div>尚未有考勤档案</div>';
        }
        $this->assign('infoData', $infoData);
        $this->assign('usertype', $_SESSION['usertype']);
        $this->display('rnp_check');
    }

    public function rnp_list() {
        if($_POST['id']) {
            session_start();
            $_SESSION['newEmpId'] = $_POST['id'];
        }
        $duty_info = M('Duty_info');
        $rnp_info = M('rnp_info');
        $emp_name = $duty_info->where('id='.$_SESSION['newEmpId'])->field('emp_name')->select();
        $this->assign('emp_name', $emp_name[0]['emp_name']);
        $rnp_data = $rnp_info->where('emp_id='.$_SESSION['newEmpId'])->field('id, fm_num, rnp_status, rnp_reason, rnp_date, manage_person, manage_date')->select();
        if($rnp_data) {
            $infoData = '<table class="table table-striped"><tr><td>档案编号</td><td>奖惩状况</td><td>原因</td><td>落实日期</td><td>审批人</td><td>审批日期</td><td>操作</td></tr>';
            $arraylength = count($rnp_data);
            for($x=0;$x<$arraylength;$x++) {
                $infoData = $infoData.'<tr id='.$rnp_data[$x]['id'].'><td>'.$rnp_data[$x]['fm_num'].'</td><td>'.$rnp_data[$x]['rnp_status'].'</td><td>'.$rnp_data[$x]['rnp_reason'].'</td><td>'.$rnp_data[$x]['rnp_date'].'</td><td>'.$rnp_data[$x]['manage_person'].'</td><td>'.$rnp_data[$x]['manage_date'].'</td><td><a class="show" href="#">查看</a><a class="edit super" href="#">修改</a><a class="delete super" href="#">删除</a></td></tr>';
            }
            $infoData = $infoData.'</table>';
        } else {
            $infoData = '<div>该员工暂无奖惩档案</div>';
        }
        $this->assign('infoData', $infoData);
        $this->assign('usertype', $_SESSION['usertype']);
        $this->display('rnp_list');
    }

    public function rnp_create() {
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
            $employee_data_str = $employee_data_str.'<input type="hidden" value="';
            for($y=0;$y<$arraylength2;$y++) {
                $employee_data_str = $employee_data_str.'<option value='.$duty_data[$y]['emp_name'].' id='.$duty_data[$y]['id'].'>'.$duty_data[$y]['emp_name'].'</option>';
            }
            $employee_data_str = $employee_data_str.'">';
        }
        $this->assign('department_data_str', $department_data_str);
        $this->assign('employee_data_str', $employee_data_str);
        $this->assign('usertype', $_SESSION['usertype']);
        $this->display('rnp_create');
    }

    public function rnp_save() {
        $rnp_info = M('rnp_info');
        $mysql_data = $rnp_info->field('id')->select();
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
        $auto_fm_num = 'R';
        for($x=0;$x<5-$count;$x++) {
            $auto_fm_num = $auto_fm_num.'0';
        }
        $auto_fm_num = $auto_fm_num.$auto_id;
        $_POST['id'] = $auto_id;
        $_POST['fm_num'] = $auto_fm_num;
        $rnp_info->create();
        $rnp_info->add();
        session_start();
        $_SESSION['newEmpId'] = $_POST['emp_id'];
        $this->success('新建考勤档案成功！', 'rnp_list');
    }

    public function rnp_show() {
        if($_POST['id']) {
            session_start();
            $_SESSION['newFileId'] = $_POST['id'];
        }
        $rnp_info = M('rnp_info');
        $rnp_data = $rnp_info->where('id='.$_SESSION['newFileId'])->select();

        if($rnp_data[0]['department'] != '') {
            $data['department'] = $rnp_data[0]['department'];
            $this->assign('department', $data['department']);
        }

        if($rnp_data[0]['employee'] != '') {
            $data['employee'] = $rnp_data[0]['employee'];
            $this->assign('employee', $data['employee']);
        }

        if($rnp_data[0]['emp_id'] != '') {
            $data['emp_id'] = $rnp_data[0]['emp_id'];
            $this->assign('emp_id', $data['emp_id']);
        }

        if($rnp_data[0]['rnp_status'] != '') {
            $data['rnp_status'] = $rnp_data[0]['rnp_status'];
            if($data['rnp_status'] == '奖励') {
                $data['rnp_reward'] = 'checked';
                $data['rnp_punish'] = '';
            } else {
                $data['rnp_reward'] = '';
                $data['rnp_punish'] = 'checked';
            }
            $this->assign('rnp_reward', $data['rnp_reward']);
            $this->assign('rnp_punish', $data['rnp_punish']);
        }

        if($rnp_data[0]['rnp_reason'] != '') {
            $data['rnp_reason'] = $rnp_data[0]['rnp_reason'];
            $this->assign('rnp_reason', $data['rnp_reason']);
        }

        if($rnp_data[0]['rnp_money'] != '') {
            $data['rnp_money'] = $rnp_data[0]['rnp_money'];
            $this->assign('rnp_money', $data['rnp_money']);
        }

        if($rnp_data[0]['rnp_date'] != '') {
            $data['rnp_date'] = $rnp_data[0]['rnp_date'];
            $this->assign('rnp_date', $data['rnp_date']);
        }

        if($rnp_data[0]['manage_person'] != '') {
            $data['manage_person'] = $rnp_data[0]['manage_person'];
            $this->assign('manage_person', $data['manage_person']);
        }

        if($rnp_data[0]['manage_date'] != '') {
            $data['manage_date'] = $rnp_data[0]['manage_date'];
            $this->assign('manage_date', $data['manage_date']);
        }

        if($rnp_data[0]['rnp_content'] != '') {
            $data['rnp_content'] = $rnp_data[0]['rnp_content'];
            $this->assign('rnp_content', $data['rnp_content']);
        }

        $this->assign('fileId', $_SESSION['newFileId']);
        $this->assign('usertype', $_SESSION['usertype']);
        $this->display('rnp_show');
    }

    public function rnp_edit() {
        if($_POST['id']) {
            session_start();
            $_SESSION['newFileId'] = $_POST['id'];
        }
        $rnp_info = M('rnp_info');
        $rnp_data = $rnp_info->where('id='.$_SESSION['newFileId'])->select();
        
        if($rnp_data[0]['department'] != '') {
            $data['department'] = $rnp_data[0]['department'];
            $this->assign('department', $data['department']);
        }

        if($rnp_data[0]['employee'] != '') {
            $data['employee'] = $rnp_data[0]['employee'];
            $this->assign('employee', $data['employee']);
        }

        if($rnp_data[0]['emp_id'] != '') {
            $data['emp_id'] = $rnp_data[0]['emp_id'];
            $this->assign('emp_id', $data['emp_id']);
        }

        if($rnp_data[0]['rnp_status'] != '') {
            $data['rnp_status'] = $rnp_data[0]['rnp_status'];
            if($data['rnp_status'] == '奖励') {
                $data['rnp_reward'] = 'checked';
                $data['rnp_punish'] = '';
            } else {
                $data['rnp_reward'] = '';
                $data['rnp_punish'] = 'checked';
            }
            $this->assign('rnp_reward', $data['rnp_reward']);
            $this->assign('rnp_punish', $data['rnp_punish']);
        }

        if($rnp_data[0]['rnp_reason'] != '') {
            $data['rnp_reason'] = $rnp_data[0]['rnp_reason'];
            $this->assign('rnp_reason', $data['rnp_reason']);
        }

        if($rnp_data[0]['rnp_money'] != '') {
            $data['rnp_money'] = $rnp_data[0]['rnp_money'];
            $this->assign('rnp_money', $data['rnp_money']);
        }

        if($rnp_data[0]['rnp_date'] != '') {
            $data['rnp_date'] = $rnp_data[0]['rnp_date'];
            $this->assign('rnp_date', $data['rnp_date']);
        }

        if($rnp_data[0]['manage_person'] != '') {
            $data['manage_person'] = $rnp_data[0]['manage_person'];
            $this->assign('manage_person', $data['manage_person']);
        }

        if($rnp_data[0]['manage_date'] != '') {
            $data['manage_date'] = $rnp_data[0]['manage_date'];
            $this->assign('manage_date', $data['manage_date']);
        }

        if($rnp_data[0]['rnp_content'] != '') {
            $data['rnp_content'] = $rnp_data[0]['rnp_content'];
            $this->assign('rnp_content', $data['rnp_content']);
        }

        $this->assign('id', $_SESSION['newFileId']);
        $this->assign('fm_num', $rnp_data[0]['fm_num']);
        $this->assign('usertype', $_SESSION['usertype']);
        $this->display('rnp_edit');
    }

    public function rnp_edit_save() {
        $rnp_info = M('rnp_info');
        $rnp_info->where('id='.$_POST['id'])->delete();
        $rnp_info->create();
        $rnp_info->add();
        $this->success('修改档案成功！', 'rnp_show');
    }

    public function rnp_delete() {
        $id = $_POST['id'];
        $rnp_info = M('rnp_info');
        $res = $rnp_info->where('id='.$id)->delete();
        unset($_SESSION['newFileId']);
        if($res) {
            $this->success('档案删除成功！', 'rnp_list');
        }
    }

    public function train_check() {
        unset($_SESSION['newFileId']);
        $train_info = M('train_info');
        $train_data = $train_info->field('id, fm_num, train_name, train_start_date, train_end_date, train_unit, train_lecture')->select();
        $arraylength = count($train_data);
        if($arraylength) {
            $infoData = '<table class="table table-striped"><tr><td>档案编号</td><td>培训名称</td><td>培训单位</td><td>培训讲师</td><td>开始时间</td><td>结束时间</td><td>操作</td></tr>';
            for($x=0;$x<$arraylength;$x++) {
                $infoData = $infoData.'<tr id='.$train_data[$x]['id'].'><td>'.$train_data[$x]['fm_num'].'</td><td>'.$train_data[$x]['train_name'].'</td><td>'.$train_data[$x]['train_unit'].'</td><td>'.$train_data[$x]['train_lecture'].'</td><td>'.$train_data[$x]['train_start_date'].'</td><td>'.$train_data[$x]['train_end_date'].'</td><td><a class="train_show" href="#">查看</a><a class="train_edit super" href="#">修改</a><a class="train_delete super" href="#">删除</a></td></tr>';
            }
            $infoData = $infoData.'</table>';
        } else {
            $infoData = '暂无培训档案';
        }
        $this->assign('infoData', $infoData);
        $this->assign('usertype', $_SESSION['usertype']);
        $this->display('train_check');
    }

    public function train_create() {
        $personal_info = M('personal_info');
        $duty_info = M('duty_info');
        $person_data = $personal_info->field('id, fm_num, emp_name, emp_sex')->select();
        $duty_data = $duty_info->field('id, emp_department, emp_job')->select();
        $arraylength2 = count($person_data);
        if($arraylength2) {
            $infoData2 = '<table class="table table-striped multi_choose"><tr><td><input type="checkbox"></td><td>档案编号</td><td>姓名</td><td>性别</td><td>部门</td><td>职务</td></tr>';
            for($x=0;$x<$arraylength2;$x++) {
                if($person_data[$x]['id'] == $duty_data[$x]['id']) {
                    $infoData2 = $infoData2.'<tr id='.$person_data[$x]['id'].'><td><input type="checkbox"></td><td>'.$person_data[$x]['fm_num'].'</td><td>'.$person_data[$x]['emp_name'].'</td><td>'.$person_data[$x]['emp_sex'].'</td><td>'.$duty_data[$x]['emp_department'].'</td><td>'.$duty_data[$x]['emp_job'].'</td></tr>';
                }
            }
            $infoData2 = $infoData2.'</table>';
        } else {
            $infoData2 = '尚未创建员工档案';
        }
        $this->assign('infoData2', $infoData2);
        $this->assign('usertype', $_SESSION['usertype']);
        $this->display('train_create');
    }

    public function train_show() {
        if($_POST['id']) {
            session_start();
            $_SESSION['newFileId'] = $_POST['id'];
        }
        $train_info = M('train_info');
        $train_person = M('train_person');
        $personal_info = M('personal_info');
        $duty_info = M('duty_info');
        $train_data = $train_info->where('id='.$_SESSION['newFileId'])->select();

        if($train_data[0]['id'] != '') {
            $this->assign('id', $train_data[0]['id']);
        }

        if($train_data[0]['fm_num'] != '') {
            $this->assign('fm_num', $train_data[0]['fm_num']);
        }

        if($train_data[0]['train_name'] != '') {
            $this->assign('train_name', $train_data[0]['train_name']);
        }

        if($train_data[0]['train_content'] != '') {
            $this->assign('train_content', $train_data[0]['train_content']);
        }

        if($train_data[0]['train_unit'] != '') {
            $this->assign('train_unit', $train_data[0]['train_unit']);
        }

        if($train_data[0]['train_lecture'] != '') {
            $this->assign('train_lecture', $train_data[0]['train_lecture']);
        }

        if($train_data[0]['train_place'] != '') {
            $this->assign('train_place', $train_data[0]['train_place']);
        }

        if($train_data[0]['train_start_date'] != '') {
            $this->assign('train_start_date', $train_data[0]['train_start_date']);
        }

        if($train_data[0]['train_end_date'] != '') {
            $this->assign('train_end_date', $train_data[0]['train_end_date']);
        }

        $emp_ids = $train_person->field('emp_id')->where('train_id='.$_SESSION['newFileId'])->select();
        $arraylength = count($emp_ids);  
        if($arraylength) {
            $infoData = '<table class="table table-striped chose"><tr><td>档案编号</td><td>姓名</td><td>性别</td><td>部门</td><td>职务</td></tr>';
            for($x=0;$x<$arraylength;$x++) {
                $person_data = $personal_info->field('fm_num, emp_name, emp_sex')->where('id='.$emp_ids[$x]['emp_id'])->select();
                $duty_data = $duty_info->field('emp_department, emp_job')->where('id='.$emp_ids[$x]['emp_id'])->select();
                $infoData = $infoData.'<tr id='.$emp_ids[$x]['emp_id'].'><td>'.$person_data[0]['fm_num'].'</td><td>'.$person_data[0]['emp_name'].'</td><td>'.$person_data[0]['emp_sex'].'</td><td>'.$duty_data[0]['emp_department'].'</td><td>'.$duty_data[0]['emp_job'].'</td></tr>';
            }
            $infoData = $infoData.'</table>';
        } else {
            $infoData = '<p>尚未添加参训人员</p>';
        }

        $this->assign('infoData', $infoData);
        $this->assign('usertype', $_SESSION['usertype']);
        $this->display('train_show');
    }

    public function train_edit() {
        if($_POST['id']) {
            session_start();
            $_SESSION['newFileId'] = $_POST['id'];
        }
        $train_info = M('train_info');
        $train_person = M('train_person');
        $personal_info = M('personal_info');
        $duty_info = M('duty_info');
        $train_data = $train_info->where('id='.$_SESSION['newFileId'])->select();

        if($train_data[0]['id'] != '') {
            $this->assign('id', $train_data[0]['id']);
        }

        if($train_data[0]['fm_num'] != '') {
            $this->assign('fm_num', $train_data[0]['fm_num']);
        }

        if($train_data[0]['train_name'] != '') {
            $this->assign('train_name', $train_data[0]['train_name']);
        }

        if($train_data[0]['train_content'] != '') {
            $this->assign('train_content', $train_data[0]['train_content']);
        }

        if($train_data[0]['train_unit'] != '') {
            $this->assign('train_unit', $train_data[0]['train_unit']);
        }

        if($train_data[0]['train_lecture'] != '') {
            $this->assign('train_lecture', $train_data[0]['train_lecture']);
        }

        if($train_data[0]['train_place'] != '') {
            $this->assign('train_place', $train_data[0]['train_place']);
        }

        if($train_data[0]['train_start_date'] != '') {
            $this->assign('train_start_date', $train_data[0]['train_start_date']);
        }

        if($train_data[0]['train_end_date'] != '') {
            $this->assign('train_end_date', $train_data[0]['train_end_date']);
        }

        $emp_ids = $train_person->field('emp_id')->where('train_id='.$_SESSION['newFileId'])->select();
        $arraylength = count($emp_ids);  
        $infoData = '<table class="table table-striped chose"><tr><td>档案编号</td><td>姓名</td><td>性别</td><td>部门</td><td>职务</td></tr>';
        for($x=0;$x<$arraylength;$x++) {
            $person_data = $personal_info->field('fm_num, emp_name, emp_sex')->where('id='.$emp_ids[$x]['emp_id'])->select();
            $duty_data = $duty_info->field('emp_department, emp_job')->where('id='.$emp_ids[$x]['emp_id'])->select();
            $infoData = $infoData.'<tr id='.$emp_ids[$x]['emp_id'].'><td>'.$person_data[0]['fm_num'].'</td><td>'.$person_data[0]['emp_name'].'</td><td>'.$person_data[0]['emp_sex'].'</td><td>'.$duty_data[0]['emp_department'].'</td><td>'.$duty_data[0]['emp_job'].'</td></tr>';
        }
        $infoData = $infoData.'</table>';
        $person_data = $personal_info->field('id, fm_num, emp_name, emp_sex')->select();
        $duty_data = $duty_info->field('id, emp_department, emp_job')->select();
        $arraylength2 = count($person_data);
        if($arraylength2) {
            $infoData2 = '<table class="table table-striped multi_choose"><tr><td><input type="checkbox"></td><td>档案编号</td><td>姓名</td><td>性别</td><td>部门</td><td>职务</td></tr>';
            for($x=0;$x<$arraylength2;$x++) {
                if($person_data[$x]['id'] == $duty_data[$x]['id']) {
                    $infoData2 = $infoData2.'<tr id='.$person_data[$x]['id'].'><td><input type="checkbox"></td><td>'.$person_data[$x]['fm_num'].'</td><td>'.$person_data[$x]['emp_name'].'</td><td>'.$person_data[$x]['emp_sex'].'</td><td>'.$duty_data[$x]['emp_department'].'</td><td>'.$duty_data[$x]['emp_job'].'</td></tr>';
                }
            }
            $infoData2 = $infoData2.'</table>';
        } else {
            $infoData2 = '尚未创建员工档案';
        }
        $this->assign('infoData', $infoData);
        $this->assign('infoData2', $infoData2);
        $this->assign('usertype', $_SESSION['usertype']);
        $this->display('train_edit');
    }

    public function train_delete() {
        if($_POST['id']) {
            session_start();
            $_SESSION['newFileId'] = $_POST['id'];
        }
        $train_info = M('train_info');
        $train_data = $train_info->where('id='.$_SESSION['newFileId'])->delete();
    }

    public function train_save() {
        $train_info = M('train_info');
        $train_person = M('train_person');
        $mysql_data = $train_info->field('id')->select();
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
        $auto_fm_num = 'T';
        for($x=0;$x<5-$count;$x++) {
            $auto_fm_num = $auto_fm_num.'0';
        }
        $auto_fm_num = $auto_fm_num.$auto_id;
        $_POST['id'] = $auto_id;
        $_POST['fm_num'] = $auto_fm_num;
        $train_info->create();
        $train_info->add();
        $train_person_data = explode(',', $_POST['train_person']);
        $arraylength2 = count($train_person_data);
        $data['train_id'] = $_POST['id'];
        for($x=0;$x<$arraylength2;$x++) {
            $mysql_data2 = $train_person->field('id')->select();
            $auto_id2 = 1;
            $arraylength3 = count($mysql_data2);
            for($y=0;$y<$arraylength3;$y++) {
                $ids2[$y] = $mysql_data2[$y]['id'];
            }
            while(in_array($auto_id2, $ids2)) {
                $auto_id2++;
            }
            $data['id'] = $auto_id2;
            $data['emp_id'] = $train_person_data[$x];
            $train_person->add($data);
        }
        session_start();
        $_SESSION['newFileId'] = $auto_id;
        $this->success('新建档案成功！', 'train_check');
    }

    public function train_edit_save() {
        $train_info = M('train_info');
        $train_person = M('train_person');
        $train_info->where('id='.$_SESSION['newFileId'])->delete();
        $train_info->create();
        $train_info->add();
        $train_person->where('train_id='.$_SESSION['newFileId'])->delete();
        $train_person_data = explode(',', $_POST['train_person']);
        $arraylength2 = count($train_person_data);
        $data['train_id'] = $_POST['id'];
        for($x=0;$x<$arraylength2;$x++) {
            $mysql_data2 = $train_person->field('id')->select();
            $auto_id2 = 1;
            $arraylength3 = count($mysql_data2);
            for($y=0;$y<$arraylength3;$y++) {
                $ids2[$y] = $mysql_data2[$y]['id'];
            }
            while(in_array($auto_id2, $ids2)) {
                $auto_id2++;
            }
            $data['id'] = $auto_id2;
            $data['emp_id'] = $train_person_data[$x];
            $train_person->add($data);
        }
        $this->success('修改档案成功！', 'train_show');
    }

}