var main_nav = {
	init: function() {
		$("ul.nav li.dropdown").hover(function() {
			$("ul.dropdown-menu", this).stop().fadeIn(200);
		}, function() {
			$("ul.dropdown-menu", this).stop().fadeOut(200);
		});
	}
}