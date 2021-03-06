<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>企业档案管理系统</title>
	<link rel="shortcut icon" href="/Public/image/icon.png">
	<link rel="stylesheet" href="/Public/css/style.css">
</head>
<body class="container">
	<section>
		<div class="container">
			<div class="nav-wrapper">
				<div class="logo">
					<a href="/Admin/Index"><img src="/Public/image/logo2.png"></a>
				</div>
				<div class="user-wrapper">
					<div id="username">欢迎您，<a href="#"><?php echo ($_SESSION['username']); ?></a></div>
					<div id="exit"><a href="">退出登录</a></div>
				</div>
				<ul class="nav">
					<li class="dropdown">
						<a href="#" class="level1">基本档案管理</a>
						<ul class="dropdown-menu">
							<li class="super">
								<a href="/Admin/BaseInfo/create">新建档案</a>
							</li>
							<li>
								<a href="/Admin/BaseInfo/check">查看档案</a>
							</li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="level1">绩效档案管理</a>
						<ul class="dropdown-menu">
							<li>
								<a href="/Admin/Performance/attendence_check">考勤档案管理</a>
							</li>
							<li>
								<a href="/Admin/Performance/rnp_check">奖惩档案管理</a>
							</li>
							<li>
								<a href="/Admin/Performance/train_check">培训档案管理</a>
							</li>
						</ul>
					</li>
					<li class="dropdown super">
						<a href="#" class="level1">工资等级管理</a>
						<ul class="dropdown-menu">
							<li class="super">
								<a href="/Admin/Salary/account_setting">账套档案管理</a>
							</li>
							<li class="super">
								<a href="/Admin/Salary/salary_setting">工资内容管理</a>
							</li>
							<li>
								<a href="/Admin/Salary/statistic">统计报表</a>
							</li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="level1">系统维护</a>
						<ul class="dropdown-menu">
							<li class="super">
								<a href="/Admin/Salary/account_setting">企业部门设置</a>
							</li>
							<li class="super">
								<a href="/Admin/Salary/salary_setting">人员设置</a>
							</li>
							<li>
								<a href="/Admin/System/system_init">初始化系统</a>
							</li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="level1">用户管理</a>
						<ul class="dropdown-menu">
							<li class="super">
								<a href="/Admin/User/user_add">新增管理员</a>
							</li>
							<li>
								<a href="/Admin/User/password_edit">修改密码</a>
							</li>
						</ul>
					</li>
				</ul>
			</div>
			<div class="content">
				<div class="single-row">
					<ul class="mybreadcrumb">
						<li><a href="/Admin/Index">主页</a></li>
						<li>绩效档案管理</li>
						<li>考勤档案管理</li>
					</ul>
				</div>
				<div class="single-row">
					<a class="btn btn-primary super" href="/Admin/Performance/attendence_create">新建档案</a>
				</div>
				<div>
					<ul class="choose-tab">
						<li class="active"><a href="#">考勤档案</a></li>
						<li><a href="#">待审批假条</a></li>
					</ul>
					<div style="clear:both"></div>
				</div>
				<div class="single-row tab-container">
					<div class="singl-row tab">
						<div class="single-row">
							<label>
								<span>选择部门：</span>
								<select name="department" id="department">
									<option value="全部">全部</option>
									<?php echo ($department_data_str); ?>
								</select>
							</label>
							<label>
								<input type="text" class="short
								" id="select_name" name="select_name" placeholder="输入姓名查询">
							</label>
						</div>
						<div class="single-row">
							<div class="table_scroll long">
								<?php echo ($infoData); ?>
							</div>
							<!-- <table class="table table-striped">
								<tr>
									<td>档案编号</td>
									<td>姓名</td>
									<td>性别</td>
									<td>部门</td>
									<td>职务</td>
									<td>操作</td>
								</tr>
								<tr>
									<td>J00001</td>
									<td>刘汝佳</td>
									<td>男</td>
									<td>Java项目组</td>
									<td>Java工程师</td>
									<td>
										<a href="/Admin/Performance/attendence_list">查看考勤档案</a>
									</td>
								</tr>
								<tr>
									<td>J00002</td>
									<td>刘汝剑</td>
									<td>男</td>
									<td>Java项目组</td>
									<td>Java工程师</td>
									<td>
										<a href="">查看考勤档案</a>
									</td>
								</tr>
								<tr>
									<td>J00003</td>
									<td>刘汝城</td>
									<td>男</td>
									<td>Java项目组</td>
									<td>Java工程师</td>
									<td>
										<a href="">查看考勤档案</a>
									</td>
								</tr>
								<tr>
									<td>J00004</td>
									<td>刘汝楚</td>
									<td>男</td>
									<td>Java项目组</td>
									<td>Java工程师</td>
									<td>
										<a href="">查看考勤档案</a>
									</td>
								</tr>
							</table> -->
						</div>
					</div>
					<div class="single-row tab" style="display:none">
						<div class="single-row">
							<label>
								<span>选择部门：</span>
								<select name="department" id="department">
									<option value="全部">全部</option>
									<?php echo ($department_data_str); ?>
								</select>
							</label>
							<label>
								<input type="text" class="short
								" id="select_name" name="select_name" placeholder="输入姓名查询">
							</label>
						</div>
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

	<script src="/Public/js/jquery.js"></script>
	<script src="/Public/js/script.js"></script>
	<script>
		window.onload = function() {
			main_nav.init();
			attendence_check.init();
			attendence_list.init();
			attendence_list_operation.init();
			info_select.init();
			$('input#user_type').remove();
		}
	</script>
</body>
</html>