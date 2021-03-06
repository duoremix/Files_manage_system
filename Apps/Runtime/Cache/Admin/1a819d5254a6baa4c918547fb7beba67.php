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
						<li>工资等级管理</li>
						<li>工资内容管理</li>
					</ul>
				</div>
				<div class="single-row super">
					<a class="btn btn-primary edit" href="#">编辑</a>
				</div>
				<div class="single-row">
					<label>
						<span>部门：</span>
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
						<!-- <table class="table table-striped">
							<tr>
								<td>档案编号</td>
								<td>姓名</td>
								<td>性别</td>
								<td>部门</td>
								<td>职务</td>
								<td>工资/月</td>
							</tr>
							<tr>
								<td>B00001</td>
								<td>张学友</td>
								<td>男</td>
								<td>Java项目组</td>
								<td>歌手</td>
								<td>1000元</td>
								<td>
									<a class="use" href="#">使用</a>
									<a class="show" href="#">查看</a>
									<a class="delete" href="#">删除</a>
								</td>
							</tr>
						</table> -->
					</div>
				</div>
				<!-- <div class="single-row">
					<p class="form-title account-title">账套内容 尚未选定账套</p>
					<div class="single-row super">
						<a class="btn btn-primary project_add" href="#">添加项目</a>
					</div>
					<div class="table_scroll short">
						<?php echo ($infoData); ?>
						<table class="table table-striped">
							<tr>
								<td>编号</td>
								<td>项目名称</td>
								<td>项目单位</td>
								<td>项目类型</td>
								<td>金额</td>
								<td>操作</td>
							</tr>
							<tr>
								<td>1</td>
								<td>缺勤</td>
								<td>次</td>
								<td>扣除</td>
								<td>100元</td>
								<td>
									<a class="show" href="#">修改</a>
									<a class="delete" href="#">删除</a>
								</td>
							</tr>
							<tr>
								<td>2</td>
								<td>请假</td>
								<td>次</td>
								<td>扣除</td>
								<td>100元</td>
								<td>
									<a class="show" href="#">修改</a>
									<a class="delete" href="#">删除</a>
								</td>
							</tr>
							<tr>
								<td>3</td>
								<td>培训</td>
								<td>次</td>
								<td>发放</td>
								<td>1000元</td>
								<td>
									<a class="show" href="#">修改</a>
									<a class="delete" href="#">删除</a>
								</td>
							</tr>
						</table>
					</div>
					<div class="white-bg">
						<div class="float-content">
							<p class="form-title">请填写账套项目内容：</p>
							<div class="single-row"></div>
							<form id="project_add" action="project_add" method="post">
								<div class="single-row">
									<input type="hidden" id="account_id" name="account_id">
									<input type="hidden" id="project_id" name="project_id">
									<label>
										<span>项目名称：</span>
										<input type="text" class="short" name="project_name">
									</label>
									<label>
										<span>项目单位：</span>
										<select name="project_unit">
											<option value="次">次</option>
											<option value="天">天</option>
											<option value="月">月</option>
											<option value="季度">季度</option>
											<option value="年">年</option>
										</select>
									</label>
								</div>
								<div class="single-row"></div>
								<div class="single-row">
									<label>
										<span>项目类型：</span>
										<select name="project_type">
											<option value="扣除">扣除</option>
											<option value="发放">发放</option>
										</select>
									</label>
									<label>
										<span>金额：</span>
										<input type="number" class="short" name="project_money">
										<span>元</span>
									</label>
								</div>
								<div class="single-row"></div>
							</form>
							<a class="btn btn-primary project_add_confirm">保存</a>
							<a class="btn btn-default cancel">取消</a>
						</div>
					</div>
				</div> -->
				<input id="user_type" type="hidden" value="<?php echo ($usertype); ?>">
			</div>
		</div>
	</section>

	<script src="/Public/js/jquery.js"></script>
	<script src="/Public/js/script.js"></script>
	<script>
		window.onload = function() {
			main_nav.init();
			salary_setting.init();
			info_select.init();
		}
	</script>
</body>
</html>