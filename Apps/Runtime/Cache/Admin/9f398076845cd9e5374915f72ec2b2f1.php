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
					<li class="dropdown">
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
					<li class="dropdown super">
						<a href="#" class="level1">系统维护</a>
						<ul class="dropdown-menu">
							<li>
								<a href="/Admin/System/company_frame">企业部门设置</a>
							</li>
							<li>
								<a href="/Admin/System/basedata_setting">基本资料设置</a>
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
						<li>系统维护</li>
						<li>初始化系统</li>
					</ul>
				</div>
				<div class="single-row super">
					<form id="system_init">
						<div class="form-field">
							<input id="password" type="password" name="password" placeholder="请输入初始化密码">
						</div>
						<div class="form-field">
							<a id="submit" class="system_init" href="#">初始化系统</a>
						</div>
					</form>
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
			basedata_setting.init();
			system_init.init();
		}
	</script>
</body>
</html>