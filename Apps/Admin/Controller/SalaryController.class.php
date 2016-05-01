<?php
namespace Admin\Controller;
use Think\Controller;
import('ORG.Util.Date');

class SalaryController extends Controller {
	function __construct(){
		parent::__construct();
		if($_SESSION['username'] == ''){
			$this->redirect("User/index");
		}
	}

    public function index() {
    	$this->assign('usertype', $_SESSION['usertype']);
        $this->display('index');
    }

    public function account_setting() {
        $account_info = M('account_info');
        $account_info_data = $account_info->select();
        $arraylength = count($account_info_data);
        if($arraylength) {
            $infoData = '<table class="table table-striped"><tr><td>编号</td><td>账套名称</td><td>状态</td><td>操作</td></tr>';
            for($x=0;$x<$arraylength;$x++) {
                if($account_info_data[$x]['use_status'] == 'on') {
                    $use_status = '正在使用';
                    $use_a = '<a class="used" href="#">使用</a>';
                } else {
                    $use_status = '未使用';
                    $use_a = '<a class="use" href="#">使用</a>';
                }
                $infoData = $infoData.'<tr id='.$account_info_data[$x]['id'].'><td>'.($x+1).'</td><td>'.$account_info_data[$x]['account_name'].'</td><td>'.$use_status.'</td><td>'.$use_a.'<a class="account_edit" href="#">修改</a><a class="show" href="#">查看</a><a class="account_delete" href="#">删除</a></td></tr>';
            }
            $infoData = $infoData.'</table>';
        } else {
            $infoData = '<p>尚未建立账套</p>';
        }
        $this->assign('infoData', $infoData);
        $this->assign('usertype', $_SESSION['usertype']);
        $this->display('account_setting');
    }

    public function account_add() {
        $mysql = M('account_info');
    	$data['account_name'] = $_POST['account_name'];
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
        $data['use_status'] = 'off';
        $mysql->add($data);

        $account_project = M('account_project');
        for($x=1;$x<=5;$x++) {
            $account_project_data = $account_project->select();
            $auto_id2 = 1;
            $arraylength = count($account_project_data);
            for($y=0;$y<$arraylength;$y++) {
                $ids2[$y] = $account_project_data[$y]['id'];
            }
            while(in_array($auto_id2, $ids2)) {
                $auto_id2++;
            }
            $data2['id'] = $auto_id2;
            $data2['account_id'] = $auto_id;
            $data2['project_id'] = $x;
            $data2['project_money'] = 0;
            if($x == 1) {
                $data2['project_name'] = '缺勤';
                $data2['project_unit'] = '次';
                $data2['project_type'] = '扣除';
            } else if($x == 2) {
                $data2['project_name'] = '迟到';
                $data2['project_unit'] = '次';
                $data2['project_type'] = '扣除';
            } else if($x == 3) {
                $data2['project_name'] = '请假';
                $data2['project_unit'] = '天';
                $data2['project_type'] = '扣除';
            } else if($x == 4) {
                $data2['project_name'] = '月奖金';
                $data2['project_unit'] = '月';
                $data2['project_type'] = '发放';
            } else if($x == 5) {
                $data2['project_name'] = '年终奖';
                $data2['project_unit'] = '年';
                $data2['project_type'] = '发放';
            }
            
            $account_project->add($data2);
        }

        $project_person = M('project_person');
        $personal_info = M('personal_info');
        $person_data = $personal_info->select();
        $arraylength = count($person_data);
        // for($x=0;$x<$arraylength;$x++) {
        //     for($z=4;$z<=5;$z++) {
        //         $project_person_data = $project_person->select();
        //         $auto_id2 = 1;
        //         $arraylength2 = count($project_person_data);
        //         for($y=0;$y<$arraylength2;$y++) {
        //             $ids3[$y] = $project_person_data[$y]['id'];
        //         }
        //         while(in_array($auto_id2, $ids3)) {
        //             $auto_id2++;
        //         }
        //         $data3['id'] = $auto_id2;
        //         $data3['account_id'] = $auto_id;
        //         $data3['project_id'] = $z;
        //         $data3['emp_id'] = $person_data[$x]['id'];
        //         $this_time = Date('Y-m-d');
        //         $data3['update_time'] = strval($this_time);
        //         if($z == 4) {
        //             $data3['count'] = 12;
        //         } else if($z == 5) {
        //             $data3['count'] = 1;
        //         }
        //         $project_person->add($data3);
        //     }
        // }

        $account_info_data = $mysql->select();
        $arraylength = count($account_info_data);
        $infoData = '<table class="table table-striped"><tr><td>编号</td><td>账套名称</td><td>状态</td><td>操作</td></tr>';
        for($x=0;$x<$arraylength;$x++) {
            if($account_info_data[$x]['use_status'] == 'on') {
                $use_status = '正在使用';
                $use_a = '<a class="used" href="#">取消使用</a>';
            } else {
                $use_status = '未使用';
                $use_a = '<a class="use" href="#">使用</a>';
            }
            $infoData = $infoData.'<tr id='.$account_info_data[$x]['id'].'><td>'.($x+1).'</td><td>'.$account_info_data[$x]['account_name'].'</td><td>'.$use_status.'</td><td>'.$use_a.'<a class="account_edit" href="#">修改</a><a class="show" href="#">查看</a><a class="account_delete" href="#">删除</a></td></tr>';
        }
        $infoData = $infoData.'</table>';
        echo $infoData;
    }

    public function account_show() {
        $id = $_POST['id'];
        $account_project = M('account_project');
        $account_project_data = $account_project->where('account_id='.$id)->order('project_id asc')->select();
        $arraylength = count($account_project_data);
        if($arraylength) {
            $infoData = '<table class="table table-striped"><tr><td>编号</td><td>项目名称</td><td>项目单位</td><td>项目类型</td><td>金额</td><td>操作</td></tr>';
            for($x=0;$x<$arraylength;$x++) {
                if($x<5) {
                    $delete_operation = '';
                } else {
                    $delete_operation = '<a class="project_delete" href="#">删除</a>';
                }
                if($account_project_data[$x]['project_unit'] == '次') {
                    $infoData = $infoData.'<tr><td>'.$account_project_data[$x]['project_id'].'</td><td>'.$account_project_data[$x]['project_name'].'</td><td>'.$account_project_data[$x]['project_unit'].'</td><td>'.$account_project_data[$x]['project_type'].'</td><td>'.$account_project_data[$x]['project_money'].'元</td><td><a class="project_edit" href="#">修改</a>'.$delete_operation.'</td></tr>';
                } else {
                    $infoData = $infoData.'<tr><td>'.$account_project_data[$x]['project_id'].'</td><td>'.$account_project_data[$x]['project_name'].'</td><td>'.$account_project_data[$x]['project_unit'].'/次</td><td>'.$account_project_data[$x]['project_type'].'</td><td>'.$account_project_data[$x]['project_money'].'元</td><td><a class="project_edit" href="#">修改</a>'.$delete_operation.'</td></tr>';
                }
                
            }
            $infoData = $infoData.'</table>';
        } else {
            $infoData = '<p class="form-title">尚未添加项目</p>';
        }
        echo $infoData;

    }

