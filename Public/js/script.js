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
					var $checkbox = $('<td class="checkbox"><input type="checkbox" /></td>');
					$checkbox.insertBefore($(this).find('td:eq(0)'));
				});
				$cancel.insertAfter($(this));
				$('.checkbox:eq(0)>input').on('click', function(event) {
					if($(this).attr('checked') != 'checked') {
						$('.checkbox>input').each(function(index, el) {
							$(this).attr('checked', 'checked');
						});
					} else {
						$('.checkbox>input').each(function(index, el) {
							$(this).attr('checked', 'false');
						});
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