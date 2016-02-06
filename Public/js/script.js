var main_nav = {
	init: function() {
		if($('#user_type').val() == '普通用户') {
			$('.super').remove();
		} else {
			$('.super').removeClass('super');
		}
		$('ul.nav li.dropdown').hover(function() {
			$('ul.dropdown-menu', this).stop().fadeIn(200);
		}, function() {
			$('ul.dropdown-menu', this).stop().fadeOut(200);
		});
	}
}

// 导航栏

var baseInfo_multiDelete = {
	init: function() {
		$flag = false;
		var $cancel = $('<span>&nbsp;</span><button class="btn btn-default cancel">取消</button>');
		$('.multi_delete').on('click', function(event) {
			if(!$flag) {
				$('table tr').each(function(index, el) {
					var $checkbox = $('<td><input type="checkbox"></td>');
					$checkbox.insertBefore($(this).find('td:eq(0)'));
				});
				$cancel.insertAfter($(this));
				$('input[type=checkbox]:eq(0)').on('click', function(event) {
					if($(this).prop('checked')) {
						$('input[type=checkbox]').each(function(index, el) {
							if(index != 0) {
								$(this).prop('checked', true);
							}
						});
					} else {
						$('input[type=checkbox]').each(function(index, el) {
							if(index != 0) {
								$(this).prop('checked', false);
							}
						});
					}
				});

				$('input[type=checkbox]').on('click', function(event) {
					if($(this).index('input[type=checkbox]') != 0) {
						if(!$(this).prop('checked')) {
							$('input[type=checkbox]:eq(0)').prop('checked', false);
						}
					}
				});

				$('.cancel').on('click', function(event) {
					$('table tr').each(function(index, el) {
						$(this).find('td:first-child').remove();
					});
					$(this).prev().remove();
					$(this).remove();
					$flag = false;
				});
				$flag = true;
			} else {
				if(confirm('确定要删除档案吗？')) {
					var $ids = [];
					$('input[type=checkbox]:checked').each(function(index, el) {
						if($(this).parents('tr').prop('id')) {
							$ids.push($(this).parents('tr').prop('id'));
						}
					});
					$.ajax({
						url: '../BaseInfo/BaseInfo_multiDelete',
						type: 'POST',
						data: {
							data: $ids
						},
						success: function(data) {
							console.log(data);
							alert('删除成功!');
							window.location = '../BaseInfo/check';
						}
					});
				}
			}
		});
	}
}

//批量删除功能

var baseInfo_save = {
	init: function() {
		$('#save').on('click', function(event) {
			$('#form_baseInfo').submit();
		});
	}
}

// 保存基本档案

var baseInfo_delete = {
	init: function() {
		$('#delete').on('click', function(event) {
			if(confirm('确定删除此档案吗？')) {
				$('#form_baseInfo').submit();
			}
		});
	}
}

//删除基本档案

var baseInfo_list_operation = {
	init: function() {
		$('a.show').on('click', function(event) {
			var id = $(this).parents('tr').prop('id');
			$.ajax({
				url: '../BaseInfo/show',
				type: 'POST',
				data: {
					id: id
				},
				success: function(data) {
					console.log('success');
					window.location = '../BaseInfo/show';
				}
			});
			
		});

		$('a.edit').on('click', function(event) {
			var id = $(this).parents('tr').prop('id');
			$.ajax({
				url: '../BaseInfo/edit',
				type: 'POST',
				data: {
					id: id
				},
				success: function(data) {
					console.log('success');
					window.location = '../BaseInfo/edit';
				}
			});
			
		});

		$('a.delete').on('click', function(event) {
			if(confirm('确定删除此档案吗？')) {
				var id = $(this).parents('tr').prop('id');
				$.ajax({
					url: '../BaseInfo/BaseInfo_delete',
					type: 'POST',
					data: {
						id: id
					},
					success: function(data) {
						console.log('success');
						window.location = '../BaseInfo/check';
					}
				});
			}
		});
	}
}

//列表上的操作的点击事件

var baseInfo_putin = {
	init: function() {
		$('select#emp_folk').val($('#hidden_folk').val());
		$('select#emp_native').val($('#hidden_native').val());
		$('select#emp_edu').val($('#hidden_edu').val());
		$('select#emp_department').val($('#hidden_department').val());
		$('select#emp_use_form').val($('#hidden_use_form').val());
	}
}

//基本档案中的select信息

var attendence_save = {
	init: function() {
		$('a#save').on('click', function(event) {
			$('#form_attendence').submit();
		});
	}
}

