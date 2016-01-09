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

    public function create() {
        $personal_info = M('Personal_info');
        $personal_info->create();
        $mysql_id = $personal_info->field('id')->select();
        $arraylength = count($mysql_id);
        for($x=0;$x<$arraylength;$x++){
            $ids[$x] = $mysql_id[$x]['id'];
        }
        $auto_id = 0;
        while(in_array($auto_id, $ids)) {
            $auto_id++;
        } 
        $this->assign('auto_id', $auto_id);
        $this->display('create');
    }

    public function check() {
        $personal_info = M('personal_info');
        $person_data = $personal_info->select();
        $duty_info = M('duty_info');
        $duty_data = $duty_info->select();
        $arraylength = count($person_data);
        for($x=0;$x<$arraylength;$x++) {
            if($person_data[$x]['id'] == $duty_data[$x]['id']) {
                $data[$x]['id'] = $person_data[$x]['id'];
                $data[$x]['fm_num'] = $person_data[$x]['fm_num'];
                $data[$x]['emp_name'] = $person_data[$x]['emp_name'];
                $data[$x]['emp_sex'] = $person_data[$x]['emp_sex'];
                $data[$x]['emp_department'] = $duty_data[$x]['emp_department'];
                $data[$x]['emp_job'] = $duty_data[$x]['emp_job'];
            }
        }
        $arraylength = count($data);
        $infoData = '<table class="table table-striped"><tr><td>档案编号</td><td>姓名</td><td>性别</td><td>部门</td><td>职务</td><td>操作</td></tr>';
        for($x=0;$x<$arraylength;$x++) {
            $infoData = $infoData.'<tr id='.$data[$x]['id'].'>'.'<td>'.$data[$x]['fm_num'].'</td>'.'<td>'.$data[$x]['emp_name'].'</td>'.'<td>'.$data[$x]['emp_sex'].'</td>'.'<td>'.$data[$x]['emp_department'].'</td>'.'<td>'.$data[$x]['emp_job'].'</td>'.'<td><a class="show" href="#">查看</a><a class="edit" href="#">修改</a><a class="delete" href="#">删除</a></td></tr>';
        }
        $infoData = $infoData.'</table>';
        $this->assign('infoData', $infoData);
    	$this->display('check');
    }

    public function test() {
        $_SESSION['newFileId'] = $_POST['id'];
        $this->display('show');
    }

    public function show() {
        if($_POST['id'] != '') {
            $_SESSION['newFileId'] = $_POST['id'];
        }
        if($_SESSION['newFileId'] != '') {
            $id = $_SESSION['newFileId'];
            $this->assign('id', $id);
        }
        $personal_info = M('personal_info');
        $person_data = $personal_info->where('id='.$id)->select();
        $duty_info = M('duty_info');
        $duty_data = $duty_info->where('id='.$id)->select();

        if($person_data[0]['fm_num'] != '') {
            $fm_num = $person_data[0]['fm_num'];
            $this->assign('fm_num', $fm_num);
        }

        if($person_data[0]['emp_name'] != '') {
            $emp_name = $person_data[0]['emp_name'];
            $this->assign('emp_name', $emp_name);
        }

        if($person_data[0]['emp_sex'] != '') {
            if($person_data[0]['emp_sex'] == '男') {
                $emp_sex_male = 'checked';
                $emp_sex_female = '';
                $this->assign('emp_sex_male', $emp_sex_male);
                $this->assign('emp_sex_female', $emp_sex_female);
            } else {
                $emp_sex_male = '';
                $emp_sex_female = 'checked';
                $this->assign('emp_sex_male', $emp_sex_male);
                $this->assign('emp_sex_female', $emp_sex_female);
            }
        }

        if($person_data[0]['emp_borndate'] != '') {
            $emp_borndate = $person_data[0]['emp_borndate'];
            $this->assign('emp_borndate', $emp_borndate);
        }

        if($person_data[0]['emp_folk'] != '') {
            $emp_folk = $person_data[0]['emp_folk'];
            $this->assign('emp_folk', $emp_folk);
        }

        if($person_data[0]['emp_native'] != '') {
            $emp_native = $person_data[0]['emp_native'];
            $this->assign('emp_native', $emp_native);
        }

        if($person_data[0]['emp_idnum'] != '') {
            $emp_idnum = $person_data[0]['emp_idnum'];
            $this->assign('emp_idnum', $emp_idnum);
        }

        if($person_data[0]['emp_edu'] != '') {
            $emp_edu = $person_data[0]['emp_edu'];
            $this->assign('emp_edu', $emp_edu);
        }

        if($person_data[0]['emp_gra_school'] != '') {
            $emp_gra_school = $person_data[0]['emp_gra_school'];
            $this->assign('emp_gra_school', $emp_gra_school);
        }

        if($person_data[0]['emp_gra_date'] != '') {
            $emp_gra_date = $person_data[0]['emp_gra_date'];
            $this->assign('emp_gra_date', $emp_gra_date);
        }

        if($person_data[0]['emp_politics'] != '') {
            if($person_data[0]['emp_politics'] == '党员') {
                $emp_politics_dangyuan = 'checked';
                $emp_politics_qunzhong = '';
                $this->assign('emp_politics_dangyuan', $emp_politics_dangyuan);
                $this->assign('emp_politics_qunzhong', $emp_politics_qunzhong);
            } else {
                $emp_politics_dangyuan = '';
                $emp_politics_qunzhong = 'checked';
                $this->assign('emp_politics_dangyuan', $emp_politics_dangyuan);
                $this->assign('emp_politics_qunzhong', $emp_politics_qunzhong);
            }
        }

        if($person_data[0]['emp_marriage'] != '') {
            if($person_data[0]['emp_marriage'] == '已婚') {
                $emp_marriage_married = 'checked';
                $emp_marriage_unmarried = '';
                $this->assign('emp_marriage_married', $emp_marriage_married);
                $this->assign('emp_marriage_unmarried', $emp_marriage_unmarried);
            } else {
                $emp_marriage_married = '';
                $emp_marriage_unmarried = 'checked';
                $this->assign('emp_marriage_married', $emp_marriage_married);
                $this->assign('emp_marriage_unmarried', $emp_marriage_unmarried);
            }
        }

        if($person_data[0]['emp_postcode'] != '') {
            $emp_postcode = $person_data[0]['emp_postcode'];
            $this->assign('emp_postcode', $emp_postcode);
        }

        if($person_data[0]['emp_phone'] != '') {
            $emp_phone = $person_data[0]['emp_phone'];
            $this->assign('emp_phone', $emp_phone);
        }

        if($person_data[0]['emp_qq'] != '') {
            $emp_qq = $person_data[0]['emp_qq'];
            $this->assign('emp_qq', $emp_qq);
        }

        if($person_data[0]['emp_email'] != '') {
            $emp_email = $person_data[0]['emp_email'];
            $this->assign('emp_email', $emp_email);
        }

        if($person_data[0]['emp_addr'] != '') {
            $emp_addr = $person_data[0]['emp_addr'];
            $this->assign('emp_addr', $emp_addr);
        }

        if($duty_data[0]['emp_department'] != '') {
            $emp_department = $duty_data[0]['emp_department'];
            $this->assign('emp_department', $emp_department);
        }

        if($duty_data[0]['emp_job'] != '') {
            $emp_job = $duty_data[0]['emp_job'];
            $this->assign('emp_job', $emp_job);
        }

        if($duty_data[0]['emp_entry_date'] != '') {
            $emp_entry_date = $duty_data[0]['emp_entry_date'];
            $this->assign('emp_entry_date', $emp_entry_date);
        }

        if($duty_data[0]['emp_use_form'] != '') {
            $emp_use_form = $duty_data[0]['emp_use_form'];
            $this->assign('emp_use_form', $emp_use_form);
        }

        if($duty_data[0]['emp_exit_date'] != '') {
            $emp_exit_date = $duty_data[0]['emp_exit_date'];
            $this->assign('emp_exit_date', $emp_exit_date);
        }

        if($duty_data[0]['emp_exit_reason'] != '') {
            $emp_exit_reason = $duty_data[0]['emp_exit_reason'];
            $this->assign('emp_exit_reason', $emp_exit_reason);
        }

        if($duty_data[0]['emp_cont_start'] != '') {
            $emp_cont_start = $duty_data[0]['emp_cont_start'];
            $this->assign('emp_cont_start', $emp_cont_start);
        }

        if($duty_data[0]['emp_cont_end'] != '') {
            $emp_cont_end = $duty_data[0]['emp_cont_end'];
            $this->assign('emp_cont_end', $emp_cont_end);
        }

        if($duty_data[0]['emp_full_date'] != '') {
            $emp_full_date = $duty_data[0]['emp_full_date'];
            $this->assign('emp_full_date', $emp_full_date);
        }

        if($duty_data[0]['emp_full_age'] != '') {
            $emp_full_age = $duty_data[0]['emp_full_age'];
            $this->assign('emp_full_age', $emp_full_age);
        }

        if($duty_data[0]['emp_bank_name'] != '') {
            $emp_bank_name = $duty_data[0]['emp_bank_name'];
            $this->assign('emp_bank_name', $emp_bank_name);
        }

        if($duty_data[0]['emp_sociaty_insu'] != '') {
            $emp_sociaty_insu = $duty_data[0]['emp_sociaty_insu'];
            $this->assign('emp_sociaty_insu', $emp_sociaty_insu);
        }

        if($duty_data[0]['emp_lostjob_insu'] != '') {
            $emp_lostjob_insu = $duty_data[0]['emp_lostjob_insu'];
            $this->assign('emp_lostjob_insu', $emp_lostjob_insu);
        }

        if($duty_data[0]['emp_old_insu'] != '') {
            $emp_old_insu = $duty_data[0]['emp_old_insu'];
            $this->assign('emp_old_insu', $emp_old_insu);
        }

        if($duty_data[0]['emp_bank_num'] != '') {
            $emp_bank_num = $duty_data[0]['emp_bank_num'];
            $this->assign('emp_bank_num', $emp_bank_num);
        }

        if($duty_data[0]['emp_medical_insu'] != '') {
            $emp_medical_insu = $duty_data[0]['emp_medical_insu'];
            $this->assign('emp_medical_insu', $emp_medical_insu);
        }

        if($duty_data[0]['emp_hurt_insu'] != '') {
            $emp_hurt_insu = $duty_data[0]['emp_hurt_insu'];
            $this->assign('emp_hurt_insu', $emp_hurt_insu);
        }

        if($duty_data[0]['emp_reseverd_fund'] != '') {
            $emp_reseverd_fund = $duty_data[0]['emp_reseverd_fund'];
            $this->assign('emp_reseverd_fund', $emp_reseverd_fund);
        }

    	$this->display('show');
    }

    public function edit() {
        if($_POST['id'] != '') {
            $_SESSION['newFileId'] = $_POST['id'];
        }
        if($_SESSION['newFileId'] != '') {
            $id = $_SESSION['newFileId'];
            $this->assign('id', $id);
        }
        $personal_info = M('personal_info');
        $person_data = $personal_info->where('id='.$id)->select();
        $duty_info = M('duty_info');
        $duty_data = $duty_info->where('id='.$id)->select();

        if($person_data[0]['fm_num'] != '') {
            $fm_num = $person_data[0]['fm_num'];
            $this->assign('fm_num', $fm_num);
        }

        if($person_data[0]['emp_name'] != '') {
            $emp_name = $person_data[0]['emp_name'];
            $this->assign('emp_name', $emp_name);
        }

        if($person_data[0]['emp_sex'] != '') {
            if($person_data[0]['emp_sex'] == '男') {
                $emp_sex_male = 'checked';
                $emp_sex_female = '';
                $this->assign('emp_sex_male', $emp_sex_male);
                $this->assign('emp_sex_female', $emp_sex_female);
            } else {
                $emp_sex_male = '';
                $emp_sex_female = 'checked';
                $this->assign('emp_sex_male', $emp_sex_male);
                $this->assign('emp_sex_female', $emp_sex_female);
            }
        }

        if($person_data[0]['emp_borndate'] != '') {
            $emp_borndate = $person_data[0]['emp_borndate'];
            $this->assign('emp_borndate', $emp_borndate);
        }

        if($person_data[0]['emp_folk'] != '') {
            $emp_folk = $person_data[0]['emp_folk'];
            $this->assign('emp_folk', $emp_folk);
        }

        if($person_data[0]['emp_native'] != '') {
            $emp_native = $person_data[0]['emp_native'];
            $this->assign('emp_native', $emp_native);
        }

        if($person_data[0]['emp_idnum'] != '') {
            $emp_idnum = $person_data[0]['emp_idnum'];
            $this->assign('emp_idnum', $emp_idnum);
        }

        if($person_data[0]['emp_edu'] != '') {
            $emp_edu = $person_data[0]['emp_edu'];
            $this->assign('emp_edu', $emp_edu);
        }

        if($person_data[0]['emp_gra_school'] != '') {
            $emp_gra_school = $person_data[0]['emp_gra_school'];
            $this->assign('emp_gra_school', $emp_gra_school);
        }

        if($person_data[0]['emp_gra_date'] != '') {
            $emp_gra_date = $person_data[0]['emp_gra_date'];
            $this->assign('emp_gra_date', $emp_gra_date);
        }

        if($person_data[0]['emp_politics'] != '') {
            if($person_data[0]['emp_politics'] == '党员') {
                $emp_politics_dangyuan = 'checked';
                $emp_politics_qunzhong = '';
                $this->assign('emp_politics_dangyuan', $emp_politics_dangyuan);
                $this->assign('emp_politics_qunzhong', $emp_politics_qunzhong);
            } else {
                $emp_politics_dangyuan = '';
                $emp_politics_qunzhong = 'checked';
                $this->assign('emp_politics_dangyuan', $emp_politics_dangyuan);
                $this->assign('emp_politics_qunzhong', $emp_politics_qunzhong);
            }
        }

        if($person_data[0]['emp_marriage'] != '') {
            if($person_data[0]['emp_marriage'] == '已婚') {
                $emp_marriage_married = 'checked';
                $emp_marriage_unmarried = '';
                $this->assign('emp_marriage_married', $emp_marriage_married);
                $this->assign('emp_marriage_unmarried', $emp_marriage_unmarried);
            } else {
                $emp_marriage_married = '';
                $emp_marriage_unmarried = 'checked';
                $this->assign('emp_marriage_married', $emp_marriage_married);
                $this->assign('emp_marriage_unmarried', $emp_marriage_unmarried);
            }
        }

        if($person_data[0]['emp_postcode'] != '') {
            $emp_postcode = $person_data[0]['emp_postcode'];
            $this->assign('emp_postcode', $emp_postcode);
        }

        if($person_data[0]['emp_phone'] != '') {
            $emp_phone = $person_data[0]['emp_phone'];
            $this->assign('emp_phone', $emp_phone);
        }

        if($person_data[0]['emp_qq'] != '') {
            $emp_qq = $person_data[0]['emp_qq'];
            $this->assign('emp_qq', $emp_qq);
        }

        if($person_data[0]['emp_email'] != '') {
            $emp_email = $person_data[0]['emp_email'];
            $this->assign('emp_email', $emp_email);
        }

        if($person_data[0]['emp_addr'] != '') {
            $emp_addr = $person_data[0]['emp_addr'];
            $this->assign('emp_addr', $emp_addr);
        }

        if($duty_data[0]['emp_department'] != '') {
            $emp_department = $duty_data[0]['emp_department'];
            $this->assign('emp_department', $emp_department);
        }

        if($duty_data[0]['emp_job'] != '') {
            $emp_job = $duty_data[0]['emp_job'];
            $this->assign('emp_job', $emp_job);
        }

        if($duty_data[0]['emp_entry_date'] != '') {
            $emp_entry_date = $duty_data[0]['emp_entry_date'];
            $this->assign('emp_entry_date', $emp_entry_date);
        }

        if($duty_data[0]['emp_use_form'] != '') {
            $emp_use_form = $duty_data[0]['emp_use_form'];
            $this->assign('emp_use_form', $emp_use_form);
        }

        if($duty_data[0]['emp_exit_date'] != '') {
            $emp_exit_date = $duty_data[0]['emp_exit_date'];
            $this->assign('emp_exit_date', $emp_exit_date);
        }

        if($duty_data[0]['emp_exit_reason'] != '') {
            $emp_exit_reason = $duty_data[0]['emp_exit_reason'];
            $this->assign('emp_exit_reason', $emp_exit_reason);
        }

        if($duty_data[0]['emp_cont_start'] != '') {
            $emp_cont_start = $duty_data[0]['emp_cont_start'];
            $this->assign('emp_cont_start', $emp_cont_start);
        }

        if($duty_data[0]['emp_cont_end'] != '') {
            $emp_cont_end = $duty_data[0]['emp_cont_end'];
            $this->assign('emp_cont_end', $emp_cont_end);
        }

        if($duty_data[0]['emp_full_date'] != '') {
            $emp_full_date = $duty_data[0]['emp_full_date'];
            $this->assign('emp_full_date', $emp_full_date);
        }

        if($duty_data[0]['emp_full_age'] != '') {
            $emp_full_age = $duty_data[0]['emp_full_age'];
            $this->assign('emp_full_age', $emp_full_age);
        }

        if($duty_data[0]['emp_bank_name'] != '') {
            $emp_bank_name = $duty_data[0]['emp_bank_name'];
            $this->assign('emp_bank_name', $emp_bank_name);
        }

        if($duty_data[0]['emp_sociaty_insu'] != '') {
            $emp_sociaty_insu = $duty_data[0]['emp_sociaty_insu'];
            $this->assign('emp_sociaty_insu', $emp_sociaty_insu);
        }

        if($duty_data[0]['emp_lostjob_insu'] != '') {
            $emp_lostjob_insu = $duty_data[0]['emp_lostjob_insu'];
            $this->assign('emp_lostjob_insu', $emp_lostjob_insu);
        }

        if($duty_data[0]['emp_old_insu'] != '') {
            $emp_old_insu = $duty_data[0]['emp_old_insu'];
            $this->assign('emp_old_insu', $emp_old_insu);
        }

        if($duty_data[0]['emp_bank_num'] != '') {
            $emp_bank_num = $duty_data[0]['emp_bank_num'];
            $this->assign('emp_bank_num', $emp_bank_num);
        }

        if($duty_data[0]['emp_medical_insu'] != '') {
            $emp_medical_insu = $duty_data[0]['emp_medical_insu'];
            $this->assign('emp_medical_insu', $emp_medical_insu);
        }

        if($duty_data[0]['emp_hurt_insu'] != '') {
            $emp_hurt_insu = $duty_data[0]['emp_hurt_insu'];
            $this->assign('emp_hurt_insu', $emp_hurt_insu);
        }

        if($duty_data[0]['emp_reseverd_fund'] != '') {
            $emp_reseverd_fund = $duty_data[0]['emp_reseverd_fund'];
            $this->assign('emp_reseverd_fund', $emp_reseverd_fund);
        }

        $this->display('edit');
    }

    public function BaseInfo_save() {
        $personal_info = M('personal_info');
        $personal_info->create();
        $res = $personal_info->add();
        $duty_info = M('duty_info');
        $duty_info->create();
        $res2 = $duty_info->add();
        session_start();
        $_SESSION['newFileId'] = $_POST['id'];
        if($res&&$res2) {
            $this->success('新建档案成功!', 'show');
        }
    }

    public function BaseInfo_edit() {
        if($_POST['id'] != '') {
            $_SESSION['newFileId'] = $_POST['id'];
        }
        if($_SESSION['newFileId'] != '') {
            $id = $_SESSION['newFileId'];
            $this->assign('id', $id);
        }
        $personal_info = M('personal_info');
        $personal_info->where('id='.$id)->delete();
        $duty_info = M('duty_info');
        $duty_info->where('id='.$id)->delete();
        $personal_info->create();
        $res = $personal_info->add();
        $duty_info->create();
        $res2 = $duty_info->add();
        session_start();
        $_SESSION['newFileId'] = $_POST['id'];
        if($res&&$res2) {
            $this->success('修改档案成功!', 'show');
        }
    }

    public function BaseInfo_delete() {
        $id = $_POST['id'];
        $personal_info = M('personal_info');
        $res = $personal_info->where('id='.$id)->delete();
        $duty_info = M('duty_info');
        $res2 = $duty_info->where('id='.$id)->delete();
        unset($_SESSION['newFileId']);
        if($res&&$res2) {
            $this->success('删除档案成功!', 'check');
        }
    }

}