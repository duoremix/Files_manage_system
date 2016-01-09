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

var multi_delete = {
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
					console.log($('input[type=checkbox]:checked').length);
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