jQuery(document).ready(function($) {
    var $autolink = $('a.autohide');
    $autolink.parent().next().hide();
    $autolink.click(function() {
		$(this).parent().next().toggle();
		$(this).children().first().toggleClass('icon-plus-square-o icon-minus-square-o');
	});
});