    public function account_delete() {
        $id = $_POST['id'];
        $account_info = M('account_info');
        $account_project = M('account_project');
        $account_info->where('id='.$id)->delete();
        $account_project->where('account_id='.$id)->delete();
        $account_info_data = $account_info->select();
        $arraylength = count($account_info_data);
        if($arraylength) {
            $infoData = '<table class="table table-striped"><tr><td>编号</td><td>账套名称</td><td>状态</td><td>操作</td></tr>';
            for($x=0;$x<$arraylength;$x++) {
                if($account_info_data[$x]['use_status'] == 'on') {
                    $use_status = '正在使用';
                } else {
                    $use_status = '未使用';
                }
                $infoData = $infoData.'<tr id='.$account_info_data[$x]['id'].'><td>'.($x+1).'</td><td>'.$account_info_data[$x]['account_name'].'</td><td>'.$use_status.'</td><td><a class="use" href="#">使用</a><a class="show" href="#">查看</a><a class="account_delete" href="#">删除</a></td></tr>';
            }
            $infoData = $infoData.'</table>';
        } else {
            $infoData = '<p class="form-title">尚未建立账套</p>';
        }
        echo $infoData;
    }

    public function use_status_change() {
        $id = $_POST['id'];
        $account_info = M('account_info');
        if($_POST['class'] == 'use') {
            $old_use = $account_info->where(array('use_status'=>'on'))->select();
            $new_use = $account_info->where('id='.$id)->select();
            $account_info->where(array('use_status'=>'on'))->delete();
            $account_info->where('id='.$id)->delete();
            if($old_use) {
                $old_use[0]['use_status'] = 'off';
                $account_info->add($old_use[0]);
            }
            if($new_use) {
                $new_use[0]['use_status'] = 'on';  
                $account_info->add($new_use[0]);
            }
        } else if($_POST['class'] == 'used') {
            $old_use = $account_info->where(array('use_status'=>'on'))->select();
            if($old_use) {
                $old_use[0]['use_status'] = 'off';
                $account_info->where(array('use_status'=>'on'))->save($old_use[0]);
            }
        }
    }

    public function project_add() {
        $mysql = M('account_project');
        $project_person = M('project_person');
        $personal_info = M('personal_info');

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
        $data['account_id'] = $_POST['account_id'];
        $data['project_id'] = $_POST['project_id'];
        $data['project_name'] = $_POST['project_name'];
        $data['project_unit'] = $_POST['project_unit'];
        $data['project_type'] = $_POST['project_type'];
        $data['project_money'] = $_POST['project_money'];
        $mysql->add($data);

        $person_data = $personal_info->field('id')->select();
        $arraylength = count($person_data);
        if($arraylength) {
            for($x=0;$x<$arraylength;$x++) {
                $project_person_data = $project_person->field('id')->select();
                $auto_id = 1;
                $arraylength2 = count($project_person_data);
                for($y=0;$y<$arraylength2;$y++) {
                    $ids2[$y] = $project_person_data[$y]['id'];
                }
                while(in_array($auto_id, $ids2)) {
                    $auto_id++;
                }
                $data2['id'] = $auto_id;
                $data2['account_id'] = $data['account_id'];
                $data2['project_id'] = $data['project_id'];
                $data2['emp_id'] = $person_data[$x]['id'];
                $data2['count'] = 0;
                $this_time = Date('Y-m-d');
                $data2['update_time'] = strval($this_time);
                $project_person->add($data2);
            }
        }

        $account_project_data = $mysql->where('account_id='.$data['account_id'])->order('project_id asc')->select();
        $arraylength = count($account_project_data);
        $infoData = '<table class="table table-striped"><tr><td>编号</td><td>项目名称</td><td>项目单位</td><td>项目类型</td><td>金额</td><td>操作</td></tr>';
        for($x=0;$x<$arraylength;$x++) {
            if($x<5) {
                $delete_operation = '';
            } else {
                $delete_operation = '<a class="project_delete" href="#">删除</a>';
            }
            $infoData = $infoData.'<tr><td>'.$account_project_data[$x]['project_id'].'</td><td>'.$account_project_data[$x]['project_name'].'</td><td>'.$account_project_data[$x]['project_unit'].'</td><td>'.$account_project_data[$x]['project_type'].'</td><td>'.$account_project_data[$x]['project_money'].'元</td><td><a class="project_edit" href="#">修改</a>'.$delete_operation.'</td></tr>';
        }
        $infoData = $infoData.'</table>';
        echo $infoData;
    }

    public function project_delete() {
        $account_project = M('account_project');
        $project_person = M('project_person');
        $account_project_data = $account_project->where('account_id='.$_POST['account_id'])->select();
        $arraylength = count($account_project_data);
        $select_data = $account_project->where("account_id=%d and project_id=%d", $_POST['account_id'], $_POST['project_id'])->select();
        $account_project->where("account_id=%d and project_id=%d", $_POST['account_id'], $_POST['project_id'])->delete();
        $project_person->where("account_id=%d and project_id=%d", $_POST['account_id'], $_POST['project_id'])->delete();
        
        for($x=$_POST['project_id']+1;$x<=$arraylength;$x++) {
            $data = $account_project->where("account_id=%d and project_id=%d", $_POST['account_id'], $x)->select();
            $account_project->where("account_id=%d and project_id=%d", $_POST['account_id'], $x)->delete();
            $data[0]['project_id'] = $x-1;
            $account_project->add($data[0]);
        }
        $account_project_data = $account_project->where('account_id='.$_POST['account_id'])->order('project_id asc')->select();
        $arraylength = count($account_project_data);
        if($arraylength) {
            $infoData = '<table class="table table-striped"><tr><td>编号</td><td>项目名称</td><td>项目单位</td><td>项目类型</td><td>金额</td><td>操作</td></tr>';
            for($x=0;$x<$arraylength;$x++) {
                if($x<5) {
                    $delete_operation = '';
                } else {
                    $delete_operation = '<a class="project_delete" href="#">删除</a>';
                }
                if($account_project_data[$x]['project_unit'] == '次') {
                    $infoData = $infoData.'<tr><td>'.$account_project_data[$x]['project_id'].'</td><td>'.$account_project_data[$x]['project_name'].'</td><td>'.$account_project_data[$x]['project_unit'].'</td><td>'.$account_project_data[$x]['project_type'].'</td><td>'.$account_project_data[$x]['project_money'].'元</td><td><a class="project_edit" href="#">修改</a>'.$delete_operation.'</td></tr>';
                } else {
                    $infoData = $infoData.'<tr><td>'.$account_project_data[$x]['project_id'].'</td><td>'.$account_project_data[$x]['project_name'].'</td><td>'.$account_project_data[$x]['project_unit'].'/次</td><td>'.$account_project_data[$x]['project_type'].'</td><td>'.$account_project_data[$x]['project_money'].'元</td><td><a class="project_edit" href="#">修改</a>'.$delete_operation.'</td></tr>';
                }
            }
            $infoData = $infoData.'</table>';
        } else {
            $infoData = '<p class="form-title">尚未添加项目</p>';
        }
        echo $infoData;
    }