//保存考勤档案

var department_initData = {
	init: function() {
		if($('input#emp_data').val()) {
			var $data = $('input#emp_data').val().split(',');
			$('select#department').val($data[1]);
			var $index = $('select#department').find('option:checked').index();
			$('select#employee').html($('div#init_data>input[type=hidden]').eq($index).val());
			$('select#employee').val($data[0]);
		} else {
			$('select#employee').html($('div#init_data>input[type=hidden]').eq(0).val());
		}
		$('select#department').change(function(event) {
			var $index = $(this).find('option:checked').index();
			$('select#employee').html($('div#init_data>input[type=hidden]').eq($index).val());
			$('input[name=emp_id]').val('');
		});
	}
}

//初始化档案的部门和员工数据

var attendence_cancel = {
	init: function() {
		$('a#cancel').on('click', function(event) {
			var $id = $('input#hidden_emp_id').val();
			if($id) {
				window.location = 'attendence_list';
			} else {
				window.location = 'attendence_check';
			}
		});
	}
}

//考勤档案的取消按钮路径

var attendence_list = {
	init: function() {
		$('a.list').on('click', function(event) {
			$id = $(this).parents('tr').prop('id');
			$.ajax({
				url: '../Performance/attendence_list',
				type: 'POST',
				data: {
					id: $id
				},
				success: function(data) {
					console.log(data);
					window.location = '../Performance/attendence_list';
				}
			});			
		});
	}
}

//查看特定员工的考勤档案列表

var attendence_delete = {
	init: function() {
		$('a#delete').on('click', function(event) {
			if(confirm('确定要删除此档案吗？')) {
				$id = $('input#fileId').val();
				$.ajax({
					url: '../Performance/attendence_delete',
					type: 'POST',
					data: {
						id: $id
					},
					success: function(data) {
						console.log(data);
						alert('档案删除成功！');
						window.location = '../Performance/attendence_list';
					}
				});
			}
		});
	}
}

//删除考勤档案

var attendence_list_operation = {
	init: function() {
		$('a.show').on('click', function(event) {
			$id = $(this).parents('tr').prop('id');
			$.ajax({
				url: '../Performance/attendence_show',
				type: 'POST',
				data: {
					id: $id
				},
				success: function(data) {
					console.log(data);
					window.location = 'attendence_show';
				}
			});
		});

		$('a.edit').on('click', function(event) {
			$id = $(this).parents('tr').prop('id');
			$.ajax({
				url: '../Performance/attendence_edit',
				type: 'POST',
				data: {
					id: $id
				},
				success: function(data) {
					console.log(data);
					window.location = 'attendence_edit';
				}
			});
		});

		$('a.delete').on('click', function(event) {
			if(confirm('确定要删除此档案吗？')) {
				$id = $(this).parents('tr').prop('id');
				$.ajax({
					url: '../Performance/attendence_delete',
					type: 'POST',
					data: {
						id: $id
					},
					success: function(data) {
						console.log(data);
						alert('档案删除成功！');
						window.location = '../Performance/attendence_list';
					}
				});
			}
		});
	}
}

//考勤档案列表上的操作

var attendence_putin = {
	init: function() {
		$('select#attendence_status').val($('input#hidden_attendence_status').val());
	}
}

//考勤档案select数据的导入

var rnp_list = {
	init: function() {
		$('a.list').on('click', function(event) {
			$id = $(this).parents('tr').prop('id');
			$.ajax({
				url: '../Performance/rnp_list',
				type: 'POST',
				data: {
					id: $id
				},
				success: function(data) {
					console.log(data);
					window.location = '../Performance/rnp_list';
				}
			});			
		});
	}
}

//查看特定员工的奖惩档案

var rnp_list_operation = {
	init: function() {
		$('a.show').on('click', function(event) {
			$id = $(this).parents('tr').prop('id');
			$.ajax({
				url: '../Performance/rnp_show',
				type: 'POST',
				data: {
					id: $id
				},
				success: function(data) {
					console.log(data);
					window.location = 'rnp_show';
				}
			});
		});

		$('a.edit').on('click', function(event) {
			$id = $(this).parents('tr').prop('id');
			$.ajax({
				url: '../Performance/rnp_edit',
				type: 'POST',
				data: {
					id: $id
				},
				success: function(data) {
					console.log(data);
					window.location = 'rnp_edit';
				}
			});
		});

		$('a.delete').on('click', function(event) {
			if(confirm('确定要删除此档案吗？')) {
				$id = $(this).parents('tr').prop('id');
				$.ajax({
					url: '../Performance/rnp_delete',
					type: 'POST',
					data: {
						id: $id
					},
					success: function(data) {
						console.log(data);
						alert('档案删除成功！');
						window.location = '../Performance/rnp_list';
					}
				});
			}
		});
	}
}

