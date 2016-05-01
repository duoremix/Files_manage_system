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
						<li><a href="/Files_manage_system/Admin/Performance/attendence_check">绩效档案管理</a></li>
						<li><a href="/Files_manage_system/Admin/Performance/attendence_check">考勤档案管理</a></li>
						<li><?php echo ($emp_name); ?>的考勤档案</li>
					</ul>
				</div>
				<div class="single-row">
					<a class="btn btn-primary super" href="attendence_create">新建档案</a>
					<a class="btn btn-primary employee" href="/Files_manage_system/Admin/Performance/attendence_create">申请请假</a>
					<a class="btn btn-default super" href="attendence_check">返回</a>
				</div>
				<p class="form-title"><?php echo ($emp_name); ?>的考勤档案</p>
				<div class="employee">
					<ul class="choose-tab">
						<li class="active"><a href="#">考勤档案</a></li>
						<li><a href="#">近三条假条</a></li>
					</ul>
					<div style="clear:both"></div>
				</div>
				<div class="single-row tab-container">
					<div class="single-row tab">
						<div class="single-row">
							<div class="table_scroll long">
								<?php echo ($infoData); ?>
							</div>
							<!-- <table class="table table-striped">
								<tr>
									<td>档案编号</td>
									<td>考勤状况</td>
									<td>原因</td>
									<td>开始日期</td>
									<td>结束日期</td>
									<td>审批人</td>
									<td>审批日期</td>
									<td>操作</td>
								</tr>
								<tr>
									<td>J30001</td>
									<td>迟到</td>
									<td>无</td>
									<td>2016-01-07</td>	
									<td>2016-01-07</td>	
									<td>郭富城</td>
									<td>2016-01-07</td>
									<td>
										<a href="/Files_manage_system/Admin/Performance/attendence_show">查看详细</a>
										<a href="">删除</a>
									</td>
								</tr>
								<tr>
									<td>J30001</td>
									<td>请假</td>
									<td>病假</td>
									<td>2016-01-08</td>	
									<td>2016-01-08</td>
									<td>郭富城</td>
									<td>2016-01-08</td>
									<td>
										<a href="show">查看详细</a>
										<a href="">删除</a>
									</td>
								</tr>
							</table> -->
						</div>
					</div>
					<div class="single-row tab" style="display:none">
						<div class="single-row">
							<div class="table_scroll long">
								<?php echo ($uncheck_data_str); ?>
							</div>
						</div>
					</div>
				</div>
				<input id="user_type" type="hidden" value="<?php echo ($usertype); ?>">
			</div>
		</div>
	</section>

	<script src="/Files_manage_system/Public/js/jquery.js"></script>
	<script src="/Files_manage_system/Public/js/script.js"></script>
	<script>
		window.onload = function() {
			main_nav.init();
			attendence_list_operation.init();
			attendence_list.init();
			if($('#user_type').val() == '超级管理员') {
				$('ul.choose-tab').parent().remove();
				$('.tab-container').removeClass('tab-container');
				$('.tab').eq(1).remove();
			} else {
				$('ul.choose-tab li a').on('click', function(event) {
					$(this).parent().parent().find('.active').removeClass('active');
					$(this).parent().addClass('active');
					$('.tab').hide();
					$('.tab').eq($(this).parent().index()).show();
				});
			}
		}
	</script>
</body>
</html>