    public function project_edit() {
        $account_project = M('account_project');
        $data['account_id'] = $_POST['account_id'];
        $data['project_id'] = $_POST['project_id'];
        $data['project_name'] = $_POST['project_name'];
        $data['project_unit'] = $_POST['project_unit'];
        $data['project_type'] = $_POST['project_type'];
        $data['project_money'] = $_POST['project_money'];
        $delete_data = $account_project->where("account_id=%d and project_id=%d", $_POST['account_id'], $_POST['project_id'])->field('id')->select();
        $data['id'] = $delete_data[0]['id'];
        $account_project->where("account_id=%d and project_id=%d", $_POST['account_id'], $_POST['project_id'])->delete();
        $account_project->add($data);
        $account_project_data = $account_project->where('account_id='.$data['account_id'])->order('project_id asc')->select();
        $arraylength = count($account_project_data);
        $infoData = '<table class="table table-striped"><tr><td>编号</td><td>项目名称</td><td>项目单位</td><td>项目类型</td><td>金额</td><td>操作</td></tr>';
        for($x=0;$x<$arraylength;$x++) {
            $infoData = $infoData.'<tr><td>'.$account_project_data[$x]['project_id'].'</td><td>'.$account_project_data[$x]['project_name'].'</td><td>'.$account_project_data[$x]['project_unit'].'</td><td>'.$account_project_data[$x]['project_type'].'</td><td>'.$account_project_data[$x]['project_money'].'元</td><td><a class="project_edit" href="#">修改</a><a class="project_delete" href="#">删除</a></td></tr>';
        }
        $infoData = $infoData.'</table>';
        echo $infoData;
    }

    public function salary_setting() {
        $personal_info = M('personal_info');
        $duty_info = M('duty_info');
        $salary = M('salary');
        $account_info = M('account_info');
        $account_project = M('account_project');
        $project_person = M('project_person');
        $department = M('department');
        $folk_type = M('folk_type');
        $native_type = M('native_type');
        $use_form = M('use_form');

        $person_data = $personal_info->select();
        $duty_data = $duty_info->select();
        $salary_data = $salary->select();

        $today_date = explode('-', Date('Y-m-d'));
        $arraylength = count($person_data);
        $active_account = $account_info->where('use_status="on"')->field('id')->select();
        if($active_account) {
            $table_title = $account_project->where('account_id='.$active_account[0]['id'].' and project_id>5')->field('project_id, project_name, project_unit')->order('project_id asc')->select();
        }
        if($arraylength) {
            for($x=0;$x<$arraylength;$x++) {
                if($person_data[$x]['id'] == $duty_data[$x]['id']) {
                    $data[$x]['id'] = $person_data[$x]['id'];
                    $data[$x]['fm_num'] = $person_data[$x]['fm_num'];
                    $data[$x]['emp_name'] = $person_data[$x]['emp_name'];
                    $data[$x]['emp_sex'] = $person_data[$x]['emp_sex'];
                    $data[$x]['emp_department'] = $duty_data[$x]['emp_department'];
                    $data[$x]['emp_job'] = $duty_data[$x]['emp_job'];
                }
                if($person_data[$x]['id'] == $salary_data[$x]['id']) {
                    $data[$x]['salary'] = $salary_data[$x]['salary'];
                }
                if($data[$x]['salary'] == '') {
                    $data[$x]['salary'] = 0;
                }
            }
            $arraylength = count($data);
            if($table_title) {
                $arraylength2 = count($table_title);
            } else {
                $arraylength2 = 0;
            }
            $infoData = '<table class="table table-striped"><tr><td>档案编号</td><td>姓名</td><td>性别</td><td>部门</td><td>职务</td><td>工资/月</td>';
            for($x=0;$x<$arraylength2;$x++) {
                $infoData = $infoData.'<td>'.$table_title[$x]['project_name'].'</td>';
            }
            $infoData = $infoData.'</tr>';
            for($x=0;$x<$arraylength;$x++) {
                if($table_title) {
                    $project_person_data = $project_person->where('account_id='.$active_account[0]['id'].' and emp_id='.$data[$x]['id'].' and update_time like "'.$today_date[0].'-%"')->field('count, project_id')->order('project_id asc')->select();
                    $arraylength2 = count($project_person_data);
                }
                $infoData = $infoData.'<tr id='.$data[$x]['id'].'>'.'<td>'.$data[$x]['fm_num'].'</td>'.'<td>'.$data[$x]['emp_name'].'</td>'.'<td>'.$data[$x]['emp_sex'].'</td>'.'<td>'.$data[$x]['emp_department'].'</td>'.'<td>'.$data[$x]['emp_job'].'</td>'.'<td>'.$data[$x]['salary'].'元</td>';
                if($arraylength2) {
                    $z = 0;
                    for($y=0;$y<$arraylength2 && $z<count($table_title);) {
                        if($project_person_data[$y]['project_id'] == $table_title[$z]['project_id']) {
                            $infoData = $infoData.'<td>'.$project_person_data[$y]['count'].'次</td>';
                            $y++;
                        } else {
                            $infoData = $infoData.'<td>0次</td>';
                        }
                        $z++;
                    }
                } else {
                    $arraylength2 = count($table_title);
                    for($y=0;$y<$arraylength2;$y++) {
                        $infoData = $infoData.'<td>0次</td>';
                    }
                }
                $infoData = $infoData.'</tr>';
            }
            $infoData = $infoData.'</table>';
        } else {
            $infoData = '<div>尚未有员工档案</div>';
        }

        $department_data = $department->select();
        $department_data_str = '';
        if($department_data) {
            $arraylength = count($department_data);
            for($x=0;$x<$arraylength;$x++) {
                $department_data_str = $department_data_str.'<option value="'.$department_data[$x]['department'].'">'.$department_data[$x]['department'].'</option>';
            }
        }
        $folk_data = $folk_type->select();
        $folk_data_str = '';
        if($folk_data) {
            $arraylength = count($folk_data);
            for($x=0;$x<$arraylength;$x++) {
                $folk_data_str = $folk_data_str.'<option value="'.$folk_data[$x]['content'].'">'.$folk_data[$x]['content'].'</option>';
            }
        }
        $native_data = $native_type->select();
        $native_data_str = '';
        if($native_data) {
            $arraylength = count($native_data);
            for($x=0;$x<$arraylength;$x++) {
                $native_data_str = $native_data_str.'<option value="'.$native_data[$x]['content'].'">'.$native_data[$x]['content'].'</option>';
            }
        }
        $use_form_data = $use_form->select();
        $use_form_str = '';
        if($use_form_data) {
            $arraylength = count($use_form_data);
            for($x=0;$x<$arraylength;$x++) {
                $use_form_str = $use_form_str.'<option value="'.$use_form_data[$x]['content'].'">'.$use_form_data[$x]['content'].'</option>';
            }
        }

        $this->assign('department_data_str', $department_data_str);
        $this->assign('folk_data_str', $folk_data_str);
        $this->assign('native_data_str', $native_data_str);
        $this->assign('use_form_str', $use_form_str);
        $this->assign('infoData', $infoData);
        $this->assign('usertype', $_SESSION['usertype']);
        $this->display('salary_setting');
    }