//考勤档案列表上的操作

var rnp_cancel = {
	init: function() {
		$('a#cancel').on('click', function(event) {
			var $id = $('input#hidden_emp_id').val();
			if($id) {
				window.location = 'rnp_list';
			} else {
				window.location = 'rnp_check';
			}
		});
	}
}

//奖惩档案的取消按钮路径

var rnp_save = {
	init: function() {
		$('a#save').on('click', function(event) {
			$('#form_rnp').submit();
		});
	}
}

//奖惩档案的保存

var rnp_delete = {
	init: function() {
		$('a#delete').on('click', function(event) {
			if(confirm('确定要删除此档案吗？')) {
				$id = $('input#fileId').val();
				$.ajax({
					url: '../Performance/rnp_delete',
					type: 'POST',
					data: {
						id: $id
					},
					success: function(data) {
						console.log(data);
						alert('档案删除成功！');
						window.location = '../Performance/rnp_list';
					}
				});
			}
		});
	}
}

//奖惩档案查看页面的删除按钮

var train_save = {
	init: function() {
		if($('table.chose tr').length <= 1) {
			$('table.chose').parent().prev().show();
			$('table.chose').hide();
		}
		$('a#save').on('click', function(event) {
			var $ids = [];
			$('table.chose tr').each(function(index, el) {
				if($(this).attr('id')) {
					$ids.push($(this).attr('id'));
				}
			});
			$('#train_person').val($ids);
			$('#form_train').submit();
		});
	}
}

//培训档案的表单保存

var train_addObject = {
	init: function() {
		$('a#add').on('click', function(event) {
			$('table.multi_choose tr input[type=checkbox]').each(function(index, el) {
				$(this).prop('checked', false);
			});
			var $ids = [];
			$('table.chose tr').each(function(index, el) {
				$ids.push($(this).prop('id'));
			});
			$('table.multi_choose tr').each(function(index, el) {
				$(this).show();
				if($(this).prop('id') && $ids.indexOf($(this).prop('id')) != -1) {
					$(this).hide();
				}
			});
			$('.white-bg').fadeIn();
		});
		$('.white-bg .btn-primary').on('click', function(event) {
			var $chose = $('table.chose');
			$('table.multi_choose tr input[type=checkbox]:checked').each(function(index, el) {
				if($(this).parents('tr').prop('id')) {
					var tr = $(this).parents('tr').clone();
					tr.find('td').eq(0).remove();
					$chose.find('tr').each(function(index, el) {
						if ($(this).prop('id')) {
							if(parseInt(tr.prop('id')) > parseInt($(this).prop('id'))) {
								if($(this).next().prop('id')) {
									if(parseInt(tr.prop('id')) < parseInt($(this).next().prop('id'))) {
										$(this).after(tr);
									}
								} else {
									$(this).after(tr);
								}
								
							}
						} else {
							$(this).after(tr);
						}
					});
					$(this).parents('tr').hide();
				}
			});
			if($('table.chose tr').length > 1) {
				$('table.chose').show();
				$('table.chose').parent().prev().hide();
			}
			$('.white-bg').fadeOut();
		});
		$('.white-bg .btn-default').on('click', function(event) {
			$('.white-bg').fadeOut();
		});
	}
}

