<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>企业档案管理系统</title>
	<link rel="stylesheet" href="/Files_manage_system/Public/css/style.css">
	<link rel="shortcut icon" href="/Files_manage_system/Public/image/icon.png">
</head>
<body>
	<section>
		<div class="topbanner">
			<img src="/Files_manage_system/Public/image/logo.png">
			<!-- <h1>企业档案管理系统</h1> -->
		</div>
		<div class="form-unit">
			<form action="/Files_manage_system/Admin/User/redir_consultation" method="post">
				<div class="form-field">
					<select name="usertype" id="usertype">
						<option value="超级管理员">超级管理员</option>
						<option value="普通用户">普通用户</option>
					</select>
				</div>
				<div class="form-field">
					<input type="text" name="username" placeholder="用户名">
				</div>
				<div class="form-field">
					<input type="password" name="password" placeholder="密码">
				</div>
				<div class="form-field">
					<button type="submit">登录</button>
				</div>
			</form>
		</div>
	</section>

	<script src="/Files_manage_system/Public/js/jquery.js"></script>
	<script src="/Files_manage_system/Public/js/script.js"></script>
	<script>
		window.onload = function() {
			login.init();
		}
	</script>
</body>
</html>