    public function salary_edit() {
        $salary = M('salary');
        $project_person = M('project_person');
        $account_info = M('account_info');

        $arraylength = count($_POST['id']);
        for($x=0;$x<$arraylength;$x++) {
            $data = $salary->where('id='.$_POST['id'][$x])->select();
            if($data) {
                $data[0]['salary'] = $_POST['salary'][$x][0];
                $salary->where('id='.$_POST['id'][$x])->save($data[0]);
            } else {
                $data[0]['id'] = $_POST['id'][$x];
                $data[0]['salary'] = $_POST['salary'][$x][0];
                $salary->add($data[0]);
            }
        }

        $active_account = $account_info->where('use_status="on"')->field('id')->select();
        $arraylength2 = count($_POST['salary'][0]);
        $mysql_id = $project_person->field('id')->select();
        $arraylength3 = count($mysql_id);
        for($z=0;$z<$arraylength3;$z++){
            $ids[$z] = $mysql_id[$z]['id'];
        }
        $auto_id = 1;
        $today_date = explode('-', Date('Y-m-d'));
        for($x=0;$x<$arraylength;$x++) {
            $project_person->where('emp_id='.$_POST['id'][$x].' and account_id='.$active_account[0]['id'].' and update_time like "'.$today_date[0].'-%"')->delete();
            for($y=1;$y<$arraylength2;$y++) {
                while(in_array($auto_id, $ids)) {
                    $auto_id++;
                }
                $data2['id'] = $auto_id;
                $data2['account_id'] = $active_account[0]['id'];
                $data2['project_id'] = $y + 5;
                $data2['emp_id'] = $_POST['id'][$x];
                $data2['count'] = $_POST['salary'][$x][$y];
                $data2['update_time'] = Date('Y-m-d');
                $ids[++$z] = $auto_id;
                $auto_id = 1;

                $project_person->add($data2);
            } 
        }
    }

    public function statistic() {
        $department = M('department');
        $folk_type = M('folk_type');
        $native_type = M('native_type');
        $use_form = M('use_form');
        
        $department_data = $department->select();
        $department_data_str = '';
        if($department_data) {
            $arraylength = count($department_data);
            for($x=0;$x<$arraylength;$x++) {
                $department_data_str = $department_data_str.'<option value="'.$department_data[$x]['department'].'">'.$department_data[$x]['department'].'</option>';
            }
        }
        $folk_data = $folk_type->select();
        $folk_data_str = '';
        if($folk_data) {
            $arraylength = count($folk_data);
            for($x=0;$x<$arraylength;$x++) {
                $folk_data_str = $folk_data_str.'<option value="'.$folk_data[$x]['content'].'">'.$folk_data[$x]['content'].'</option>';
            }
        }
        $native_data = $native_type->select();
        $native_data_str = '';
        if($native_data) {
            $arraylength = count($native_data);
            for($x=0;$x<$arraylength;$x++) {
                $native_data_str = $native_data_str.'<option value="'.$native_data[$x]['content'].'">'.$native_data[$x]['content'].'</option>';
            }
        }
        $use_form_data = $use_form->select();
        $use_form_str = '';
        if($use_form_data) {
            $arraylength = count($use_form_data);
            for($x=0;$x<$arraylength;$x++) {
                $use_form_str = $use_form_str.'<option value="'.$use_form_data[$x]['content'].'">'.$use_form_data[$x]['content'].'</option>';
            }
        }

        $this->assign('department_data_str', $department_data_str);
        $this->assign('folk_data_str', $folk_data_str);
        $this->assign('native_data_str', $native_data_str);
        $this->assign('use_form_str', $use_form_str);
        $this->assign('usertype', $_SESSION['usertype']);
        $this->display('statistic');
    }

