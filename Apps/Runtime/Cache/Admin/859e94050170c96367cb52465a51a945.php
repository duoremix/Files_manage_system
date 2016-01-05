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
					<img src="/Files_manage_system/Public/image/logo2.png">
				</div>
				<div class="user-wrapper">
					<div id="username">欢迎您，<a href="#"><?php echo ($_SESSION['username']); ?></a></div>
					<div id="exit"><a href="/Files_manage_system">退出登录</a></div>
				</div>
				<ul class="nav">
					<li class="dropdown">
						<a href="#" class="level1">基本档案管理</a>
						<ul class="dropdown-menu">
							<li>
								<a href="">新建档案</a>
							</li>
							<li>
								<a href="">查看档案</a>
							</li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="level1">绩效档案管理</a>
						<ul class="dropdown-menu">
							<li>
								<a href="">考勤档案管理</a>
							</li>
							<li>
								<a href="">奖惩档案管理</a>
							</li>
							<li>
								<a href="">培训档案管理</a>
							</li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="level1">工资等级管理</a>
						<ul class="dropdown-menu">
							<li>
								<a href="">账套档案管理</a>
							</li>
							<li>
								<a href="">人员设置</a>
							</li>
							<li>
								<a href="">统计报表</a>
							</li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="level1">系统维护</a>
						<ul class="dropdown-menu">
							<li>
								<a href="">企业架构设置</a>
							</li>
							<li>
								<a href="">基本资料设置</a>
							</li>
							<li>
								<a href="">初始化系统</a>
							</li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="level1">用户管理</a>
						<ul class="dropdown-menu">
							<li>
								<a href="">新增用户</a>
							</li>
						</ul>
					</li>
				</ul>
			</div>
			<div class="welcome">
				欢迎使用<br>企业档案管理系统！
			</div>
		</div>
	</section>

	<script src="/Files_manage_system/Public/js/jquery.js"></script>
	<script src="/Files_manage_system/Public/js/script.js"></script>
	<script>
		window.onload = function() {
			main_nav.init();
		}
	</script>
</body>
</html>