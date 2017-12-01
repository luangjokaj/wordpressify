$('a').click(function (event) {
	let scrollOffset = 0;

	if ($(this).is('a[href^="#"]') && $(this).attr('href').length >= 2 && !$(this).hasClass('menu-click')) {
		$('html, body').animate({
			scrollTop: $($.attr(this, 'href')).offset().top + scrollOffset
		}, 1500);
		return false;
	}

	if ($(this).is('a:not([href^="#"], [href^="mailto"])') && $(this).attr('target') != '_blank') {
		event.preventDefault();
		header.removeClass('loaded');

		const newLocation = this.href;
		setTimeout(function () {
			window.location = newLocation;
		}, 1000);
	}
});