var train_removeObject = {
	init: function() {
		var $flag = false;
		$('a#delete').on('click', function(event) {
			$('a#delete').attr('disabled', 'disabled');
			$('a#add').attr('disabled', 'disabled');
			if(!$flag) {
				var $div = $('<div><a id="remove" class="btn btn-danger">移除</a><span>&nbsp;</span><a id="cancel" class="btn btn-default">放弃</a></div>');
				$('table.chose tr').each(function(index, el) {
					var $checkbox = $('<td><input type="checkbox"></td>');
					$checkbox.insertBefore($(this).find('td:eq(0)'));
				});
				$('table.chose').parent().after($div);
				$('input[type=checkbox]:eq(0)').on('click', function(event) {
					if($(this).prop('checked')) {
						$('input[type=checkbox]').each(function(index, el) {
							if(index != 0) {
								$(this).prop('checked', true);
							}
						});
					} else {
						$('input[type=checkbox]').each(function(index, el) {
							if(index != 0) {
								$(this).prop('checked', false);
							}
						});
					}
				});

				$('input[type=checkbox]').on('click', function(event) {
					if($(this).index('input[type=checkbox]') != 0) {
						if(!$(this).prop('checked')) {
							$('input[type=checkbox]:eq(0)').prop('checked', false);
						}
					}
				});

				$('a#cancel').on('click', function(event) {
					$('table.chose tr').each(function(index, el) {
						$(this).find('td:first-child').remove();
					});
					$(this).parent().remove();
					$('a#delete').removeAttr('disabled');
					$('a#add').removeAttr('disabled');
					$flag = false;
				});

				$('a#remove').on('click', function(event) {
					$('table.chose tr').each(function(index, el) {
						if($(this).prop('id')) {
							if($(this).find('input[type=checkbox]').prop('checked')) {
								$(this).remove();
							} else {
								$(this).find('td:first-child').remove();
							}
						}
					});
					$('table.chose tr').eq(0).find('td:first-child').remove();
					$(this).parent().remove();
					if($('table.chose tr').length <= 1) {
						$('table.chose').hide();
						$('table.chose').parent().prev().show();
					}
					$('a#delete').removeAttr('disabled');
					$('a#add').removeAttr('disabled');
					$flag = false;
				});
				$flag = true;
			}
		});
	}
}

//添加参训人员弹框

var train_list_operation = {
	init: function() {
		$('a.train_show').on('click', function(event) {
			$id = $(this).parents('tr').prop('id');
			$.ajax({
				url: '../Performance/train_show',
				type: 'POST',
				data: {
					id: $id
				},
				success: function(data) {
					console.log(data);
					window.location = '../Performance/train_show';
				}
			});
		});

		$('a.train_edit').on('click', function(event) {
			$id = $(this).parents('tr').prop('id');
			$.ajax({
				url: '../Performance/train_edit',
				type: 'POST',
				data: {
					id: $id
				},
				success: function(data) {
					console.log(data);
					window.location = '../Performance/train_edit';
				}
			});
		});

		$('a.train_delete').on('click', function(event) {
			if(confirm('确定删除此档案吗？')) {
				$id = $(this).parents('tr').prop('id');
				$.ajax({
					url: '../Performance/train_delete',
					type: 'POST',
					data: {
						id: $id
					},
					success: function(data) {
						console.log(data);
						window.location = '../Performance/train_check';
					}
				});
			}
		});
	}
}

//培训档案页面的列表操作

var train_delete = {
	init: function() {
		$('a#delete').on('click', function(event) {
			if(confirm('确定删除此档案吗？')) {
				$id = $('input#id').val();
				$.ajax({
					url: '../Performance/train_delete',
					type: 'POST',
					data: {
						id: $id
					},
					success: function(data) {
						console.log(data);
						window.location = '../Performance/train_check';
					}
				});
			}
		});
	}
}

//培训档案查看页面的删除功能

var multi_choose = {
	init: function() {
		$('input[type=checkbox]:eq(0)').on('click', function(event) {
			if($(this).prop('checked')) {
				$('input[type=checkbox]').each(function(index, el) {
					if(index != 0) {
						$(this).prop('checked', true);
					}
				});
			} else {
				$('input[type=checkbox]').each(function(index, el) {
					if(index != 0) {
						$(this).prop('checked', false);
					}
				});
			}
		});

		$('input[type=checkbox]').on('click', function(event) {
			if($(this).index('input[type=checkbox]') != 0) {
				if(!$(this).prop('checked')) {
					$('input[type=checkbox]:eq(0)').prop('checked', false);
				}
			}
		});
	}
}

//培训人员表格的多选

var user_add = {
	init: function() {
		$('input').on('blur', function(event) {
			if($(this).val() == '') {
				$(this).css('border', '1px solid #f00');
			} else {
				$(this).css('border', '1px solid #aaa');
			}
			if($(this).attr('id') == 'r_password' && $(this).val() != '') {
				if($('#password').val() != $('#r_password').val()) {
					$(this).css('border', '1px solid #f00');
					$('span.tips').show();
				} else {
					$(this).css('border', '1px solid #aaa');
					$('span.tips').hide();
				}	
			}
		});
		$('a#submit').on('click', function(event) {
			if($('#password').val() == $('#r_password').val()) {
				$('form#new_user').submit();
			} else {
				alert('两次输入的密码不同');
			}
		});
	}
}

//添加用户

