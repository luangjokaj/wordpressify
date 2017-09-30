// Show the progress bar
NProgress.start();

// Increase randomly
let interval = setInterval(function () { NProgress.inc(); }, 1000);

// Trigger finish when page fully loaded
$(window).on('load', function () {
	clearInterval(interval);
	NProgress.done();
	console.log('Yuuppy');
});

// Trigger bar when exiting the page
window.onbeforeunload = function () {
	console.log("triggered");
	NProgress.start();
};