var main_nav = {
	init: function() {
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
		var $cancel = $('<span>&nbsp;</span><button class="btn btn-default cancel">取消</button>')
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
							window.location = '../BaseInfo/check'
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
			var id = $(this).parents('tr').attr('id');
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
			var id = $(this).parents('tr').attr('id');
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
				var id = $(this).parents('tr').attr('id');
				$.ajax({
					url: '../BaseInfo/BaseInfo_delete',
					type: 'POST',
					data: {
						id: id
					},
					success: function(data) {
						console.log('success');
						window.location = '../BaseInfo/check'
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

var attendence_initData = {
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

//初始化考勤档案的部门和员工

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
					window.location = '../Performance/attendence_list'
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
						window.location = '../Performance/attendence_list'
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
						window.location = '../Performance/attendence_list'
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