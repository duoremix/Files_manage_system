<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>企业档案管理系统</title>
	<link rel="shortcut icon" href="/Files_manage_system/Public/image/icon.png">
	<link rel="stylesheet" href="/Files_manage_system/Public/css/style.css">
</head>
<body class="container">
	<section>
		<div class="container">
			<div class="nav-wrapper">
				<div class="logo">
					<a href="/Files_manage_system/Admin/Index"><img src="/Files_manage_system/Public/image/logo2.png"></a>
				</div>
				<div class="user-wrapper">
					<div id="username">欢迎您，<a href="#"><?php echo ($_SESSION['username']); ?></a></div>
					<div id="exit"><a href="/Files_manage_system">退出登录</a></div>
				</div>
				<ul class="nav">
					<li class="dropdown">
						<a href="#" class="level1">基本档案管理</a>
						<ul class="dropdown-menu">
							<li class="super">
								<a href="/Files_manage_system/Admin/BaseInfo/create">新建档案</a>
							</li>
							<li>
								<a href="/Files_manage_system/Admin/BaseInfo/check">查看档案</a>
							</li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="level1">绩效档案管理</a>
						<ul class="dropdown-menu">
							<li>
								<a href="/Files_manage_system/Admin/Performance/attendence_check">考勤档案管理</a>
							</li>
							<li>
								<a href="/Files_manage_system/Admin/Performance/rnp_check">奖惩档案管理</a>
							</li>
							<li>
								<a href="/Files_manage_system/Admin/Performance/train_check">培训档案管理</a>
							</li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="level1">工资等级管理</a>
						<ul class="dropdown-menu">
							<li class="super">
								<a href="/Files_manage_system/Admin/Salary/account_setting">账套档案管理</a>
							</li>
							<li class="super">
								<a href="/Files_manage_system/Admin/Salary/salary_setting">人员设置</a>
							</li>
							<li>
								<a href="/Files_manage_system/Admin/Salary/statistic">统计报表</a>
							</li>
						</ul>
					</li>
					<li class="dropdown super">
						<a href="#" class="level1">系统维护</a>
						<ul class="dropdown-menu">
							<li>
								<a href="/Files_manage_system/Admin/System/company_frame">企业架构设置</a>
							</li>
							<li>
								<a href="/Files_manage_system/Admin/System/basedata_setting">基本资料设置</a>
							</li>
							<li>
								<a href="/Files_manage_system/Admin/System/system_init">初始化系统</a>
							</li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="level1">用户管理</a>
						<ul class="dropdown-menu">
							<li class="super">
								<a href="/Files_manage_system/Admin/User/user_add">新增用户</a>
							</li>
							<li>
								<a href="/Files_manage_system/Admin/User/password_edit">修改密码</a>
							</li>
						</ul>
					</li>
				</ul>
			</div>
			<div class="content">
				<div class="single-row">
					<ul class="mybreadcrumb">
						<li><a href="/Files_manage_system/Admin/Index">主页</a></li>
						<li><a href="/Files_manage_system/Admin/Performance/attendence_check">绩效档案管理</a></li>
						<li><a href="/Files_manage_system/Admin/Performance/attendence_check">奖惩档案管理</a></li>
						<li>修改档案</li>
					</ul>
				</div>
				<div>
					<form action="/Files_manage_system/Admin/Performance/rnp_edit_save" method="post" id="form_rnp">
						<div class="single-row">
							<a id="save" class="btn btn-primary super">保存</a>
							<a id="cancel" class="btn btn-default" href="#">取消</a>
						</div>
						<div class="single-row">
							<input type="hidden" name="id" id="id" value="<?php echo ($id); ?>">
							<input type="hidden" name="fm_num" id="fm_num" value="<?php echo ($fm_num); ?>">
							<label>
								<span>部门：</span>
								<select name="department" id="department">
									<option value="<?php echo ($department); ?>"><?php echo ($department); ?></option>
									<!-- <option value="Java项目组">Java项目组</option>
									<option value="Php项目组">Php项目组</option>
									<option value="IOS项目组">IOS项目组</option> -->
								</select>
							</label>
							<label>
								<span>员工：</span>
								<select name="employee" id="employee">
									<option value="<?php echo ($employee); ?>"><?php echo ($employee); ?></option>
									<!-- <option value="刘汝佳">刘汝佳</option>
									<option value="刘汝剑">刘汝剑</option>
									<option value="刘汝城">刘汝城</option> -->
								</select>
							</label>
							<label>
								<span>员工编号：</span>
								<input type="text" name="emp_id" class="short" style="width:50px;" value="<?php echo ($emp_id); ?>" readonly>
							</label>
						</div>
						<div class="single-row">
							<label>
								<span>奖惩状况：</span>
								<label class="normal">
									<span>奖励</span>
									<input type="radio" name="rnp_status" value="奖励" <?php echo ($rnp_reward); ?> onclick="return false">
								</label>
								<label class="normal">
									<span>惩罚</span>
									<input type="radio" name="rnp_status" value="惩罚" <?php echo ($rnp_punish); ?> onclick="return false">
								</label>
							</label>
							<label>
								<span>奖惩类型：</span>
								<select name="rnp_type" id="rnp_type">
									<option value="工资">工资</option>
									<option value="月奖金">月奖金</option>
									<option value="年终奖">年终奖</option>
									<option value="其他">其他</option>
								</select>
							</label>
							<label>
								<span>金额：</span>
								<input type="number" name="rnp_money" class="short" placeholder="0.00" value="<?php echo ($rnp_money); ?>">
							</label>
						</div>
						<div class="single-row">
							<label>
								<span>原因：</span>
								<input type="text" name="rnp_reason" class="short" value="<?php echo ($rnp_reason); ?>">
							</label>
							<label>
								<span>落实日期：</span>
								<input type="text" name="rnp_date" class="short datepick" value="<?php echo ($rnp_date); ?>" placeholder="YYYY-M-d">
							</label>
						</div>
						<div class="single-row">
							<label>
								<span>审批人：</span>
								<input type="text" name="manage_person" class="short" value="<?php echo ($manage_person); ?>">
							</label>
							<label>
								<span>审批日期：</span>
								<input type="text" name="manage_date" class="short datepick" value="<?php echo ($manage_date); ?>" placeholder="YYYY-M-d">
							</label>
						</div>
						<div class="single-row">
							<label>
								<span style="float:left">具体内容：</span>
								<textarea name="rnp_content" id="attendence_content" cols="40" rows="10" style="margin-left:5px;padding:5px;"><?php echo ($rnp_content); ?></textarea>
							</label>
						</div>
					</form>
					<div id="init_data">
						<?php echo ($employee_data_str); ?>
					</div>
					<div>
						<input type="hidden" id="hidden_rnp_type" value="<?php echo ($rnp_type); ?>">
						<input type="hidden" id="emp_data" value="<?php echo ($emp_data_str); ?>">
						<input type="hidden" id="hidden_emp_id" value="<?php echo ($emp_id); ?>">
					</div>
				</div>
				<input id="user_type" type="hidden" value="<?php echo ($usertype); ?>">
			</div>
		</div>
	</section>

	<script src="/Files_manage_system/Public/js/jquery.js"></script>
	<script src="/Files_manage_system/Public/js/jquery-ui.js"></script>
	<script src="/Files_manage_system/Public/js/script.js"></script>
	<script>
		window.onload = function() {
			$(".datepick").datepicker({
				dateFormat: "yy-mm-dd"
			});
			main_nav.init();
			department_initData.init();
			rnp_cancel.init();
			rnp_save.init();
			if($('input#hidden_rnp_type').val() != '') {
				$('select#rnp_type').val($('input#hidden_rnp_type').val());
			}
			$('input#hidden_rnp_type').remove();
			if($('input[name=rnp_status]:checked').val() == '奖励') {
				$('select#rnp_type').html('<option value="其他">其他</option>');
			}
		}
	</script>
</body>
</html>