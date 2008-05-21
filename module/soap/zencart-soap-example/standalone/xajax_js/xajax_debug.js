
try{if(undefined==xajax.debug)
xajax.debug={}
}catch(e){alert('An internal error has occurred: the xajax_core has not been loaded prior to xajax_debug.');}
xajax.debug.workId='xajaxWork'+new Date().getTime();xajax.debug.windowSource='about:blank';xajax.debug.windowID='xajax_debug_'+xajax.debug.workId;xajax.debug.windowStyle='width=800,height=600,scrollbars=yes,resizable=yes,status=yes';xajax.debug.windowTemplate='<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"><html><head><title>xajax debug output</title><style type="text/css">.debugEntry { margin: 3px; padding: 3px; border-top: 1px solid #999999; } .debugDate { font-weight: bold; margin: 2px; } .debugText { margin: 2px; } .warningText { margin: 2px; font-weight: bold; } .errorText { margin: 2px; font-weight: bold; color: #ff7777; }</style></head><body><h2>xajax debug output</h2><div id="debugTag"></div></body></html>';xajax.debug.writeMessage=function(text,prefix,cls){try{var xd=xajax.debug;if(undefined==xd.window||true==xd.window.closed){xd.window=window.open(xd.windowSource,xd.windowID,xd.windowStyle);if("about:blank"==xd.windowSource)
xd.window.document.write(xd.windowTemplate);}
var xdw=xd.window;var xdwd=xdw.document;if(undefined==prefix)
prefix='';if(undefined==cls)
cls='debugText';text=text.replace('&','&amp;')
text=text.replace('<','&lt;')
text=text.replace('>','&gt;')
var debugTag=xdwd.getElementById('debugTag');var debugEntry=xdwd.createElement('div');var debugDate=xdwd.createElement('span');var debugText=xdwd.createElement('span');debugDate.innerHTML=new Date().toString();debugText.innerHTML=prefix+text;debugEntry.appendChild(debugDate);debugEntry.appendChild(debugText);debugTag.insertBefore(debugEntry,debugTag.firstChild);try{debugEntry.className='debugEntry';debugDate.className='debugDate';debugText.className=cls;}catch(e){}
}catch(e){if(text.length > 1000)
text=text.substr(0,1000)+'...\n[long response]\n...';alert('xajax debug:\n '+text);}
}
xajax.debug.executeCommand=xajax.executeCommand;xajax.executeCommand=function(args){try{if(xajax.commands[args.cmd]){return xajax.debug.executeCommand(args);}else{var msg='executeCommand: Command [';msg+=args.cmd;msg+='] invalid or missing.';xajax.debug.writeMessage(msg,'Error: ','errorText');}
}catch(e){var msg='While trying to execute [';msg+=args.cmdFullName;msg+=', command number ';msg+=args.sequence;msg+='], the following error occured:\n';msg+=e.name;msg+=': ';msg+=e.message;msg+='\n';xajax.debug.writeMessage(msg,'Error: ','errorText');}
return true;}
xajax.debug.parseAttributes=xajax.parseAttributes;xajax.parseAttributes=function(child,obj){try{xajax.debug.parseAttributes(child,obj);}catch(e){var msg='While parsing command attributes, the following error occured:\n';msg+=e.name;msg+=': ';msg+=e.message;msg+='\n';xajax.debug.writeMessage(msg,'Error: ','errorText');}
return true;}
xajax.debug.$=xajax.tools.$;xajax.tools.$=function(sId){var returnValue=xajax.debug.$(sId);if(null==returnValue){var msg='Element with the id "';msg+=sId;msg+='" not found.';xajax.debug.writeMessage(msg,'Warning: ','warningText');}
return returnValue;}
xajax.debug._objectToXML=xajax.tools._objectToXML;xajax.tools._objectToXML=function(obj,guard){try{return xajax.debug._objectToXML(obj,guard);}catch(e){var msg='_objectToXml: ';msg+=e.name;msg+=': ';msg+=e.message;xajax.debug.writeMessage(msg,'Error: ','errorText');}
return '';}
xajax.debug._internalSend=xajax._internalSend;xajax._internalSend=function(oRequest){xajax.debug.writeMessage('Sending request.');xajax.debug.writeMessage('Sent ['+oRequest.requestData.length+' bytes]');oRequest.beginDate=new Date();xajax.debug._internalSend(oRequest);}
xajax.debug.submitRequest=xajax.submitRequest;xajax.submitRequest=function(oRequest){var msg=oRequest.method;msg+=': ';msg+=decodeURIComponent(oRequest.requestData);xajax.debug.writeMessage(msg);msg='Calling ';msg+=oRequest.functionName;msg+=' uri=';msg+=oRequest.URI;xajax.debug.writeMessage(msg);try{return xajax.debug.submitRequest(oRequest);}catch(e){xajax.debug.writeMessage(e.message);if(0 < oRequest.retry)
throw e;}
}
xajax.debug.call=xajax.call;xajax.call=function(){var numArgs=arguments.length;if(0==numArgs){xajax.debug.writeMessage('Invalid xajax call, missing server function name.');return false;}
xajax.debug.writeMessage('Starting xajax...');var functionName=arguments[0];var oOptions={}
if(1 < numArgs)
oOptions=arguments[1];oOptions.debugging=true;return xajax.debug.call(functionName,oOptions);}
xajax.debug.responseProcessor={}
xajax.debug.getResponseProcessor=xajax.getResponseProcessor;xajax.getResponseProcessor=function(oRequest){var fProc=xajax.debug.getResponseProcessor(oRequest);if(undefined==fProc){var msg='No response processor is available to process the response from the server.  ';try{var contentType="Content-Type: ";contentType+=oRequest.request.getResponseHeader('content-type');msg+=contentType;}catch(e){}
xajax.debug.writeMessage(msg,'Error: ','errorText');}
return fProc;}
xajax.debug.responseReceived=xajax.responseReceived;xajax.responseReceived=function(oRequest){var xx=xajax;var xt=xx.tools;var xd=xx.debug;var oRet;try{var status=oRequest.request.status;if(xt.arrayContainsValue(xx.responseSuccessCodes,status)){var packet=oRequest.request.responseText;xd.writeMessage('Received [status: '+oRequest.request.status+', size: '+packet.length+' bytes]:\n'+packet);}else if(xt.arrayContainsValue(xx.responseErrorsForAlert,status)){var msg='The server returned the following HTTP status: ';msg+=status;msg+='\nReceived:\n';msg+=oRequest.request.responseText;xd.writeMessage(msg,'Error: ','errorText');}else if(xt.arrayContainsValue(xx.responseRedirectCodes,status)){var msg='The server returned a redirect to:\n';msg+=oRequest.request.getResponseHeader('location');xd.writeMessage(msg);}
oRet=xd.responseReceived(oRequest);}catch(e){var msg='responseReceived: ';msg+=e.name;msg+=': ';msg+=e.message;xd.writeMessage(msg,'Error: ','errorText');try{var contentType=oRequest.request.getResponseHeader('content-type');if(0 <=contentType.indexOf('text/html')){msg='Check for a PHP error in the data received (shown below).';xd.writeMessage(msg);}else if(0 <=contentType.indexOf('text/xml')){msg='Check for unexpected text in the response; may be from an echo or print statement.';xd.writeMessage(msg);}
}catch(e){}
}
return oRet;}
xajax.debug.completeResponse=xajax.completeResponse;xajax.completeResponse=function(oRequest){var returnValue=xajax.debug.completeResponse(oRequest);oRequest.endDate=new Date();xajax.debug.writeMessage('Done ['+(oRequest.endDate-oRequest.beginDate)+'ms]');return returnValue;}
xajax.debug.getRequestObject=xajax.tools.getRequestObject;xajax.tools.getRequestObject=function(){xajax.debug.writeMessage('Initializing Request Object..');var returnValue=xajax.debug.getRequestObject();if(null==returnValue)
xajax.debug.writeMessage('Request Object Instantiation failed.','Error: ','errorText');return returnValue;}
if(xajax.dom.assign){xajax.debug.assign=xajax.dom.assign;xajax.dom.assign=function(element,id,property,data){try{return xajax.debug.assign(element,id,property,data);}catch(e){var msg=e.message;msg+=' while executing element.';msg+=property;msg+=' = data;';xajax.debug.writeMessage(msg,'Error: ','errorText');}
return true;}
}
xjx={}
xjx.$=xajax.tools.$;xjx.getFormValues=xajax.tools.getFormValues;xajax.$=xajax.tools.$;xajax.getFormValues=xajax.tools.getFormValues;xajax.debug.isLoaded=true;