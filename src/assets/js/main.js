const header = $('.header');
const mockup = $('#mockup');
let mockupPosition = 100;
mockup.length ? mockupPosition = mockup.position().top + mockup.height() : mockupPosition = 100;

$(window).on('load', function () {
	$(window).scrollTop(0);
	setTimeout(function () {
		header.addClass('reset-delay');
		$('.navigation').addClass('reset-delay');
		$('.logo').addClass('reset-delay');
		$(window).scroll(function () {
			let scroll = $(window).scrollTop();
			if (scroll >= mockupPosition) {
				header.addClass('scrolled');
				sideHeadings.length && sideHeadings.addClass('scrolled');
			} else {
				header.removeClass('scrolled');
				sideHeadings.length && sideHeadings.removeClass('scrolled');
			}
		});

		!mockup.length ? header.addClass('bright') : header.removeClass('brith');

	}, 2000);
	AOS.init();

	$(window).resize(function () {
		AOS.refresh();
	});

	header.addClass('loaded');
});

$(window).resize(function () {
	AOS.refresh;
});

githubStars("luangjokaj/wordpressify", function(stars) {
	$('.github').attr('data-counter', stars);
});