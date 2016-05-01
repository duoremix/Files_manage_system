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
					<li class="dropdown">
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
						<li>系统维护</li>
						<li>企业部门设置</li>
					</ul>
				</div>
				<div class="single-row">
					<input id="new_department" type="text" class="short" placeholder="新添加的部门">
					<select name="superior_department" id="superior_department">
						<?php echo ($department_init); ?>
					</select>
					<a id="add" class="btn btn-primary">添加</a>
				</div>
				<div class="single-row">
					<div class="table_scroll long">
						<?php echo ($infoData); ?>
						<!-- <table class="table table-striped">
							<tr>
								<td>部门名称</td>
								<td>所属上级部门</td>
								<td>操作</td>
							</tr>
							<tr>
								<td>Java项目组</td>
								<td>
									<select name="" id="">
										<option value="Java项目组">Java项目组</option>
									</select>
								</td>
								<td>
									<a class="delete" href="#">删除</a>
								</td>
							</tr>
							<tr>
								<td>Php项目组</td>
								<td>
									<select name="" id="">
										<option value="Java项目组" checked>Java项目组</option>
										<option value="Php项目组">Php项目组</option>
									</select>
								</td>
								<td>
									<a class="delete" href="#">删除</a>
								</td>
							</tr>
							<tr>
								<td>IOS项目组</td>
								<td>
									<select name="" id="">
										<option value="IOS项目组">IOS项目组</option>
									</select>
								</td>
								<td>
									<a class="delete" href="#">删除</a>
								</td>
							</tr>
						</table> -->
					</div>
				</div>
				<div class="single-row">
					<a id="save" class="btn btn-primary" style="display:none">保存更改</a>
				</div>
				<input id="user_type" type="hidden" value="<?php echo ($_SESSION['usertype']); ?>">
			</div>
		</div>
	</section>

	<script src="/Files_manage_system/Public/js/jquery.js"></script>
	<script src="/Files_manage_system/Public/js/script.js"></script>
	<script>
		window.onload = function() {
			main_nav.init();
			company_frame.init();
		}
	</script>
</body>
</html>