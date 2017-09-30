const menu = $('#menu');
const header = $('#header');
const menuItem = $('.page_item');

menu.click(function () {
	menu.toggleClass('active');
	header.toggleClass('active');
	searchButton.removeClass('toggled');
	closeSearchButton.removeClass('active');
	search.removeClass('active');
});

menuItem.click(function () {
	menu.removeClass('active');
	header.removeClass('active');
});