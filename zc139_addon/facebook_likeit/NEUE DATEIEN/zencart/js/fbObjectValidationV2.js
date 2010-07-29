// ------------------
// Copyright 2010 Kevin Lieser, kleaserarts - Mediendesign
// info@ka-mediendesign.de, www.ka-mediendesign.de
// ------------------

var fbVObject = document.getElementsByTagName("body");
for(i = 0; i < fbVObject.length; i++) {  
    var fbRObject = fbVObject[i].innerHTML;
    var fbRObject = fbRObject.replace(/<!-- FBML /g, "");
    var fbRObject = fbRObject.replace(/ FBML -->/g, "");    
    fbVObject[i].innerHTML = fbRObject;
}