var password_edit = {
	init: function() {
		$(document).on('blur', 'input', function(event) {
			if($(this).attr('id') == 'r_password' && $(this).val() != '') {
				if($('#password').val() != $('#r_password').val()) {
					$(this).css('border', '1px solid #f00');
					$('span.tips').show();
				} else {
					$(this).css('border', '1px solid #aaa');
					$('span.tips').hide();
				}	
			}
		});

		$('a#submit.old_submit').on('click', function(event) {
			if($('#old_password').val() != '') {
				$.ajax({
					url: '../User/editPassword',
					type: 'POST',
					data: {
						password: $('#old_password').val()
					},
					success: function(data) {
						if(data == 'error') {
							alert('密码错误！');
						} else {
							$('#form-wrapper').html(data);
						}
					}
				});
				
			}
		});

		$(document).on('click', 'a#submit.new_submit', function(event) {
			if($('#password').val() == $('#r_password').val()) {
				$('form#new_password').submit();
			} else {
				alert('两次输入的密码不同');
			}
		});
	}
}

//修改密码

var basedata_setting = {
	init: function() {
		$(document).on('click', 'a.setting', function(event) {
			$id = $(this).parents('tr').attr('id');
			$name = $(this).parent().prev().text();
			$.ajax({
				url: '../System/basedata_init',
				type: 'POST',
				data: {
					id: $id,
					name: $name
				},
				success: function(data) {
					$old_data = $('.table_scroll').find('table');
					$('.table_scroll').html(data);
				}
			});
		});

		$(document).on('click', 'a#cancel', function(event) {
			$('.table_scroll').html($old_data);
		});

		$(document).on('click', 'a.delete', function(event) {
			$data_id = $(this).parents('tr').attr('id');
			$id = $('p.form-title').attr('id');
			$name = $('p.form-title').text();
			$.ajax({
				url: '../System/basedata_delete',
				type: 'POST',
				data: {
					data_id: $data_id,
					id: $id,
					name: $name
				},
				success: function(data) {
					$('.table_scroll').html(data);
				}
			});
		});

		$(document).on('click', 'a#add', function(event) {
			var $content = $('input#content').val();
			$id = $('p.form-title').attr('id');
			$name = $('p.form-title').find('span').text();
			$.ajax({
				url: '../System/basedata_add',
				type: 'POST',
				data: {
					id: $id,
					name: $name,
					content: $content
				},
				success: function(data) {
					$('.table_scroll').html(data);
				}
			});
		});
	}
}

var company_frame = {
	init: function() {
		$('select').each(function(index, el) {
			if(!$(this).attr('id')) {
				$(this).change(function(event) {
					$(this).parents('tr').addClass('changed');
					$('a#save').show();
				});
			}
			$(this).find('option').each(function(index, el) {
				if($(this).attr('checked')) {
					$(this).parent().val($(this).val());
					$(this).removeAttr('checked');
				}
			});
		});

		$('a#add').on('click', function(event) {
			$new_department = $('input#new_department').val();
			$superior_department = $('select#superior_department option:checked').val();
			$.ajax({
				url: '../System/department_add',
				type: 'POST',
				data: {
					new_department: $new_department,
					superior_department: $superior_department
				},
				success: function(data) {
					window.location = 'company_frame';
				}
			});
		});

		$(document).on('click', 'a.delete', function(event) {
			$department = $(this).parents('tr').find('td:eq(0)').text();
			$.ajax({
				url: '../System/department_delete',
				type: 'POST',
				data: {
					department: $department,
				},
				success: function(data) {
					window.location = 'company_frame';
				}
			});
		});

		$(document).on('click', 'a#save', function(event) {
			$flag = false;
			if($('.changed').length) {
				$('.changed').each(function(index, el) {
					$_this = $(this);
					$superior = $(this).find('select option:checked').val();
					$('select').each(function(index, el) {
						if($(this).parents('tr').find('td:eq(0)').text() == $superior &&
							$(this).find('option:checked').val() == $_this.find('td:eq(0)').text() ) {
							$flag = true;
						}
					});
				});
				if(!$flag) {
					$department = [];
					$superior_department = [];
					$('.changed').each(function(index, el) {
						$department.push($(this).find('td:eq(0)').text());
						$superior_department.push($(this).find('select option:checked').val());
					});
					$.ajax({
						url: '../System/department_edit',
						type: 'POST',
						data: {
							department: $department,
							superior_department: $superior_department
						},
						success: function(data) {
							// console.log(data);
							alert('保存设置成功！');
							window.location = 'company_frame';
						}
					});
				} else {
					alert('保存失败！部门从属关系错误！');
				}
			} else {
				alert('没有进行任何更改');
			}
		});
	}
}