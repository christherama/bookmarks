$(function(){
	
	// Capture hover over bookmark
	$('.bookmark').hover(
		function(){$(this).addClass('hover')},
		function(){$(this).removeClass('hover')}
	);
	
	// Capture click of cancel buttons
	$('button.btn-cancel').click(function(){
		window.history.go(-1);
	});
});