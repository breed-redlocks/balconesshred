$(document).ready(function() {
	$('#col1 h2').each(function() {
		var q = $(this);
		q.nextUntil('h2').hide();
		q.click(function() {
			$(this).nextUntil('h2').slideToggle();
		});
	});
});