$(document).ready(function() {

	$("#twitter").tweet({
		join_text: "auto",
		username: "aginginaction",
		avatar_size: 48,
		count: 3,
		auto_join_text_default: "we said,",
		auto_join_text_ed: "we",
		auto_join_text_ing: "we were",
		auto_join_text_reply: "we replied",
		auto_join_text_url: "we were checking out",
		loading_text: "loading tweets..."
	});

	$('#customers').cycle({
		fx: 'fade' // choose your transition type, ex: fade, scrollUp, shuffle, etc...
	});

	$('.fancybox').fancybox();
	
	$(".extLink").fancybox({
		'width' : '75%',
		'height' : '75%',
		'autoScale' : false,
		'type' : 'iframe',
		'scrolling' : 'no',
	});

	$(".survey-one-answer").click(function(){
		$("#survey-one-question").slideUp();
		$("#survey-one-results").fadeIn("slow");
	});

	$(".survey-two-answer").click(function(){
		$("#survey-two-question").slideUp();
		$("#survey-two-results").fadeIn("slow");
	});

	$('.quotes').quote_rotator({
		rotation_speed: 5000,                    // defaults to 5000
		pause_on_hover: true,                   // defaults to true
		randomize_first_quote: true              // defaults to false
	});

	$('#feedburner').rssfeed('https://feeds.feedburner.com/pewresearch/internetandtechnology');

});

function slideSwitch() {
    var $active = $('#customers img.active');
    var $next = $active.next();    
    
    $next.addClass('active');
    
    $active.removeClass('active');
}

$(function() {
    setInterval( "slideSwitch()", 5000 );
});