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
								<a href="/Files_manage_system/Admin/Salary/salary_setting">工资内容管理</a>
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
								<a href="/Files_manage_system/Admin/System/company_frame">企业部门设置</a>
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
								<a href="/Files_manage_system/Admin/User/user_add">新增管理员</a>
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
						<li>基本档案管理</li>
						<li>修改档案</li>
					</ul>
				</div>
				<div>
					<form action="/Files_manage_system/Admin/BaseInfo/baseInfo_edit" enctype="multipart/form-data" method="post" id="form_baseInfo">
						<div class="single-row">
							<a id="save" class="btn btn-primary super">保存</a>
							<a id="cancel" class="btn btn-default" href="check">取消</a>
						</div>
						<input type="hidden" name="id" value="<?php echo ($id); ?>">
						<div id="emp_photo">
							<input type="file" name="emp_photo">
							<div class="tips">点此上传图片</div>
							<img src="/Files_manage_system/Public/image/default.png" alt="">
						</div>
						<div class="single-row">
							<label>
								<span>档案编号：</span>
								<input type="text" name="fm_num" class="short" value="<?php echo ($fm_num); ?>" readonly>
							</label>
						</div>
						<div class="single-row">
							<p class="form-title">个人信息</p>
							<div class="single-row">
								<label>
									<span>姓名：</span>
									<input type="text" name="emp_name" class="short" value="<?php echo ($emp_name); ?>">
								</label>
								<label>
									<span>性别：</span>
									<label class="normal">
										<span>男</span>
										<input type="radio" name="emp_sex" value="男" <?php echo ($emp_sex_male); ?>>
									</label>
									<label class="normal">
										<span>女</span>
										<input type="radio" name="emp_sex" value="女" <?php echo ($emp_sex_female); ?>>
									</label>
								</label>
								<label>
									<span>出生日期：</span>
									<input type="text" name="emp_borndate" class="short datepick" placeholder="YYYY-M-d" value="<?php echo ($emp_borndate); ?>">
								</label>
							</div>
							<div class="single-row">
								<label>
									<span>民族：</span>
									<select name="emp_folk" id="emp_folk">
										<?php echo ($folk_data_str); ?>
									</select>
								</label>
								<label>
									<span>籍贯：</span>
									<select name="emp_native" id="emp_native">
										<?php echo ($native_data_str); ?>
									</select>
								</label>
								<label>
									<span>身份证号：</span>
									<input type="text" name="emp_idnum" class="middle" value="<?php echo ($emp_idnum); ?>">
								</label>
							</div>
							<div class="single-row">
								<label>
									<span>学历水平：</span>
									<select name="emp_edu" id="emp_edu">
										<option value="大专">大专</option>
										<option value="本科">本科</option>
										<option value="硕士">硕士</option>
										<option value="博士">博士</option>
									</select>
								</label>
								<label>
									<span>毕业学校：</span>
									<input type="text" name="emp_gra_school" class="short" value="<?php echo ($emp_gra_school); ?>">
								</label>
								<label>
									<span>毕业日期：</span>
									<input type="text" name="emp_gra_date" class="short datepick" placeholder="YYYY-M-d" value="<?php echo ($emp_gra_date); ?>">
								</label>
							</div>
							<div class="single-row">
								<label>
									<span>政治面貌：</span>
									<label class="normal">
										<span>党员</span>
										<input type="radio" name="emp_politics" value="党员" <?php echo ($emp_politics_dangyuan); ?>>
									</label>
									<label class="normal">
										<span>群众</span>
										<input type="radio" name="emp_politics" value="群众" <?php echo ($emp_politics_qunzhong); ?>>
									</label>
								</label>
								<label>
									<span>婚姻状况：</span>
									<label class="normal">
										<span>未婚</span>
										<input type="radio" name="emp_marriage" value="未婚" <?php echo ($emp_marriage_unmarried); ?>>
									</label>
									<label class="normal">
										<span>已婚</span>
										<input type="radio" name="emp_marriage" value="已婚" <?php echo ($emp_marriage_married); ?>>
									</label>
								</label>
								<label>
									<span>邮政编码：</span>
									<input type="text" name="emp_postcode" class="short" value="<?php echo ($emp_postcode); ?>">
								</label>
							</div>
							<div class="single-row">
								<label>
									<span>电话号码：</span>
									<input type="text" name="emp_phone" class="short" value="<?php echo ($emp_phone); ?>">
								</label>
								<label>
									<span>QQ：</span>
									<input type="text" name="emp_qq" class="short" value="<?php echo ($emp_qq); ?>">
								</label>
								<label>
									<span>电子邮箱：</span>
									<input type="text" name="emp_email" class="middle" placeholder="xx@xx.com" value="<?php echo ($emp_email); ?>">
								</label>
							</div>
							<div class="single-row">
								<label>
									<span>家庭住址：</span>
									<input type="text" name="emp_addr" class="longer" value="<?php echo ($emp_addr); ?>">
								</label>
							</div>
						</div>
						<div class="single-row">
							<p class="form-title">职务信息</p>
							<div class="single-row">
								<label>
									<span>部门：</span>
									<select name="emp_department" id="emp_department">
										<?php echo ($department_data_str); ?>
									</select>
								</label>
								<label>
									<span>职务：</span>
									<input type="text" name="emp_job" class="short" value="<?php echo ($emp_job); ?>">
								</label>
							</div>
							<div class="single-row">
								<label>
									<span>入职时间：</span>
									<input type="text" name="emp_entry_date" class="short datepick" placeholder="YYYY-M-d" value="<?php echo ($emp_entry_date); ?>">
								</label>
								<label>
									<span>用工形式：</span>
									<select name="emp_use_form" id="emp_use_form">
										<?php echo ($use_form_str); ?>
									</select>
								</label>
								<label>
									<span>离职时间：</span>
									<input type="text" name="emp_exit_date" class="short datepick" value="<?php echo ($emp_exit_date); ?>" placeholder='YYYY-M-d 非必填'>
								</label>
								<label>
									<span>离职原因：</span>
									<input type="text" name="emp_exit_reason" class="short" value="<?php echo ($emp_exit_reason); ?>" placeholder='YYYY-M-d 非必填'>
								</label>
							</div>
							<div class="single-row">
								<label>
									<span>合同开始：</span>
									<input type="text" name="emp_cont_start" class="short datepick" placeholder="YYYY-M-d" value="<?php echo ($emp_cont_start); ?>">
								</label>
								<label>
									<span>合同结束：</span>
									<input type="text" name="emp_cont_end" class="short datepick" placeholder="YYYY-M-d" value="<?php echo ($emp_cont_end); ?>">
								</label>
								<label>
									<span>转正时间：</span>
									<input type="text" name="emp_full_date" class="short datepick" value="<?php echo ($emp_full_date); ?>" placeholder='YYYY-M-d 非必填'>
								</label>
								<label>
									<span>转正工龄：</span>
									<input type="text" name="emp_full_age" class="short" value="<?php echo ($emp_full_age); ?>" placeholder='非必填'>
								</label>
							</div>
							<div class="single-row">
								<label>
									<span>发卡银行：</span>
									<input type="text" name="emp_bank_name" class="short" value="<?php echo ($emp_bank_name); ?>" placeholder='非必填'>
								</label>
								<label>
									<span>社会保险：</span>
									<input type="text" name="emp_sociaty_insu" class="short" value="<?php echo ($emp_sociaty_insu); ?>" placeholder='非必填'>
								</label>
								<label>
									<span>失业保险：</span>
									<input type="text" name="emp_lostjob_insu" class="short" value="<?php echo ($emp_lostjob_insu); ?>" placeholder='非必填'>
								</label>
								<label>
									<span>养老保险：</span>
									<input type="text" name="emp_old_insu" class="short" value="<?php echo ($emp_old_insu); ?>" placeholder='非必填'>
								</label>
							</div>
							<div class="single-row">
								<label>
									<span>信用卡号：</span>
									<input type="text" name="emp_bank_num" class="short" value="<?php echo ($emp_bank_num); ?>" placeholder='非必填'>
								</label>
								<label>
									<span>医疗保险：</span>
									<input type="text" name="emp_medical_insu" class="short" value="<?php echo ($emp_medical_insu); ?>" placeholder='非必填'>
								</label>
								<label>
									<span>工伤保险：</span>
									<input type="text" name="emp_hurt_insu" class="short" value="<?php echo ($emp_hurt_insu); ?>" placeholder='非必填'>
								</label>
								<label>
									<span>公积金号：</span>
									<input type="text" name="emp_resevered_fund" class="short" value="<?php echo ($emp_resevered_fund); ?>" placeholder='非必填'>
								</label>
								<input type="hidden" name="have_photo" value="<?php echo ($have_photo); ?>">
							</div>
						</div>
					</form>
					<div>
						<input type="hidden" name="hidden_folk" id="hidden_folk" value="<?php echo ($emp_folk); ?>">
						<input type="hidden" name="hidden_native" id="hidden_native" value="<?php echo ($emp_native); ?>">
						<input type="hidden" name="hidden_edu" id="hidden_edu" value="<?php echo ($emp_edu); ?>">
						<input type="hidden" name="hidden_department" id="hidden_department" value="<?php echo ($emp_department); ?>">
						<input type="hidden" name="hidden_use_form" id="hidden_use_form" value="<?php echo ($emp_use_form); ?>">
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
			baseInfo_putin.init();
			baseInfo_save.init();
			$('input#user_type').remove();
		}
	</script>
</body>
</html>