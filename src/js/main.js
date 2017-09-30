const test = 'Babel is doing the job. Test';

$(window).on('load', function () {
	console.log(test);
	setTimeout(function () {
		$('.last').addClass('last-loaded');
	}, 2000);
});


const isMobile = /iPad|iPhone|iPod|Android|webOS|iPhone|BlackBerry|IEMobile|Opera Mini/.test(navigator.userAgent) && !window.MSStream;
const header = $('.lk-header');
const shadow = $('.shadow');
const search = $('.lk-search');
const searchInput = $('.lk-search input[type="text"]');
const searchButton = $('#search');
const closeSearchButton = $('#close-search');

searchButton.click(function () {
	search.addClass('active');
	searchButton.addClass('toggled');
	closeSearchButton.addClass('active');
	searchInput.focus();
	menu.removeClass('active');
	header.removeClass('active');
});

closeSearchButton.click(function () {
	searchButton.removeClass('toggled');
	closeSearchButton.removeClass('active');
	search.removeClass('active');
});

function isIE(userAgent) {
	userAgent = userAgent || navigator.userAgent;
	return userAgent.indexOf("MSIE ") > -1 || userAgent.indexOf("Trident/") > -1 || userAgent.indexOf("Edge/") > -1;
}

$(window).on('load', function () {
	$(window).scrollTop(0);
	setTimeout(function () {
		$(window).scroll(function () {
			let scroll = $(window).scrollTop();
			if (scroll >= 50) {
				header.addClass('scrolled');
				shadow.addClass('scrolled');
				search.addClass('scrolled');
			} else {
				header.removeClass('scrolled');
				shadow.removeClass('scrolled');
				search.removeClass('scrolled');
			}
		});

	}, 2000);
	AOS.init();

	$(window).resize(function () {
		AOS.refresh();
	});
});

// Disable search autocomplete
$('.lk-search input[type="text"]').attr('autocomplete', 'off');


// Refresh Animate on Scoll
$(window).resize(function () {
	AOS.refresh;
});