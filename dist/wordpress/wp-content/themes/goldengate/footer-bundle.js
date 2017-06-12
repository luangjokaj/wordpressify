'use strict';

var test = 'Babel is doing the job.';

$(window).on('load', function () {
	console.log(test);
	setTimeout(function () {
		$('.last').addClass('last-loaded');
	}, 2000);
});

var isMobile = /iPad|iPhone|iPod|Android|webOS|iPhone|BlackBerry|IEMobile|Opera Mini/.test(navigator.userAgent) && !window.MSStream;
var header = $('header');

function isIE(userAgent) {
	userAgent = userAgent || navigator.userAgent;
	return userAgent.indexOf("MSIE ") > -1 || userAgent.indexOf("Trident/") > -1 || userAgent.indexOf("Edge/") > -1;
}

$(window).on('load', function () {
	$(window).scrollTop(0);
	setTimeout(function () {
		$(window).scroll(function () {
			var scroll = $(window).scrollTop();
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
//# sourceMappingURL=footer-bundle.js.map
