

  xajax.callback.global.onRequest = function() {xajax.$('loadingMessage').style.display = 'block';}
  xajax.callback.global.beforeResponseProcessing = function() {xajax.$('loadingMessage').style.display='none';}
