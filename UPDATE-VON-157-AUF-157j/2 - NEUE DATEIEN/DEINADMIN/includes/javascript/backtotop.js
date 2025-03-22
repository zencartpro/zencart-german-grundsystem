$(document).ready(function(){	
	var back_to_top_button = ['<a title="Back to Top" href="#top" class="back-to-top"><span class="backtotopicon"><i class="fa-solid fa-circle-chevron-up fa-lg"></i></span></a>'].join("");
	$("body").append(back_to_top_button)
	$(".back-to-top").hide();
	$(function () {
		$(window).scroll(function () {
			if ($(this).scrollTop() > 100) {
				$('.back-to-top').fadeIn();
			} else {
				$('.back-to-top').fadeOut();
			}
		});

		$('.back-to-top').click(function () { 
			$('body,html').animate({
				scrollTop: 0
			}, 800);
			return false;
		});
	});
});