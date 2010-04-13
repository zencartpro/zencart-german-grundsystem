/*
* load lightbox before image loading is complete:
*  http://dean.edwards.name/weblog/2006/06/again/
*/
function init() {
// quit if this function has already been called
if (arguments.callee.done) return;

// flag this function so we don't do the same thing twice
arguments.callee.done = true;

// kill the timer
if (_timer) {
clearInterval(_timer);
_timer = null;
}

// load the lightbox before images are loaded
initLightbox();
};

/* for Mozilla */
if (document.addEventListener) {
document.addEventListener("DOMContentLoaded", init, false);
}

/* for Internet Explorer */
/*@cc_on @*/
/*@if (@_win32)
document.write("<script id=__ie_onload defer src=javascript:void(0)><\/script>");
var script = document.getElementById("__ie_onload");
script.onreadystatechange = function() {
if (this.readyState == "complete") {
init(); // call the onload handler
}
};
/*@end @*/

/* for Safari */
if (/WebKit/i.test(navigator.userAgent)) { // sniff
var _timer = setInterval(function() {
if (/loaded|complete/.test(document.readyState)) {
init(); // call the onload handler
}
}, 10);
}

/* for other browsers */
window.onload = init;