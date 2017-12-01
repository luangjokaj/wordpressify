const header = $('.header');
const mockup = $('#mockup');
const mockupPosition = mockup.position().top + mockup.height();

$(window).on('load', function () {
	$(window).scrollTop(0);
	setTimeout(function () {
		$(window).scroll(function () {
			let scroll = $(window).scrollTop();
			if (scroll >= mockupPosition) {
				header.addClass('scrolled');
			} else {
				header.removeClass('scrolled');
			}
		});

	}, 2000);
	AOS.init();

	$(window).resize(function () {
		AOS.refresh();
	});
});

$(window).resize(function () {
	AOS.refresh;
});

