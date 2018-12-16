const girdIsotope = $('.grid');

$(window).on('load', function () {
	if (girdIsotope.length) {
		girdIsotope.isotope({
			itemSelector: '.grid-item',
			layoutMode: 'masonry'
		});
	}
});