    public function statistic_change() {
        $personal_info = M('personal_info');    //个人信息表
        $duty_info = M('duty_info');    //职务信息表
        $attendence_info = M('attendence_info');    //出勤信息表
        $rnp_info = M('rnp_info');  //奖惩信息表
        $salary = M('salary');  //工资表
        $project_person = M('project_person');  //账套项目
        $account_info = M('account_info');  //账套信息
        $account_project = M('account_project');    //账套项目

        if($_POST['alternative'] == '上') {
            $project_person_query = ' and (update_time like "'.$_POST['year'].'-01%" or update_time like "'.$_POST['year'].'-02%" or update_time like "'.$_POST['year'].'-03%" or update_time like "'.$_POST['year'].'-04%" or update_time like "'.$_POST['year'].'-05%" or update_time like "'.$_POST['year'].'-06%")';
            $rnp_query = ' and (rnp_date like "'.$_POST['year'].'-01%" or rnp_date like "'.$_POST['year'].'-02%" or rnp_date like "'.$_POST['year'].'-03%" or rnp_date like "'.$_POST['year'].'-04%" or rnp_date like "'.$_POST['year'].'-05%" or rnp_date like "'.$_POST['year'].'-06%")';
            $attendence_query = ' and (attendence_start_date like "'.$_POST['year'].'-01%" or attendence_start_date like "'.$_POST['year'].'-02%" or attendence_start_date like "'.$_POST['year'].'-03%" or attendence_start_date like "'.$_POST['year'].'-04%" or attendence_start_date like "'.$_POST['year'].'-05%" or attendence_start_date like "'.$_POST['year'].'-06%")';
            $month_count = 6;
        } else if($_POST['alternative'] == '下') {
            $project_person_query = ' and (update_time like "'.$_POST['year'].'-07%" or update_time like "'.$_POST['year'].'-08%" or update_time like "'.$_POST['year'].'-09%" or update_time like "'.$_POST['year'].'-10%" or update_time like "'.$_POST['year'].'-11%" or update_time like "'.$_POST['year'].'-12%")';
            $rnp_query = ' and (rnp_date like "'.$_POST['year'].'-07%" or rnp_date like "'.$_POST['year'].'-08%" or rnp_date like "'.$_POST['year'].'-09%" or rnp_date like "'.$_POST['year'].'-10%" or rnp_date like "'.$_POST['year'].'-11%" or rnp_date like "'.$_POST['year'].'-12%")';
            $attendence_query = ' and (attendence_start_date like "'.$_POST['year'].'-07%" or attendence_start_date like "'.$_POST['year'].'-08%" or attendence_start_date like "'.$_POST['year'].'-09%" or attendence_start_date like "'.$_POST['year'].'-10%" or attendence_start_date like "'.$_POST['year'].'-11%" or attendence_start_date like "'.$_POST['year'].'-12%")';
            $month_count = 6;
        } else if($_POST['alternative'] == '第一') {
            $project_person_query = ' and (update_time like "'.$_POST['year'].'-01%" or update_time like "'.$_POST['year'].'-02%" or update_time like "'.$_POST['year'].'-03%")';
            $rnp_query = ' and (rnp_date like "'.$_POST['year'].'-01%" or rnp_date like "'.$_POST['year'].'-02%" or rnp_date like "'.$_POST['year'].'-03%")';
            $attendence_query = ' and (attendence_start_date like "'.$_POST['year'].'-01%" or attendence_start_date like "'.$_POST['year'].'-02%" or attendence_start_date like "'.$_POST['year'].'-03%")';
            $month_count = 3;
        } else if($_POST['alternative'] == '第二') {
            $project_person_query = ' and (update_time like "'.$_POST['year'].'-04%" or update_time like "'.$_POST['year'].'-05%" or update_time like "'.$_POST['year'].'-06%")';
            $rnp_query = ' and (rnp_date like "'.$_POST['year'].'-04%" or rnp_date like "'.$_POST['year'].'-05%" or rnp_date like "'.$_POST['year'].'-06%")';
            $attendence_query = ' and (attendence_start_date like "'.$_POST['year'].'-04%" or attendence_start_date like "'.$_POST['year'].'-05%" or attendence_start_date like "'.$_POST['year'].'-06%")';
            $month_count = 3;
        } else if($_POST['alternative'] == '第三') {
            $project_person_query = ' and (update_time like "'.$_POST['year'].'-07%" or update_time like "'.$_POST['year'].'-08%" or update_time like "'.$_POST['year'].'-09%")';
            $rnp_query = ' and (rnp_date like "'.$_POST['year'].'-07%" or rnp_date like "'.$_POST['year'].'-08%" or rnp_date like "'.$_POST['year'].'-09%")';
            $attendence_query = ' and (attendence_start_date like "'.$_POST['year'].'-07%" or attendence_start_date like "'.$_POST['year'].'-08%" or attendence_start_date like "'.$_POST['year'].'-09%")';
            $month_count = 3;
        } else if($_POST['alternative'] == '第四') {
            $project_person_query = ' and (update_time like "'.$_POST['year'].'-10%" or update_time like "'.$_POST['year'].'-11%" or update_time like "'.$_POST['year'].'-12%")';
            $rnp_query = ' and (rnp_date like "'.$_POST['year'].'-10%" or rnp_date like "'.$_POST['year'].'-11%" or rnp_date like "'.$_POST['year'].'-12%")';
            $attendence_query = ' and (attendence_start_date like "'.$_POST['year'].'-10%" or attendence_start_date like "'.$_POST['year'].'-11%" or attendence_start_date like "'.$_POST['year'].'-12%")';
            $month_count = 3;
        } else if($_POST['alternative'] == '') {
            $project_person_query = '';
            $rnp_query = '';
            $attendence_query = '';
            $month_count = 12;
        } else {
            $project_person_query = ' and update_time like "'.$_POST['year'].'-'.$_POST['alternative'].'%"';
            $rnp_query = ' and rnp_date like "'.$_POST['year'].'-'.$_POST['alternative'].'%"';
            $attendence_query = ' and attendence_start_date like "'.$_POST['year'].'-'.$_POST['alternative'].'%"';
            $month_count = 1;
        }
        // echo $project_person_query.' jfjj '.$_POST['alternative'];
        // $project_person_data = $project_person->where('update_time like "'.$_POST['year'].'-01%" or update_time like "'.$_POST['year'].'-02%" or update_time like "'.$_POST['year'].'-03%"')->select();
        if($_SESSION['usertype'] == '超级管理员') {
            $person_data = $personal_info->select();
            $duty_data = $duty_info->select();
            $salary_data = $salary->select();
        } else {
            $person_data = $personal_info->where('id='.$_SESSION['newEmpId'])->select();
            $duty_data = $duty_info->where('id='.$_SESSION['newEmpId'])->select();
            $salary_data = $salary->where('id='.$_SESSION['newEmpId'])->select();
        }

        $arraylength = count($person_data);
        if($arraylength) {
            for($x=0;$x<$arraylength;$x++) {
                $sum = 0;
                if($person_data[$x]['id'] == $duty_data[$x]['id']) {
                    $data[$x]['id'] = $person_data[$x]['id'];
                    $data[$x]['fm_num'] = $person_data[$x]['fm_num'];
                    $data[$x]['emp_name'] = $person_data[$x]['emp_name'];
                    $data[$x]['emp_sex'] = $person_data[$x]['emp_sex'];
                    $data[$x]['emp_department'] = $duty_data[$x]['emp_department'];
                    $data[$x]['emp_job'] = $duty_data[$x]['emp_job'];
                    $data[$x]['emp_cont_start'] = $duty_data[$x]['emp_cont_start'];
                    $data[$x]['emp_cont_end'] = $duty_data[$x]['emp_cont_end'];
                }
                if($person_data[$x]['id'] == $salary_data[$x]['id']) {
                    $data[$x]['salary'] = $salary_data[$x]['salary'];
                }
                if($data[$x]['salary'] == '') {
                    $data[$x]['salary'] = 0;
                }
            }

            $arraylength = 0;
            $active_account = $account_info->where('use_status="on"')->field('id')->select();
            if($active_account) {
                $active_account_project = $account_project->where('account_id='.$active_account[0]['id'])->order('project_id asc')->select();
                $arraylength = count($active_account_project);
            }
            $infoData = '<table class="table table-striped" id="statistic"><tr><td>档案编号</td><td>姓名</td><td>性别</td><td>部门</td><td>职务</td><td>基本工资</td>';
            if($arraylength) {
                for($x=0;$x<$arraylength;$x++) {
                    $infoData = $infoData.'<td>'.$active_account_project[$x]['project_name'].'</td>';
                }
            }

            $infoData = $infoData.'<td>奖励</td><td>惩罚</td><td>总计</td></tr>';

            $arraylength = count($data);
            for($x=0;$x<$arraylength;$x++) {
                $emp_month_count = $month_count;
                $cont_start_date = explode('-', $data[$x]['emp_cont_start']);
                $cont_end_date = explode('-', $data[$x]['emp_cont_end']);
                if($month_count == 12) {
                    if((int)$cont_start_date[0] == (int)$_POST['year'] && (int)$cont_end_date[0] == (int)$_POST['year']) {
                        $emp_month_count = (int)$cont_end_date[1] - (int)$cont_start_date[1];
                    } else if((int)$cont_start_date[0] == (int)$_POST['year']) {
                        if((int)$cont_start_date[2] >= 15) {
                            $emp_month_count = 13 - (int)$cont_start_date[1] - 1;
                        } else {
                            $emp_month_count = 13 - (int)$cont_start_date[1];
                        }
                    } else if((int)$cont_end_date[0] == (int)$_POST['year']) {
                        if((int)$cont_end_date[2] >= 15) {
                            $emp_month_count = (int)$cont_end_date[1];
                        } else {
                            $emp_month_count = (int)$cont_end_date[1] - 1;
                        }
                    }
                } else if($_POST['alternative'] == '上') {
                    if((int)$cont_start_date[0] == (int)$_POST['year'] && (int)$cont_end_date[0] == (int)$_POST['year']) {
                        if((int)$cont_start_date[1]>=1 && (int)$cont_start_date[1]<=6) {
                            $emp_month_count = (int)$cont_end_date[1] - (int)$cont_start_date[1] < 7 - (int)$cont_start_date[1]?(int)$cont_end_date[1] - (int)$cont_start_date[1]:7- (int)$cont_start_date[1];
                        } else {
                            $emp_month_count = 0;
                        }
                        if((int)$cont_start_date[2] >= 15) {
                            $emp_month_count--;
                        }
                        if((int)$cont_end_date[2] < 15) {
                            $emp_month_count--;
                        }
                    } else if((int)$cont_start_date[0] == (int)$_POST['year']) {
                        if((int)$cont_start_date[1]>=1 && (int)$cont_start_date[1]<=6) {
                            $emp_month_count = 6 - (int)$cont_start_date[1];
                        } else {
                            $emp_month_count = 0;
                        }
                        if((int)$cont_start_date[2] >= 15) {
                            $emp_month_count--;
                        }
                    } else if((int)$cont_end_date[0] == (int)$_POST['year']) {
                        if((int)$cont_end_date[1]>=1 && (int)$cont_end_date[1]<=6) {
                            $emp_month_count = 6 - (int)$cont_end_date[1];
                        } else {
                            $emp_month_count = 6 + (int)$cont_end_date[1];
                        }
                        if((int)$cont_end_date[2] < 15) {
                            $emp_month_count--;
                        }
                    }
                } else if($_POST['alternative'] == '下') {
                    if((int)$cont_start_date[0] == (int)$_POST['year'] && (int)$cont_end_date[0] == (int)$_POST['year']) {
                        if((int)$cont_end_date[1]>=7 && (int)$cont_end_date[1]<=12) {
                            $emp_month_count = (int)$cont_end_date[1] - (int)$cont_start_date[1] < (int)$cont_end_date[1] - 6?(int)$cont_end_date[1] - (int)$cont_start_date[1]:(int)$cont_end_date[1] - 6;
                        } else {
                            $emp_month_count = 0;
                        }
                        if((int)$cont_start_date[2] >= 15) {
                            $emp_month_count--;
                        }
                        if((int)$cont_end_date[2] < 15) {
                            $emp_month_count--;
                        }
                    } else if((int)$cont_start_date[0] == (int)$_POST['year']) {
                        if((int)$cont_start_date[1]>=7 && (int)$cont_start_date[1]<=12) {
                            $emp_month_count = 13 - (int)$cont_start_date[1];
                        } else {
                            $emp_month_count = 6;
                        }
                        if((int)$cont_start_date[2] >= 15) {
                            $emp_month_count--;
                        }
                    } else if((int)$cont_end_date[0] == (int)$_POST['year']) {
                        if((int)$cont_end_date[1]>=7 && (int)$cont_end_date[1]<=12) {
                            $emp_month_count = 13 - (int)$cont_end_date[1] + 6;
                        } else {
                            $emp_month_count = 0;
                        }
                        if((int)$cont_end_date[2] < 15) {
                            $emp_month_count--;
                        }
                    }
                } else if($_POST['alternative'] == '第一') {
                    if((int)$cont_start_date[0] == (int)$_POST['year'] && (int)$cont_end_date[0] == (int)$_POST['year']) {
                        if((int)$cont_start_date[1]>=1 && (int)$cont_start_date[1]<=3) {
                            $emp_month_count = (int)$cont_end_date[1] - (int)$cont_start_date[1] < 4 - (int)$cont_start_date[1]?(int)$cont_end_date[1] - (int)$cont_start_date[1]:4 - (int)$cont_start_date[1];
                        } else {
                            $emp_month_count = 0;
                        }
                        if((int)$cont_start_date[2] >= 15) {
                            $emp_month_count--;
                        }
                        if((int)$cont_end_date[2] < 15) {
                            $emp_month_count--;
                        }
                    } else if((int)$cont_start_date[0] == (int)$_POST['year']) {
                        if((int)$cont_start_date[1]>=1 && (int)$cont_start_date[1]<=3) {
                            $emp_month_count = 4 - (int)$cont_start_date[1];
                        } else {
                            $emp_month_count = 0;
                        }
                        if((int)$cont_start_date[2] >= 15) {
                            $emp_month_count--;
                        }
                    } else if((int)$cont_end_date[0] == (int)$_POST['year']) {
                        if((int)$cont_end_date[1]>=1 && (int)$cont_end_date[1]<=3) {
                            $emp_month_count = (int)$cont_end_date[1];
                        } else {
                            $emp_month_count = 3;
                        }
                        if((int)$cont_end_date[2] < 15) {
                            $emp_month_count--;
                        }
                    }
                } else if($_POST['alternative'] == '第二') {
                    if((int)$cont_start_date[0] == (int)$_POST['year'] && (int)$cont_end_date[0] == (int)$_POST['year']) {
                        if((int)$cont_start_date[1]>=4 && (int)$cont_start_date[1]<=6) {
                            $emp_month_count = (int)$cont_end_date[1] - (int)$cont_start_date[1] < 7 - (int)$cont_start_date[1]?(int)$cont_end_date[1] - (int)$cont_start_date[1]:7 - (int)$cont_start_date[1];
                        } else if((int)$cont_start_date[1] < 4) {
                            $emp_month_count = (int)$cont_end_date[1] - 3 < 3?(int)$cont_end_date[1] - 3:3;
                        } else {
                            $emp_month_count = 0;
                        }
                        if((int)$cont_start_date[2] >= 15) {
                            $emp_month_count--;
                        }
                        if((int)$cont_end_date[2] < 15) {
                            $emp_month_count--;
                        }
                    } else if((int)$cont_start_date[0] == (int)$_POST['year']) {
                        if((int)$cont_start_date[1]<=6) {
                            $emp_month_count = 7 - (int)$cont_start_date[1] < 3?7 - (int)$cont_start_date[1]:3;
                        } else {
                            $emp_month_count = 0;
                        }
                        if((int)$cont_start_date[2] >= 15) {
                            $emp_month_count--;
                        }
                    } else if((int)$cont_end_date[0] == (int)$_POST['year']) {
                        if((int)$cont_end_date[1]>=4 && (int)$cont_end_date[1]<=6) {
                            $emp_month_count = (int)$cont_end_date[1] - 3;
                        } else if((int)$cont_end_date[1]<4) {
                            $emp_month_count = 0;
                        } else {
                            $emp_month_count = 3;
                        }
                        if((int)$cont_end_date[2] < 15) {
                            $emp_month_count--;
                        }
                    }
                } else if($_POST['alternative'] == '第三') {
                    if((int)$cont_start_date[0] == (int)$_POST['year'] && (int)$cont_end_date[0] == (int)$_POST['year']) {
                        if((int)$cont_start_date[1]>=7 && (int)$cont_start_date[1]<=9) {
                            $emp_month_count = (int)$cont_end_date[1] - (int)$cont_start_date[1] < 10 - (int)$cont_start_date[1]?(int)$cont_end_date[1] - (int)$cont_start_date[1]:10 - (int)$cont_start_date[1];
                        } else if((int)$cont_start_date[1] < 7) {
                            $emp_month_count = (int)$cont_end_date[1] - 6 < 3?(int)$cont_end_date[1] - 6:3;
                        } else {
                            $emp_month_count = 0;
                        }
                        if((int)$cont_start_date[2] >= 15) {
                            $emp_month_count--;
                        }
                        if((int)$cont_end_date[2] < 15) {
                            $emp_month_count--;
                        }
                    } else if((int)$cont_start_date[0] == (int)$_POST['year']) {
                        if((int)$cont_start_date[1]<=9) {
                            $emp_month_count = 10 - (int)$cont_start_date[1] < 3?10 - (int)$cont_start_date[1]:3;
                        } else {
                            $emp_month_count = 0;
                        }
                        if((int)$cont_start_date[2] >= 15) {
                            $emp_month_count--;
                        }
                    } else if((int)$cont_end_date[0] == (int)$_POST['year']) {
                        if((int)$cont_end_date[1]>=7 && (int)$cont_end_date[1]<=9) {
                            $emp_month_count = (int)$cont_end_date[1] - 6;
                        } else if((int)$cont_end_date[1]<7) {
                            $emp_month_count = 0;
                        } else {
                            $emp_month_count = 3;
                        }
                        if((int)$cont_end_date[2] < 15) {
                            $emp_month_count--;
                        }
                    }
                } else if($_POST['alternative'] == '第四') {
                    if((int)$cont_start_date[0] == (int)$_POST['year'] && (int)$cont_end_date[0] == (int)$_POST['year']) {
                        if((int)$cont_start_date[1]>=10 && (int)$cont_start_date[1]<=12) {
                            $emp_month_count = (int)$cont_end_date[1] - (int)$cont_start_date[1] < 13 - (int)$cont_start_date[1]?(int)$cont_end_date[1] - (int)$cont_start_date[1]:13 - (int)$cont_start_date[1];
                        } else if((int)$cont_start_date[1] < 10) {
                            $emp_month_count = (int)$cont_end_date[1] - 9 < 3?(int)$cont_end_date[1] - 9:3;
                        } else {
                            $emp_month_count = 0;
                        }
                        if((int)$cont_start_date[2] >= 15) {
                            $emp_month_count--;
                        }
                        if((int)$cont_end_date[2] < 15) {
                            $emp_month_count--;
                        }
                    } else if((int)$cont_start_date[0] == (int)$_POST['year']) {
                        if((int)$cont_start_date[1]<=9) {
                            $emp_month_count = 13 - (int)$cont_start_date[1] < 3?13 - (int)$cont_start_date[1]:3;
                        } else {
                            $emp_month_count = 0;
                        }
                        if((int)$cont_start_date[2] >= 15) {
                            $emp_month_count--;
                        }
                    } else if((int)$cont_end_date[0] == (int)$_POST['year']) {
                        if((int)$cont_end_date[1]>=10 && (int)$cont_end_date[1]<=12) {
                            $emp_month_count = (int)$cont_end_date[1] - 9;
                        } else {
                            $emp_month_count = 0;
                        }
                        if((int)$cont_end_date[2] < 15) {
                            $emp_month_count--;
                        }
                    }
                } else if($month_count == 1) {
                    if((int)$cont_start_date[0] == (int)$_POST['year'] && (int)$cont_end_date[0] == (int)$_POST['year']) {
                        if((int)$_POST['alternative'] >= (int)$cont_start_date[1] && (int)$_POST['alternative'] <= (int)$cont_end_date[1]) {
                            $emp_month_count = 1;
                        } else {
                            $emp_month_count = 0;
                        }
                        if((int)$cont_start_date[2] >= 15) {
                            $emp_month_count--;
                        }
                        if((int)$cont_end_date[2] < 15) {
                            $emp_month_count--;
                        }
                    } else if((int)$cont_start_date[0] == (int)$_POST['year']) {
                        if((int)$_POST['alternative'] >= (int)$cont_start_date[1]) {
                            $emp_month_count = 1;
                        } else {
                            $emp_month_count = 0;
                        }
                        if((int)$cont_start_date[2] >= 15) {
                            $emp_month_count--;
                        }
                    } else if((int)$cont_end_date[0] == (int)$_POST['year']) {
                        if((int)$_POST['alternative'] <= (int)$cont_end_date[1]) {
                            $emp_month_count = 1;
                        } else {
                            $emp_month_count = 0;
                        }
                        if((int)$cont_end_date[2] < 15) {
                            $emp_month_count--;
                        }
                    }
                }

                if($emp_month_count < 0) {
                    $emp_month_count = 0;
                }
                $emp_month_reward = $emp_month_count;
                $emp_year_reward = 1;
                $emp_month_res = $rnp_info->where('emp_id='.$person_data[$x]['id'].' and rnp_type="月奖金"'.$rnp_query)->select();
                $emp_year_res = $rnp_info->where('emp_id='.$person_data[$x]['id'].' and rnp_type="年终奖"')->select();
                if($emp_year_res) {
                    $emp_year_reward = 0;
                }
                if($_POST['alternative'] != '') {
                    $emp_year_reward = 0;
                }
                if($emp_month_res) {
                    $emp_month_reward -= count($emp_month_res);
                }
                if($emp_month_reward < 0) {
                    $emp_month_reward = 0;
                }
                $infoData = $infoData.'<tr id='.$data[$x]['id'].'>'.'<td>'.$data[$x]['fm_num'].'</td>'.'<td>'.$data[$x]['emp_name'].'</td>'.'<td>'.$data[$x]['emp_sex'].'</td>'.'<td>'.$data[$x]['emp_department'].'</td>'.'<td>'.$data[$x]['emp_job'].'</td>'.'<td>'.$data[$x]['salary'].'×'.$emp_month_count.'元</td>';
                $sum = $data[$x]['salary']*(int)$emp_month_count;
                if($active_account) {
                    $first_count = count($attendence_info->where('emp_id='.$data[$x]['id'].' and attendence_status="缺勤"'.$attendence_query)->select());
                    $second_count = count($attendence_info->where('emp_id='.$data[$x]['id'].' and attendence_status="迟到"'.$attendence_query)->select());
                    $third_data = $attendence_info->where('emp_id='.$data[$x]['id'].' and attendence_status="请假"'.$attendence_query)->select();
                    if($third_data) {
                        $arraylength2 = count($third_data);
                        $third_count = 0;
                        for($y=0;$y<$arraylength2;$y++) {
                            if($third_data[$y]['attendence_start_date'] == $third_data[$y]['attendence_end_date'] || $third_data[$y]['attendence_end_date'] == '') {
                                $third_count += 1;
                            } else {
                                $attendence_start_date = explode('-', $third_data[$y]['attendence_start_date']);
                                $attendence_end_date = explode('-', $third_data[$y]['attendence_end_date']);
                                if((0 == $attendence_start_date[0]%4)&&(0 != $attendence_start_date[0]%100)||(0 == $attendence_start_date[0]%400)) {
                                    $Feb_days = 30;
                                } else {
                                    $Feb_days = 29;
                                }
                                while(  $attendence_start_date[0] != $attendence_end_date[0]
                                        || $attendence_start_date[1] != $attendence_end_date[1]
                                        || $attendence_start_date[2] != $attendence_end_date[2]) {
                                    $attendence_start_date[2]++;
                                    $third_count++;
                                    if($attendence_start_date[2] == $Feb_days && $attendence_start_date[1] == 2) {
                                        $attendence_start_date[1]++;
                                        $attendence_start_date[2] = 1;
                                    } else if(  $attendence_start_date[2] == 31
                                                && ($attendence_start_date[1] == 4   
                                                ||  $attendence_start_date[1] == 6
                                                ||  $attendence_start_date[1] == 9
                                                ||  $attendence_start_date[1] == 11)) {
                                        $attendence_start_date[1]++;
                                        $attendence_start_date[2] = 1;
                                    } else if(  $attendence_start_date[2] == 32
                                                && ($attendence_start_date[1] == 1   
                                                ||  $attendence_start_date[1] == 3
                                                ||  $attendence_start_date[1] == 5
                                                ||  $attendence_start_date[1] == 7
                                                ||  $attendence_start_date[1] == 8
                                                ||  $attendence_start_date[1] == 10
                                                ||  $attendence_start_date[1] == 12)) {
                                        $attendence_start_date[1]++;
                                        $attendence_start_date[2] = 1;
                                    }
                                }
                            }
                        }
                    } else {
                        $third_count = 0;
                    }
                    
                    $infoData = $infoData.'<td>-'.$active_account_project[0]['project_money'].'×'.$first_count.'元</td>';
                    $infoData = $infoData.'<td>-'.$active_account_project[1]['project_money'].'×'.$second_count.'元</td>';
                    $infoData = $infoData.'<td>-'.$active_account_project[2]['project_money'].'×'.$third_count.'元</td>';
                    $infoData = $infoData.'<td>'.$active_account_project[3]['project_money'].'×'.$emp_month_reward.'元</td>';
                    $infoData = $infoData.'<td>'.$active_account_project[4]['project_money'].'×'.$emp_year_reward.'元</td>';

                    $sum = $sum - $active_account_project[0]['project_money']*$first_count - $active_account_project[1]['project_money']*$second_count - $active_account_project[2]['project_money']*$third_count;
                    $sum = $sum + $active_account_project[3]['project_money']*$emp_month_reward + $active_account_project[4]['project_money']*$emp_year_reward;
                    $arraylength2 = 0;

                    $project_person_data = $project_person->where('emp_id='.$data[$x]['id'].' and account_id='.$active_account[0]['id'].$project_person_query)->order('project_id asc')->select();
                    $arraylength2 = count($project_person_data);
                    if($arraylength2) {
                        $z = 0;
                        for($y=0;$y<$arraylength2&&$z<count($active_account_project) - 5;) {
                            if($active_account_project[$z+5]['project_id'] == $project_person_data[$y]['project_id']) {
                                if($active_account_project[$z+5]['project_type'] == '扣除'){
                                    $flag = '-';
                                    $sum = $sum - $active_account_project[$z+5]['project_money']*$project_person_data[$y]['count'];
                                } else {
                                    $flag = '';
                                    $sum = $sum + $active_account_project[$z+5]['project_money']*$project_person_data[$y]['count'];
                                }
                                $infoData = $infoData.'<td>'.$flag.$active_account_project[$z+5]['project_money'].'×'.$project_person_data[$y]['count'].'元</td>';

                                $y++;
                            } else {
                                if($active_account_project[$z+5]['project_type'] == '扣除'){
                                    $flag = '-';
                                } else {
                                    $flag = '';
                                }
                                $infoData = $infoData.'<td>'.$flag.$active_account_project[$z+5]['project_money'].'×0元</td>';
                            }
                            $z++;
                        }
                    } else {
                        $arraylength2 = count($active_account_project);
                        for($y=5;$y<$arraylength2;$y++) {
                            $infoData = $infoData.'<td>'.$active_account_project[$y]['project_money'].'×0元</td>';
                        }
                    }
                }
                $reward_data = $rnp_info->where('emp_id='.$data[$x]['id'].' and rnp_status="奖励"'.$rnp_query)->select();
                $punish_data = $rnp_info->where('emp_id='.$data[$x]['id'].' and rnp_status="惩罚" and rnp_type="其他"'.$rnp_query)->select();

                $reward_money = 0;
                $punish_money = 0;

                if($reward_data) {
                    $arraylength2 = count($reward_data);
                    for($y=0;$y<$arraylength2;$y++) {
                        $reward_money += $reward_data[$y]['rnp_money'];
                    }
                }

                if($punish_data) {
                    $arraylength2 = count($punish_data);
                    for($y=0;$y<$arraylength2;$y++) {
                        $punish_money += $punish_data[$y]['rnp_money'];
                    }
                }

                $sum = $sum + $reward_money - $punish_money;
                $infoData = $infoData.'<td>'.$reward_money.'元</td><td>-'.$punish_money.'元</td><td>'.$sum.'</td></tr>';
            }
            $infoData = $infoData.'</table>';
        } else {
            $infoData = '<div>尚未有员工档案</div>';
        }
        echo $infoData;
    }

}