$(function () {
	if ($("#modal-iframe").length) {
		$("#modal-iframe").iziModal({
			history: false,
			iframe: false,
			fullscreen: false,
			group: 'group1',
			width: '100vh',
			iframeHeight: '90vh',
			closeButton: true,
			loop: true
		});
	}

	if ($(".modal-thumb").length) {
		$(".modal-thumb").iziModal({
			history: false,
			iframe: false,
			fullscreen: false,
			group: 'group2',
			width: '100vh',
			iframeHeight: '90vh',
			closeButton: true,
			loop: true
		});
	}

})

$('.modal-thumb').each(function () {
	$(this).addClass('test');
});