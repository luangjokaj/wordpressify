const header = $('.header');

$(window).on('load', function () {
	$(window).scrollTop(0);
	setTimeout(function () {
		$(window).scroll(function () {
			let scroll = $(window).scrollTop();
			if (scroll >= 50) {
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