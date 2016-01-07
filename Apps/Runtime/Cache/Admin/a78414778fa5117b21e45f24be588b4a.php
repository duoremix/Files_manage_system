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
			<div class="content">
				<div class="single-row">
					<ul class="mybreadcrumb">
						<li><a href="/Files_manage_system/Admin/Index">主页</a></li>
						<li>基本档案管理</li>
						<li>查看档案</li>
					</ul>
				</div>
				<div>
					<div class="single-row">
						<button class="btn btn-primary" href="/Files_manage_system/Admin/BaseInfo/create">修改档案</button>
						<button class="btn btn-danger">删除档案</button>
					</div>
					<form action="/Files_manage_system/Admin/BaseInfo/editInfo" method="post">
						<div id="emp_photo">
							<img src="/Files_manage_system/Public/image/lin.jpeg" alt="">
						</div>
						<div class="single-row">
							<label>
								<span>档案编号：</span>
								<input type="text" name="fm_num" class="short">
							</label>
						</div>
						<div class="single-row">
							<p class="form-title">个人信息</p>
							<div class="single-row">
								<label>
									<span>姓名：</span>
									<input type="text" name="emp_name" class="short">
								</label>
								<span>性别：</span>
								<label>
									<span>男</span>
									<input type="radio" name="emp_sex" value="男">
								</label>
								<label>
									<span>女</span>
									<input type="radio" name="emp_sex" value="女">
								</label>
								<label>
									<span>出生日期：</span>
									<input type="text" name="emp_borndate" class="short datepick">
								</label>
							</div>
							<div class="single-row">
								<label>
									<span>民族：</span>
									<select name="emp_folk" id="emp_folk">
										<option value="汉族">汉族</option>
										<option value="瑶族">瑶族</option>
										<option value="回族">回族</option>
										<option value="乌孜别克族">乌孜别克族</option>
									</select>
								</label>
								<label>
									<span>籍贯：</span>
									<select name="emp_native" id="emp_native">
										<option value="广东">广东</option>
										<option value="上海">上海</option>
										<option value="浙江">浙江</option>
										<option value="吉林">吉林</option>
									</select>
								</label>
								<label>
									<span>身份证号：</span>
									<input type="text" name="emp_idnum" class="middle">
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
									<input type="text" name="emp_gra_school" class="short">
								</label>
								<label>
									<span>毕业日期：</span>
									<input type="text" name="emp_gra__date" class="short datepick">
								</label>
							</div>
							<div class="single-row">
								<span>政治面貌：</span>
								<label>
									<label>
										<span>党员</span>
										<input type="radio" name="emp_politics" value="党员">
									</label>
									<label>
										<span>群众</span>
										<input type="radio" name="emp_politics" value="群众">
									</label>
								</label>
								<span>婚姻状况：</span>
								<label>
									<label>
										<span>未婚</span>
										<input type="radio" name="emp_marriage" value="未婚">
									</label>
									<label>
										<span>已婚</span>
										<input type="radio" name="emp_marriage" value="已婚">
									</label>
								</label>
								<label>
									<span>邮政编码：</span>
									<input type="text" name="emp_postcode" class="short">
								</label>
							</div>
							<div class="single-row">
								<label>
									<span>电话号码：</span>
									<input type="text" name="emp_phone" class="short">
								</label>
								<label>
									<span>QQ：</span>
									<input type="text" name="emp_qq" class="short">
								</label>
								<label>
									<span>电子邮箱：</span>
									<input type="text" name="emp_email" class="middle">
								</label>
							</div>
							<div class="single-row">
								<label>
									<span>家庭住址：</span>
									<input type="text" name="emp_addr" class="longer">
								</label>
							</div>
						</div>
						<div class="single-row">
							<p class="form-title">职务信息</p>
							<div class="single-row">
								<label>
									<span>部门：</span>
									<select name="emp_department" id="emp_department">
										<option value="Java项目组">Java项目组</option>
										<option value="Php项目组">Php项目组</option>
										<option value="IOS项目组">IOS项目组</option>
									</select>
								</label>
								<label>
									<span>职务：</span>
									<input type="text" name="emp_job" class="short">
								</label>
							</div>
							<div class="single-row">
								<label>
									<span>入职时间：</span>
									<input type="text" name="emp_entry_date" class="short datepick">
								</label>
								<label>
									<span>用工形式：</span>
									<select name="emp_use_form" id="emp_use_form">
										<option value="实习">实习</option>
										<option value="兼职">兼职</option>
										<option value="全职">全职</option>
									</select>
								</label>
								<label>
									<span>离职时间：</span>
									<input type="text" name="emp_exit_date" class="short datepick">
								</label>
								<label>
									<span>离职原因：</span>
									<input type="text" name="emp_exit_reason" class="short">
								</label>
							</div>
							<div class="single-row">
								<label>
									<span>合同开始：</span>
									<input type="text" name="emp_cont_start" class="short datepick">
								</label>
								<label>
									<span>合同结束：</span>
									<input type="text" name="emp_cont_end" class="short datepick">
								</label>
								<label>
									<span>转正时间：</span>
									<input type="text" name="emp_full_date" class="short datepick">
								</label>
								<label>
									<span>转正工龄：</span>
									<input type="text" name="emp_full_age" class="short">
								</label>
							</div>
							<div class="single-row">
								<label>
									<span>发卡银行：</span>
									<input type="text" name="emp_bank" class="short">
								</label>
								<label>
									<span>社会保险：</span>
									<input type="text" name="emp_sociaty_insu" class="short">
								</label>
								<label>
									<span>失业保险：</span>
									<input type="text" name="emp_lostjob_insu" class="short">
								</label>
								<label>
									<span>养老保险：</span>
									<input type="text" name="emp_old_insu" class="short">
								</label>
							</div>
							<div class="single-row">
								<label>
									<span>信用卡号：</span>
									<input type="text" name="emp_card_num" class="short">
								</label>
								<label>
									<span>医疗保险：</span>
									<input type="text" name="emp_medical_insu" class="short">
								</label>
								<label>
									<span>工伤保险：</span>
									<input type="text" name="emp_hurt_insu" class="short">
								</label>
								<label>
									<span>公积金号：</span>
									<input type="text" name="emp_reseverd_fund" class="short">
								</label>
							</div>
						</div>
					</form>
				</div>
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
		}
	</script>
</body>
</html>