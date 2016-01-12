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
							<li>
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
			<div class="content">
				<div class="single-row">
					<ul class="mybreadcrumb">
						<li><a href="/Files_manage_system/Admin/Index">主页</a></li>
						<li>绩效档案管理</li>
						<li>考勤档案管理</li>
					</ul>
				</div>
				<div class="single-row">
					<button class="btn btn-primary" onclick="window.location='/Files_manage_system/Admin/Performance/attendence_create'">新建档案</button>
				</div>
				<div class="single-row">
					<label>
						<span>选择部门：</span>
						<select name="department" id="department">
							<option value="全部">全部</option>
							<option value="Java项目组">Java项目组</option>
							<option value="Php项目组">Php项目组</option>
							<option value="IOS项目组">IOS项目组</option>
						</select>
					</label>
				</div>
				<div class="single-row">
					<?php echo ($infoData); ?>
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
								<a href="/Files_manage_system/Admin/Performance/attendence_list">查看考勤档案</a>
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
		</div>
	</section>

	<script src="/Files_manage_system/Public/js/jquery.js"></script>
	<script src="/Files_manage_system/Public/js/script.js"></script>
	<script>
		window.onload = function() {
			main_nav.init();
			attendence_list.init();
		}
	</script>
</body>
</html>