var main_nav = {
	init: function() {
		if($('#user_type').val() != '超级管理员') {
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
		$('input[name=emp_email]').on('change', function(event) {
			if(!(/^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$/g.test($(this).val()))) {
				$(this).parent().append('<span class="error">格式错误</span>');
				$(this).css('border', '1px solid #f00');
			} else {
				$(this).parent().find('.error').remove();
				$(this).css('border', '1px solid #aaa');
			}
		});	//邮箱格式验证

		$('input[name=emp_qq], input[name=emp_postcode], input[name=emp_phone]').on('change', function(event) {
			if(!(/^\d+$/g.test($(this).val()))) {
				$(this).parent().append('<span class="error">格式错误</span>');
				$(this).css('border', '1px solid #f00');
			} else {
				$(this).parent().find('.error').remove();
				$(this).css('border', '1px solid #aaa');
			}
		});

		$('input[name=emp_idnum]').on('change', function(event) {
			$(this).val($(this).val().toUpperCase());
			if(!(/^[0-9]+X?$/g).test($(this).val()) || $(this).val().length != 18) {
				$(this).parent().append('<span class="error">格式错误</span>');
				alert('f00');
				$(this).css('border', '1px solid #f00');
			} else {
				$(this).parent().find('.error').remove();
				$(this).css('border', '1px solid #aaa');
			}
		});

		$('input.datepick').on('change', function(event) {
			if(!(/^\d{4}-\d{2}-\d{2}/g).test($(this).val())) {
				$(this).parent().append('<span class="error">格式错误</span>');
				$(this).css('border', '1px solid #f00');
			} else {
				$(this).parent().find('.error').remove();
				$(this).css('border', '1px solid #aaa');
			}
		});
		

		$('div.tips').on('click', function(event) {
			$('input[type=file]').click();
		});

		$('input[type=file]').on('change', function(event) {
			var files = this.files ? this.files : [];
			    if (/^image/.test( files[0].type)) {
			        var reader = new FileReader();
			        reader.readAsDataURL(files[0]);
			        reader.onloadend = function() {
			   			$('#emp_photo img').attr('src', this.result);  
			    	}
			    }
		});

		$('form input').on('blur change', function(event) {
			if($(this).val() == '') {
				if(	$(this).parent().parent().parent().find('p.form-title').text() == '个人信息'
					|| $(this).attr('name') == 'emp_job' 
					|| $(this).attr('name') == 'emp_entry_date'
					|| $(this).attr('name') == 'emp_cont_start'
					|| $(this).attr('name') == 'emp_cont_end') {
					$(this).css('border', '1px solid #f00');
				}
			} else if($(this).parent().find('.error').length) {
				$(this).css('border', '1px solid #f00');
			} else {
				$(this).css('border', '1px solid #aaa');
			}
		});

		$('#save').on('click', function(event) {	
			var $flag = false;		
			$('form input').each(function(index, el) {
				if($(this).val() == '') {
					if($(this).parent().parent().parent().find('p.form-title').text() == '个人信息') {
						$flag = true;
						$(this).css('border', '1px solid #f00');
					} else if($(this).parent().parent().parent().find('p.form-title').text() == '职务信息') {
						if(	$(this).attr('name') == 'emp_job' 
							|| $(this).attr('name') == 'emp_entry_date'
							|| $(this).attr('name') == 'emp_cont_start'
							|| $(this).attr('name') == 'emp_cont_end') {
							$flag = true;
							$(this).css('border', '1px solid #f00');
						}
					}
				} else {
					if($('span.error').length) {
						$('span.error').each(function(index, el) {
							$(this).parent().find('input').css('border', '1px solid #f00');
						});
						$flag = true;
					}
				}
			});
			if(!$flag) {
				$('#form_baseInfo').submit();
			} else {
				alert('信息尚未填写完整或填写格式不正确！');
			}
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
		if($('input[name=have_photo]').val()) {
			$('#emp_photo img').attr('src', '../../Apps/Admin/Uploads/' + $('input[name=fm_num]').val()+ '.' + $('input[name=have_photo]').val());
		}
		
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
		if($('input#user_type').val() != '超级管理员') {
			$('select#attendence_status').find('option').remove();
			$('select#attendence_status').append('<option value="请假">请假</option>');

		}
		$('form input, textarea').on('blur change', function(event) {
			if($(this).val() == '') {
				$(this).css('border', '1px solid #f00');
			} else {
				$(this).css('border', '1px solid #aaa');
			}
		});
		$('a#save').on('click', function(event) {
			$flag = false;
			$('form input').each(function(index, el) {
				if($(this).val() == '') {
					$flag = true;
					$(this).css('border', '1px solid #f00');
				}
			});
			if($('textarea').val() == '') {
				$flag = true;
				$('textarea').css('border', '1px solid #f00');
			}
			if(!$flag) {
				$('#form_attendence').submit();
			} else {
				alert('信息尚未填写完整！');
			}
			
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

var attendence_check = {
	init: function() {
		$('ul.choose-tab li a').on('click', function(event) {
			$(this).parent().parent().find('.active').removeClass('active');
			$(this).parent().addClass('active');
			$('.tab').hide();
			$('.tab').eq($(this).parent().index()).show();
		});
	}
}

//考勤档案主页初始化

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
		$('form input, textarea').on('blur change', function(event) {
			if($(this).val() == '') {
				$(this).css('border', '1px solid #f00');
			} else {
				$(this).css('border', '1px solid #aaa');
			}
		});
		$('a#save').on('click', function(event) {
			$flag = false;
			$('form input').each(function(index, el) {
				if($(this).val() == '') {
					$flag = true;
					$(this).css('border', '1px solid #f00');
				}
			});
			if($('textarea').val() == '') {
				$flag = true;
				$('textarea').css('border', '1px solid #f00');
			}
			if(!$flag) {
				$('#form_rnp').submit();
			} else {
				alert('信息尚未填写完整！');
			}
			
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
		$('form input').on('blur change', function(event) {
			if($(this).val() == '') {
				$(this).css('border', '1px solid #f00');
			} else {
				$(this).css('border', '1px solid #aaa');
			}
		});
		$('a#save').on('click', function(event) {
			$flag = false;
			$('form input').each(function(index, el) {
				if($(this).val() == '') {
					$flag = true;
					$(this).css('border', '1px solid #f00');
				}
			});
			if(!$flag) {
				var $ids = [];
				$('table.chose tr').each(function(index, el) {
					if($(this).attr('id')) {
						$ids.push($(this).attr('id'));
					}
				});
				$('#train_person').val($ids);
				$('#form_train').submit();
			} else {
				alert('信息尚未填写完整！');
			}
			
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

//基本资料设置

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
			if($new_department) {
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
			} else {
				alert('请输入新部门名称！');
			}
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

//企业架构设置

var system_init = {
	init: function() {
		$('a.system_init').on('click', function(event) {
			if(confirm('即将初始化系统，此操作将清空系统所有数据，是否确定继续？')) {
				$.ajax({
					url: '../System/systemInit',
					type: 'POST',
					data: {
						password: $('input#password').val()
					},
					success: function(data) {
						if(data == 'error') {
							alert('密码错误！');
						} else if(data == 'success') {
							alert(data);
						}
					}
				});
			}
		});
	}
}

//初始化系统

var account_setting = {
	init: function() {
		$('.project_add').on('click', function(event) {
			$('a.project_edit_confirm').addClass('project_add_confirm').removeClass('project_edit_confirm');
			if($('.shown').length) {
				$('.white-bg input').each(function(index, el) {
					$(this).val('');
				});
				$('.white-bg').fadeIn();
				$('.white-bg .btn-default').on('click', function(event) {
					$('.white-bg').fadeOut();
				});
			} else {
				alert('尚未选定查看的账套！');
			}

			return false;
		});

		$('.account_add').on('click', function(event) {
			var $account_name = $(this).prev().val();
			if($account_name != '') {
				$.ajax({
					url: '../Salary/account_add',
					type: 'POST',
					data: {
						account_name: $account_name
					},
					success: function(data) {
						$('.table_scroll.short').eq(0).html(data);
						$('.account_add').prev().val('');
					}
				});
			} else {
				alert('请输入账套名称！');
			}
		});

		$(document).on('click', 'a.use', function(event) {
			$_this = $(this);
			$id = parseInt($_this.parents('tr').attr('id'));
			$.ajax({
				url: '../Salary/use_status_change',
				type: 'POST',
				data: {
					id: $id
				},
				success: function(data) {
					$('tr').each(function(index, el) {
						if($(this).find('td').eq(2).text() == '正在使用') {
							$(this).find('td').eq(2).text('未使用');
						}
					});
					$_this.parents('tr').find('td').eq(2).text('正在使用');
					$('.used').removeClass('used').addClass('use');
					$_this.removeClass('use').addClass('used');
				}
			});
		});

		$(document).on('click', 'a.show', function(event) {
			$_this = $(this);
			$id = parseInt($_this.parents('tr').attr('id'));
			$.ajax({
				url: '../Salary/account_show',
				type: 'POST',
				data: {
					id: $id
				},
				success: function(data) {
					$('.table_scroll.short').eq(1).html(data);
					$('.account-title').text('账套内容 ' + $_this.parents('tr').find('td').eq(1).text());
					$('.shown').removeClass('shown').addClass('show');
					$_this.removeClass('show').addClass('shown');
				}
			});
		});

		$(document).on('click', 'a.account_delete', function(event) {
			var $_this = $(this);
			var $id = parseInt($_this.parents('tr').attr('id'));
			var $text = '确定要删除此账套吗？'
			if($_this.parents('tr').find('td').eq(2).text() == '正在使用') {
				$text = '此账套正在使用，确定要删除此账套吗？';
			}
			if(confirm($text)) {
				$.ajax({
					url: '../Salary/account_delete',
					type: 'POST',
					data: {
						id: $id
					},
					success: function(data) {
						$_this.parents('tr').remove();
						if($('a.shown').length == 0) {
							$('.account-title').text('账套内容 尚未选定账套');
							$('.table_scroll.short').eq(1).html('');
						}
					}
				});
			}
		});

		$(document).on('click', 'a.project_add_confirm', function(event) {
			$('input#account_id').val(parseInt($('a.shown').parents('tr').attr('id')));
			if($('.table_scroll.short').eq(1).find('table').length == 1) {
				$('input#project_id').val(parseInt($('.table_scroll.short').eq(1).find('tr').eq($('.table_scroll.short').eq(1).find('tr').length - 1).find('td').eq(0).text()) + 1);
			} else {
				$('input#project_id').val(1);
			}
			if($('input[name=project_money]').val() == '') {
				$('input[name=project_money]').val(0);
			}
			if($('input[name=project_name]').val() == '') {
				alert('请输入项目名称！');
			} else {
				$.ajax({
					url: '../Salary/project_add',
					type: 'POST',
					data: {
						account_id: $('input[name=account_id]').val(),
						project_id: $('input[name=project_id]').val(),
						project_name: $('input[name=project_name]').val(),
						project_unit: $('select[name=project_unit]').val(),
						project_type: $('select[name=project_type]').val(),
						project_money: $('input[name=project_money]').val()
					},
					success: function(data) {
						$('.table_scroll.short').eq(1).html(data);
						$('.white-bg').fadeOut();
					}
				});
			}
			
		});

		$(document).on('click', '.project_delete', function(event) {
			$_this = $(this);
			if(confirm('确定要删除此项目吗？')) {
				$.ajax({
					url: '../Salary/project_delete',
					type: 'POST',
					data: {
						account_id: parseInt($('a.shown').parents('tr').attr('id')),
						project_id: parseInt($_this.parents('tr').find('td').eq(0).text())
					},
					success: function(data) {
						$('.table_scroll.short').eq(1).html(data);
					}
				});
			}
		});

		$(document).on('click', '.project_edit', function(event) {
			$('.white-bg').fadeIn();
			$('.white-bg .btn-default').on('click', function(event) {
				$('.white-bg').fadeOut();
			});
			$('input[name=project_id]').val(parseInt($(this).parents('tr').find('td').eq(0).text()));
			$('input[name=project_name]').val($(this).parents('tr').find('td').eq(1).text());
			$('select[name=project_unit]').val($(this).parents('tr').find('td').eq(2).text());
			$('select[name=project_type]').val($(this).parents('tr').find('td').eq(3).text());
			$('input[name=project_money]').val(parseInt($(this).parents('tr').find('td').eq(4).text()));
			$('a.project_add_confirm').addClass('project_edit_confirm').removeClass('project_add_confirm');
		});

		$(document).on('click', '.project_edit_confirm', function(event) {
			$('input[name=account_id]').val(parseInt($('a.shown').parents('tr').attr('id')));
			$.ajax({
				url: '../Salary/project_edit',
				type: 'POST',
				data: {
					account_id: $('input[name=account_id]').val(),
					project_id: $('input[name=project_id]').val(),
					project_name: $('input[name=project_name]').val(),
					project_unit: $('select[name=project_unit]').val(),
					project_type: $('select[name=project_type]').val(),
					project_money: $('input[name=project_money]').val()
				},
				success: function(data) {
					$('.table_scroll.short').eq(1).html(data);
					$('.white-bg').fadeOut();
				}
			});
		});
	}
}

//账套设置

var salary_setting = {
	init: function() {
		$(document).on('click', '.edit', function(event) {
			$('table tr').each(function(index, el) {
				$_this = $(this);
				if($_this.index() != 0){
					$_this.find('td').each(function(index, el) {
						if($(this).index() > 4) {
							var $text = $(this).text();
							var $len = $text.length;
							var $content;
							if($text[$len-2] >= '0' && $text[$len-2] <= '9') {
								$content = $text.substring(0, $len-1);
								$unit = $text.substring($len-1, $len);
							}
							if($(this).index() == 5) {
								$(this).html('<input type="number" class="shorter" value=' + $content + '>' + '<span>' + $unit + '</span>');
							} else {
								$(this).html('<input type="number" class="shortest" value=' + $content + '>' + '<span>' + $unit + '</span>');
							}
						}
					});
				}
				
			});
			$(this).text('保存');
			$(this).addClass('save').removeClass('edit');
			$(this).parent().append('<span>&nbsp;</span><a class="btn btn-default cancel" href="#">取消</a>')
		});

		$(document).on('click', '.cancel', function(event) {
			$(this).prev().remove();
			$(this).remove();
			$('.save').addClass('edit').removeClass('save');
			$('.edit').text('编辑');
			// $('table tr').each(function(index, el) {
			// 	if($(this).index($('table tr')) != 0){
			// 		$(this).find('td').eq(5).html($(this).find('input').val() + '元');
			// 	}
				
			// });
			$('table tr').each(function(index, el) {
				$_this = $(this);
				if($_this.index() != 0){
					$_this.find('td').each(function(index, el) {
						if($(this).index() > 4) {
							var $text = $(this).text();
							var $len = $text.length;
							var $content = $(this).find('input').val();
							var $unit = $(this).find('input').next().text();
							$(this).html($(this).find('input').val() + $unit);
						}
					});
				}
				
			});
		});

		$(document).on('click', '.save', function(event) {
			var $id = [];
			var $salary = [];
			var $x = 0;
			$('tr.change').each(function(index, el) {
				$id.push($(this).attr('id'));
				$salary[$x] = [];
				$(this).find('input').each(function(index, el) {
					$salary[$x][parseInt($(this).parents('td').index()) - 5] = $(this).val();
				});
				$x++;
			});
			if(confirm('确定保存修改吗？')) {
				$.ajax({
					url: '../Salary/salary_edit',
					type: 'POST',
					data: {
						id: $id,
						salary: $salary
					},
					success: function(data) {
						// console.log(data);
						$('.cancel').prev().remove();
						$('.cancel').remove();
						$('.save').addClass('edit').removeClass('save');
						$('.edit').text('编辑');
						// $('table tr').each(function(index, el) {
						// 	if($(this).index($('table tr')) != 0){
						// 		$(this).find('td').eq(5).html($(this).find('input').val() + '元');
						// 	}
							
						// });
						$('table tr').each(function(index, el) {
							$_this = $(this);
							if($_this.index() != 0){
								$_this.find('td').each(function(index, el) {
									if($(this).index() > 4) {
										var $text = $(this).text();
										var $len = $text.length;
										var $content = $(this).find('input').val();
										var $unit = $(this).find('input').next().text();
										$(this).html($(this).find('input').val() + $unit);
									}
								});
							}
							
						});
						$('.change').removeClass('change');
					}
				});
			}
		});

		$(document).on('change', 'input', function(event) {
			$(this).parents('tr').addClass('change');
		});
	}
}

//人员设置

var statistic = {
	init: function() {
		$('select#statistic_season').attr('disabled', true);
		$('select#statistic_halfyear').attr('disabled', true);
		$(document).on('change', 'input[name=statistic_time]', function(event) {
			$('select').each(function(index, el) {
				$(this).attr('disabled', true);
			});
			$('select#statistic_year').attr('disabled', false);
			if($(this).val() == '月') {
				$('select#statistic_month').attr('disabled', false);
			} else if($(this).val() == '季'){
				$('select#statistic_season').attr('disabled', false);
			} else if($(this).val() == '半年'){
				$('select#statistic_halfyear').attr('disabled', false);
			} else if($(this).val() == '年'){
			}
		});

		$(document).on('click', '.submit', function(event) {
			var $year = $('select#statistic_year').val();
			var $alternative;
			if($('input[name=statistic_time]:checked').val() == '月') {
				$alternative = $('select#statistic_month').val();

			} else if($('input[name=statistic_time]:checked').val() == '季'){
				$alternative = $('select#statistic_season').val();
			} else if($('input[name=statistic_time]:checked').val() == '半年'){
				$alternative = $('select#statistic_halfyear').val();
			} else if($('input[name=statistic_time]:checked').val() == '年'){
				$alternative = '';
			}
			$.ajax({
				url: '../Salary/statistic_change',
				type: 'POST',
				data: {
					year: $year,
					alternative: $alternative
				},
				success: function(data) {
					// console.log(data);
					$('.table_scroll').html(data);
				}
			});

		});
	}
}

//统计报表

var info_select = {
	init: function() {
		$('select#department').on('change', function(event) {
			var $department_val = $(this).val();
			var $name_val = $('input#select_name').val();
			if($department_val == '全部') {
				$('.hide').removeClass('hide');
				if($name_val != '') {
					$(this).parent().parent().parent().find('table tr').each(function(index, el) {
						if($(this).index() != 0) {
							if($(this).find('td').eq(1).text().indexOf($name_val) == -1) {
								$(this).addClass('hide');
							} 
						}
					});
				}

			} else {
				$('.hide').removeClass('hide');
				if($name_val != '') {
					$(this).parent().parent().parent().find('table tr').each(function(index, el) {
						if($(this).index() != 0) {
							if($(this).find('td').eq(3).text() != $department_val || $(this).find('td').eq(1).text().indexOf($name_val) == -1) {
								$(this).addClass('hide');
							} 
						}
					});
				} else {
					$(this).parent().parent().parent().find('table tr').each(function(index, el) {
						if($(this).index() != 0) {
							if($(this).find('td').eq(3).text() != $department_val) {
								$(this).addClass('hide');
							} 
						}
					});
				}
			}
		});

		$('input#select_name').on('change', function(event) {
			var $name_val = $(this).val();
			var $department_val = $('select#department').val();
			if($department_val == '全部') {
				$('.hide').removeClass('hide');
				if($name_val != '') {
					$(this).parent().parent().parent().find('table tr').each(function(index, el) {
						if($(this).index() != 0) {
							if($(this).find('td').eq(1).text().indexOf($name_val) == -1) {
								$(this).addClass('hide');
							} 
						}
					});
				}
			} else {
				$('.hide').removeClass('hide');
				if($name_val != '') {
					$(this).parent().parent().parent().find('table tr').each(function(index, el) {
						if($(this).index() != 0) {
							if($(this).find('td').eq(3).text() != $department_val || $(this).find('td').eq(1).text().indexOf($name_val) == -1) {
								$(this).addClass('hide');
							} 
						}
					});
				} else {
					$(this).parent().parent().parent().find('table tr').each(function(index, el) {
						if($(this).index() != 0) {
							if($(this).find('td').eq(3).text() != $department_val) {
								$(this).addClass('hide');
							} 
						}
					});
				}
			}
		});
	}
}

//筛选信息功能
