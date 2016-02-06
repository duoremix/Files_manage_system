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
						<li><a href="#">绩效档案管理</a></li>
						<li><a href="/Files_manage_system/Admin/Performance/train_check">培训档案管理</a></li>
						<li>查看档案</li>
					</ul>
				</div>
				<div>
					<form action="/Files_manage_system/Admin/Performance/train_save" method="post" id="form_train">
						<div class="single-row">
							<a id="edit" href="train_edit" class="btn btn-primary super">修改档案</a>
							<a id="delete" class="btn btn-danger super">删除档案</a>
							<a id="cancel" class="btn btn-default" href="train_check">返回</a>
						</div>
						<div class="single-row">
							<input type="hidden" name="id" value="<?php echo ($id); ?>">
							<input type="hidden" name="fm_num" value="<?php echo ($fm_num); ?>">
							<label>
								<span>培训名称：</span>
								<input type="text" name="train_name" class="middle" value="<?php echo ($train_name); ?>" readonly>
							</label>
							<label>
								<span>培训内容：</span>
								<input type="text" name="train_content" class="long" value="<?php echo ($train_content); ?>" readonly>
							</label>
						</div>
						<div class="single-row">
							<label>
								<span>培训单位：</span>
								<input type="text" name="train_unit" class="middle" value="<?php echo ($train_unit); ?>" readonly>
							</label>
							<label>
								<span>培训讲师：</span>
								<input type="text" name="train_lecture" class="short" value="<?php echo ($train_lecture); ?>" readonly>
							</label>
							<label>
								<span>培训地点：</span>
								<input type="text" name="train_place" class="long" value="<?php echo ($train_place); ?>" readonly>
							</label>
						</div>
						<div class="single-row">
							<label>
								<span>开始日期：</span>
								<input type="text" name="train_start_date" class="short datepick" value="<?php echo ($train_start_date); ?>" readonly>
							</label>
							<label>
								<span>结束日期：</span>
								<input type="text" name="train_end_date" class="short datepick" value="<?php echo ($train_end_date); ?>" readonly>
							</label>
						</div>
					</form>
					<p class="form-title">参训人员：</p>
					<div class="table_scroll short">
						<?php echo ($infoData); ?>
					</div>
					<!-- <table class="table table-striped">
						<tr>
							<td>档案编号</td>
							<td>姓名</td>
							<td>性别</td>
							<td>部门</td>
							<td>职务</td>
						</tr>
						<tr>
							<td>J00001</td>
							<td>刘汝佳</td>
							<td>男</td>
							<td>Java项目组</td>
							<td>Java工程师</td>
						</tr>
						<tr>
							<td>J00002</td>
							<td>刘汝剑</td>
							<td>男</td>
							<td>Java项目组</td>
							<td>Java工程师</td>
						</tr>
						<tr>
							<td>J00003</td>
							<td>刘汝城</td>
							<td>男</td>
							<td>Java项目组</td>
							<td>Java工程师</td>
						</tr>
						<tr>
							<td>J00004</td>
							<td>刘汝楚</td>
							<td>男</td>
							<td>Java项目组</td>
							<td>Java工程师</td>
						</tr>
					</table> -->
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
			main_nav.init();
			train_save.init();
			train_delete.init();
		}
	</script>
</body>
</html>