const headings = $('.post-inner-content h1, .post-inner-content h2, .post-inner-content h3');
const sideHeadings = $('.documentation nav');
let current = 0;
headings.each(function () {
	current++;
	let titleText = $(this).text();
	let txt2 = $('<a href="#'+ current + '"></a>').text(titleText);
	
	txt2.appendTo(sideHeadings);
	$(this).attr('id', current.toString());
});

if (!headings.length) {
	$('.documentation nav h6').remove()
};