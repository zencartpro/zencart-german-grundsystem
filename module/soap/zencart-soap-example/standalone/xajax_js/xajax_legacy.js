
try{if(undefined==xajax.legacy)
xajax.legacy={}
}catch(e){alert('An internal error has occurred: the xajax_core has not been loaded prior to xajax_legacy.');}
xajax.legacy.call=xajax.call;xajax.call=function(sFunction,objParameters){var oOpt={}
oOpt.parameters=objParameters;return xajax.legacy.call(sFunction,oOpt);}
xajax.legacy.isLoaded=true;