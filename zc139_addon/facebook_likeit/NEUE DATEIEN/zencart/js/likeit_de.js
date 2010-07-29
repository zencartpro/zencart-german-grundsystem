window.fbAsyncInit = function() {
FB.init({appId: 'hierIhrenAPIKeyeintragen', status: true, cookie: true,
xfbml: true});
};
(function() {
var e = document.createElement('script'); e.async = true;
e.src = document.location.protocol +
'//connect.facebook.net/de_DE/all.js';
document.getElementById('fb-root').appendChild(e);
}());