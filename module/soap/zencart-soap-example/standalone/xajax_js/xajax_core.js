
try{if(undefined==xajax.config)xajax.config={};}catch(e){xajax={};xajax.config={};}
xajax.config.setDefault=function(option,defaultValue){if(undefined==xajax.config[option])
xajax.config[option]=defaultValue;}
xajax.config.setDefault('waitCursor',false);xajax.config.setDefault('statusMessages',false);xajax.config.setDefault('baseDocument',document);xajax.config.setDefault('requestURI',xajax.config.baseDocument.URL);xajax.config.setDefault('defaultMode','asynchronous');xajax.config.setDefault('defaultHttpVersion','HTTP/1.1');xajax.config.setDefault('defaultContentType','application/x-www-form-urlencoded');xajax.config.setDefault('defaultResponseDelayTime',1000);xajax.config.setDefault('defaultExpirationTime',10000);xajax.config.setDefault('defaultMethod','post');xajax.config.setDefault('defaultRetry',5);xajax.config.setDefault('defaultReturnValue',false);xajax.tools={}
xajax.tools.queue={}
xajax.tools.queue.create=function(size){return{start:0,
size:size,
end:0,
commands:[],
timeout:null
}
}
xajax.tools.queue.retry=function(obj,count){var retries=obj.retries;if(retries){--retries;if(1 > retries)
return false;}else retries=count;obj.retries=retries;return true;}
xajax.tools.queue.rewind=function(theQ){if(0 < theQ.start)
--theQ.start;else
theQ.start=theQ.size;}
xajax.tools.queue.setWakeup=function(theQ,when){if(null!=theQ.timeout){clearTimeout(theQ.timeout);theQ.timeout=null;}
theQ.timout=setTimeout(function(){xajax.tools.queue.process(theQ);},10);}
xajax.tools.queue.process=function(theQ){if(null!=theQ.timeout){clearTimeout(theQ.timeout);theQ.timeout=null;}
var obj=xajax.tools.queue.pop(theQ);while(null!=obj){try{if(false==xajax.executeCommand(obj))
return false;}catch(e){}
obj=xajax.tools.queue.pop(theQ);}
return true;}
xajax.tools.queue.push=function(theQ,obj){var next=theQ.end+1;if(next > theQ.size)
next=0;if(next!=theQ.start){theQ.commands[theQ.end]=obj;theQ.end=next;}else
throw{name:'queue overflow',message:'cannot push object onto queue because it is full'}
}
xajax.tools.queue.pushFront=function(theQ,obj){xajax.tools.queue.rewind(theQ);theQ.commands[theQ.start]=obj;}
xajax.tools.queue.pop=function(theQ){var next=theQ.start;if(next==theQ.end)
return null;next++;if(next > theQ.size)
next=0;var obj=theQ.commands[theQ.start];theQ.commands[theQ.start]=null;theQ.start=next;return obj;}
xajax.tools.$=function(sId){if(!sId)
return null;var oDoc=xajax.config.baseDocument;var obj=oDoc.getElementById(sId);if(obj)
return obj;if(oDoc.all)
return oDoc.all[sId];return obj;}
xajax.tools.arrayContainsValue=function(array,valueToCheck){var i=0;var l=array.length;while(i < l){if(array[i]==valueToCheck)
return true;++i;}
return false;}
xajax.tools._escape=function(data){if(undefined==data)
return '';if('string'!=typeof(data))
return data;var needCDATA=false;if(encodeURIComponent(data)!=data){needCDATA=true;var segments=data.split("<![CDATA[");data='';for(var i=0;i < segments.length;++i){var segment=segments[i];var fragments=segment.split("]]>");segment='';for(var j=0;j < fragments.length;++j){if(0!=j)
segment+=']]]]><![CDATA[>';segment+=fragments[j];}
if(0!=i)
data+='<![]]><![CDATA[CDATA[';data+=segment;}
}
if(needCDATA)
data='<![CDATA['+data+']]>';return data;}
xajax.tools._objectToXML=function(obj,guard){if(undefined==guard.depth)
guard.depth=0;if(undefined==guard.size)
guard.size=0;if(20 < guard.depth)
return '';if(2000 < guard.size)
return '';var aXml=[];aXml.push("<xjxobj>");for(var key in obj){++guard.size;if(obj[key]){if("constructor"==key)
continue;if("function"==typeof(obj[key]))
continue;aXml.push("<e><k>");aXml.push(xajax.tools._escape(key));aXml.push("</k><v>");if("object"==typeof(obj[key])){++guard.depth;try{aXml.push(xajax.tools._objectToXML(obj[key],guard));}catch(e){}
--guard.depth;}else
aXml.push(xajax.tools._escape(obj[key]));aXml.push("</v></e>");}
}
aXml.push("</xjxobj>");return aXml.join('');}
xajax.tools._nodeToObject=function(node){if(null==node)
return '';if(undefined!=node.nodeName){if("#cdata-section"==node.nodeName||"#text"==node.nodeName){var data='';do if(undefined!=node.data)data+=node.data;while(node=node.nextSibling);return data;}else if("xjxobj"==node.nodeName){var key=null;var value=null;var data=new Array;var child=node.firstChild;do{if('e'==child.nodeName){var grandChild=child.firstChild;do{if('k'==grandChild.nodeName)
key=xajax.tools._nodeToObject(grandChild.firstChild);else('v'==grandChild.nodeName)
value=xajax.tools._nodeToObject(grandChild.firstChild);}while(grandChild=grandChild.nextSibling);if(null!=key&&null!=value){data[key]=value;key=value=null;}
}
}while(child=child.nextSibling);return data;}
}
throw{name:'Invalid XML',message:'The response contains an unknown tag: '+node.nodeName};}
if("undefined"!=typeof XMLHttpRequest){xajax.tools.getRequestObject=function(){return new XMLHttpRequest();}
}else if("undefined"!=typeof ActiveXObject){xajax.tools.getRequestObject=function(){try{return new ActiveXObject("Msxml2.XMLHTTP.4.0");}catch(e){try{return new ActiveXObject("Msxml2.XMLHTTP");}catch(e2){try{}catch(e3){return new ActiveXObject("Microsoft.XMLHTTP");}
}
}
}
}else if(window.createRequest){xajax.tools.getRequestObject=function(){return window.createRequest();}
}else{xajax.tools.getRequestObject=function(){return null;}
}
xajax.tools.getBrowserHTML=function(sValue){var oDoc=xajax.config.baseDocument;if(!oDoc.body)
return '';var elWorkspace=xajax.$('xajax_temp_workspace');if(!elWorkspace){elWorkspace=oDoc.createElement("div");elWorkspace.setAttribute('id','xajax_temp_workspace');elWorkspace.style.display="none";elWorkspace.style.visibility="hidden";oDoc.body.appendChild(elWorkspace);}
elWorkspace.innerHTML=sValue;var browserHTML=elWorkspace.innerHTML;elWorkspace.innerHTML='';return browserHTML;}
xajax.tools.willChange=function(element,attribute,newData){if("string"==typeof(element))
element=xajax.$(element);if(element){var oldData;eval("oldData=element."+attribute);return(newData!==oldData);}
return false;}
xajax.tools.getFormValues=function(element){var submitDisabledElements=false;if(arguments.length > 1&&arguments[1]==true)
submitDisabledElements=true;var prefix="";if(arguments.length > 2)
prefix=arguments[2];if("string"==typeof(element))
element=xajax.$(element);var aXml=new Array;aXml.push("<xjxquery><q>");if(element&&element.tagName&&"FORM"==element.tagName.toUpperCase()){var formElements=element.elements;for(var i=0;i < formElements.length;++i){var child=formElements[i];if(!child.name)
continue;if(prefix!=child.name.substring(0,prefix.length))
continue;if(child.type&&(child.type=='radio'||child.type=='checkbox')&&child.checked==false)
continue;if(child.disabled&&true==child.disabled&&false==submitDisabledElements)
continue;var name=child.name;if(name){if(1 < aXml.length)
aXml.push('&');if('select-multiple'==child.type){if(name.substr(name.length-2,2)!='[]')
name+='[]';for(var j=0;j < child.length;++j){var option=child.options[j];if(true==option.selected){aXml.push(name);aXml.push("=");aXml.push(encodeURIComponent(option.value));aXml.push("&");}
}
}else{aXml.push(name);aXml.push("=");aXml.push(encodeURIComponent(child.value));}
}
}
}
aXml.push("</q></xjxquery>");return aXml.join('');}
xajax.tools.stripOnPrefix=function(sEventName){sEventName=sEventName.toLowerCase();if(0==sEventName.indexOf('on'))
sEventName=sEventName.replace(/on/,'');return sEventName;}
xajax.tools.addOnPrefix=function(sEventName){sEventName=sEventName.toLowerCase();if(0!=sEventName.indexOf('on'))
sEventName='on'+sEventName;return sEventName;}
xajax.response=xajax.tools.queue.create(1000);xajax.commands=[];xajax.commands['rcmplt']=function(args){xajax.completeResponse(args.request);return true;}
xajax.responseSuccessCodes=['0','200'];xajax.responseErrorsForAlert=['400','401','402','403','404','500','501','502','503'];xajax.responseRedirectCodes=['301','302','307'];xajax.config.status={update:function(){return{onRequest:function(){window.status="Sending Request...";},
onWaiting:function(){window.status="Waiting for Response...";},
onProcessing:function(){window.status="Processing...";},
onComplete:function(){window.status="Done.";}
}
},
dontUpdate:function(){return{onRequest:function(){},
onWaiting:function(){},
onProcessing:function(){},
onComplete:function(){}
}
}
}
xajax.config.cursor={update:function(){return{onWaiting:function(){if(xajax.config.baseDocument.body)
xajax.config.baseDocument.body.style.cursor='wait';},
onComplete:function(){xajax.config.baseDocument.body.style.cursor='auto';}
}
},
dontUpdate:function(){return{onWaiting:function(){},
onComplete:function(){}
}
}
}
xajax.initializeRequest=function(oRequest){oRequest.set=function(option,defaultValue){if(undefined==this[option])
this[option]=defaultValue;}
var xx=xajax;var xc=xx.config;oRequest.set('statusMessages',xc.statusMessages);oRequest.set('waitCursor',xc.waitCursor);oRequest.set('mode',xc.defaultMode);oRequest.set('method',xc.defaultMethod);oRequest.set('URI',xc.requestURI);oRequest.set('httpVersion',xc.defaultHttpVersion);oRequest.set('contentType',xc.defaultContentType);oRequest.set('retry',xc.defaultRetry);oRequest.set('returnValue',xc.defaultReturnValue);var xcb=xx.callback;var gcb=xcb.global;var lcb=xcb.create();lcb.take=function(frm,opt){if(undefined!=frm[opt]){lcb[opt]=frm[opt];lcb.hasEvents=true;}
frm[opt]=undefined;}
lcb.take(oRequest,'onRequest');lcb.take(oRequest,'onResponseDelay');lcb.take(oRequest,'onExpiration');lcb.take(oRequest,'beforeResponseProcessing');lcb.take(oRequest,'onFailure');lcb.take(oRequest,'onRedirect');lcb.take(oRequest,'onSuccess');lcb.take(oRequest,'onComplete');if(undefined!=oRequest.callback){if(lcb.hasEvents)
oRequest.callback=[oRequest.callback,lcb];}else
oRequest.callback=lcb;oRequest.status=(oRequest.statusMessages)
? xc.status.update()
:xc.status.dontUpdate();oRequest.cursor=(oRequest.waitCursor)
? xc.cursor.update()
:xc.cursor.dontUpdate();oRequest.method=oRequest.method.toLowerCase();if('get'!=oRequest.method)
oRequest.method='post';oRequest.setCommonRequestHeaders=function(){this.request.setRequestHeader('If-Modified-Since','Sat, 1 Jan 2000 00:00:00 GMT');}
if(undefined==oRequest.URI)
throw{name:'Invalid request',message:'Missing requestURI; autodetection failed; please specify a one explicitly.'}
}
xajax.processParameters=function(oRequest){var xx=xajax;var xt=xx.tools;var rd=[];rd.push("xajax=");rd.push(encodeURIComponent(oRequest.functionName));rd.push("&xajaxr=");rd.push(new Date().getTime());if(oRequest.parameters){var i=0;var iLen=oRequest.parameters.length;while(i < iLen){var oVal=oRequest.parameters[i];if("object"==typeof(oVal)){try{oVal=xt._objectToXML(oVal,{});}catch(e){oVal='';}
}else
oVal=xt._escape(oVal);rd.push("&xajaxargs[]=");rd.push(encodeURIComponent(oVal));++i;}
}
oRequest.parameters=undefined;if('get'==oRequest.method){oRequest.URI+=oRequest.URI.indexOf('?')==-1 ? '?':'&';oRequest.URI+=rd.join('');rd=[];}
oRequest.requestData=rd.join('');}
xajax.prepareRequest=function(oRequest){var xx=xajax;var xt=xx.tools;oRequest.request=xt.getRequestObject();if('asynchronous'==oRequest.mode){oRequest.request.onreadystatechange=function(){if(oRequest.request.readyState!=4)
return;xajax.responseReceived(oRequest);}
oRequest.finishRequest=function(){return this.returnValue;}
}else{oRequest.finishRequest=function(){return xajax.responseReceived(oRequest);}
}
oRequest.open=function(){this.request.open(this.method,this.URI,'asynchronous'==this.mode);}
if('post'==oRequest.method){oRequest.setRequestHeaders=function(){this.setCommonRequestHeaders();try{this.request.setRequestHeader('Method','POST '+this.URI+' '+this.httpVersion);this.request.setRequestHeader('content-type',this.contentType);}catch(e){this.method='get';this.URI+=this.URI.indexOf('?')==-1 ? '?':'&';this.URI+=this.requestData;this.requestData='';if(0==this.retry)this.retry=1;throw e;}
}
}else{oRequest.setRequestHeaders=oRequest.setCommonRequestHeaders;}
}
xajax.call=function(){var numArgs=arguments.length;if(0==numArgs)
return false;var oRequest={}
if(1 < numArgs)
oRequest=arguments[1];oRequest.functionName=arguments[0];var xx=xajax;xx.initializeRequest(oRequest);xx.processParameters(oRequest);while(0 < oRequest.retry){try{--oRequest.retry;xx.prepareRequest(oRequest);return xx.submitRequest(oRequest);}catch(e){xajax.callback.execute(
[xajax.callback.global,oRequest.callback],
'onFailure',oRequest);if(0==oRequest.retry)
throw e;}
}
}
xajax.submitRequest=function(oRequest){oRequest.status.onRequest();var xcb=xajax.callback;var gcb=xcb.global;var lcb=oRequest.callback;xcb.execute([gcb,lcb],'onResponseDelay',oRequest);xcb.execute([gcb,lcb],'onExpiration',oRequest);xcb.execute([gcb,lcb],'onRequest',oRequest);oRequest.open();oRequest.setRequestHeaders();oRequest.cursor.onWaiting();oRequest.status.onWaiting();xajax._internalSend(oRequest);return oRequest.finishRequest();}
xajax._internalSend=function(oRequest){oRequest.request.send(oRequest.requestData);}
xajax.abortRequest=function(oRequest){oRequest.aborted=true;oRequest.request.abort();xajax.completeResponse(oRequest);}
xajax.responseReceived=function(oRequest){var xx=xajax;var xcb=xx.callback;var gcb=xcb.global;var lcb=oRequest.callback;if(oRequest.aborted)
return;xcb.clearTimer([gcb,lcb],'onExpiration');xcb.clearTimer([gcb,lcb],'onResponseDelay');xcb.execute([gcb,lcb],'beforeResponseProcessing',oRequest);var fProc=xx.getResponseProcessor(oRequest);if(undefined==fProc){xcb.execute([gcb,lcb],'onFailure',oRequest);xx.completeResponse(oRequest);return;}
return fProc(oRequest);}
xajax.getResponseProcessor=function(oRequest){var fProc;if(undefined==oRequest.responseProcessor){var cTyp=oRequest.request.getResponseHeader('content-type');if(cTyp){if(0 <=cTyp.indexOf('text/xml')){fProc=xajax.responseProcessor.xml;}
}
}else fProc=oRequest.responseProcessor;return fProc;}
xajax.responseProcessor={};xajax.responseProcessor.xml=function(oRequest){var xx=xajax;var xt=xx.tools;var xcb=xx.callback;var gcb=xcb.global;var lcb=oRequest.callback;var oRet=oRequest.returnValue;var request=oRequest.request;var status=request.status;if(xt.arrayContainsValue(xx.responseSuccessCodes,status)){xcb.execute([gcb,lcb],'onSuccess',oRequest);var seq=0;if(request.responseXML){var responseXML=request.responseXML;if(responseXML.documentElement){oRequest.status.onProcessing();var child=responseXML.documentElement.firstChild;while(child){if('cmd'==child.nodeName){var obj={};obj.cmdFullName='*unknown*';obj.sequence=seq;obj.request=oRequest;xx.parseAttributes(child,obj);xx.parseChildren(child,obj);xt.queue.push(xx.response,obj);}else if('xjxrv'==child.nodeName){oRet=xt._nodeToObject(child.firstChild);}else if('debugmsg'==child.nodeName){}else
throw{name:'Invalid response',message:'The response contains an unexpected tag or text: '+child.nodeName}
++seq;child=child.nextSibling;}
}
}
var obj={};obj.cmdFullName='Response Complete';obj.sequence=seq;obj.request=oRequest;obj.cmd='rcmplt';xt.queue.push(xx.response,obj);if(null==xx.response.timeout)
xt.queue.process(xx.response);}else if(xt.arrayContainsValue(xx.responseRedirectCodes,status)){xcb.execute([gcb,lcb],'onRedirect',oRequest);window.location=request.getResponseHeader("location");xx.completeResponse(oRequest);}else if(xt.arrayContainsValue(xx.responseErrorsForAlert,status)){xcb.execute([gcb,lcb],'onFailure',oRequest);xx.completeResponse(oRequest);}
return oRet;}
xajax.parseAttributes=function(child,obj){var iLen=child.attributes.length;for(var i=0;i < iLen;++i){var attr=child.attributes[i];switch(attr.name){case "n":
obj.cmd=attr.value;break;case "t":
obj.id=attr.value;break;case "p":
obj.property=attr.value;break;case "c":
obj.type=attr.value;break;case "f":
obj.func=attr.value;break;}
}
}
xajax.parseChildren=function(child,obj){obj.data='';if(0 < child.childNodes.length){if(1 < child.childNodes.length){var grandChild=child.firstChild;do{if('#cdata-section'==grandChild.nodeName||'#text'==grandChild.nodeName){obj.data+=grandChild.data;}
}while(grandChild=grandChild.nextSibling);}else{var grandChild=child.firstChild;if('xjxobj'==grandChild.nodeName){obj.data=xajax.tools._nodeToObject(grandChild);}else if('#cdata-section'==grandChild.nodeName||'#text'==grandChild.nodeName){obj.data=grandChild.data;}
}
}else if(undefined!=child.data){obj.data=child.data;}
}
xajax.executeCommand=function(obj){if(xajax.commands[obj.cmd]){if(obj.id)
obj.objElement=xajax.$(obj.id);if(false==xajax.commands[obj.cmd](obj)){xajax.tools.queue.pushFront(xajax.response,obj);return false;}
}
return true;}
xajax.completeResponse=function(oRequest){xajax.callback.execute(
[xajax.callback.global,oRequest.callback],
'onComplete',oRequest);oRequest.cursor.onComplete();oRequest.status.onComplete();}
xajax.commands['css']=function(args){args.cmdFullName='includeCSS';return xajax.css.add(args.data);}
xajax.commands['rcss']=function(args){args.cmdFullName='removeCSS';return xajax.css.remove(args.data);}
xajax.commands['wcss']=function(args){args.cmdFullName='waitForCSS';return xajax.css.waitForCSS(args);}
xajax.commands['as']=function(args){args.cmdFullName='assign/clear';try{return xajax.dom.assign(args.objElement,args.property,args.data);}catch(e){}
return true;}
xajax.commands['ap']=function(args){args.cmdFullName='append';return xajax.dom.append(args.objElement,args.property,args.data);}
xajax.commands['pp']=function(args){args.cmdFullName='prepend';return xajax.dom.prepend(args.objElement,args.property,args.data);}
xajax.commands['rp']=function(args){args.cmdFullName='replace';return xajax.dom.replace(args.id,args.property,args.data);}
xajax.commands['rm']=function(args){args.cmdFullName='remove';return xajax.dom.remove(args.id);}
xajax.commands['ce']=function(args){args.cmdFullName='create';return xajax.dom.create(args.id,args.data,args.property);}
xajax.commands['ie']=function(args){args.cmdFullName='insert';return xajax.dom.insert(args.id,args.data,args.property);}
xajax.commands['ia']=function(args){args.cmdFullName='insertAfter';return xajax.dom.insertAfter(args.id,args.data,args.property);}
xajax.commands['wf']=function(args){args.cmdFullName='waitFor';return xajax.js.waitFor(args);}
xajax.commands['ino']=function(args){args.cmdFullName='includeScriptOnce';return xajax.js.includeScriptOnce(args.data);}
xajax.commands['in']=function(args){args.cmdFullName='includeScript';return xajax.js.includeScript(args.data);}
xajax.commands['rjs']=function(args){args.cmdFullName='removeScript';if('object'==typeof args.data){if(2==args.data.length)
return xajax.js.removeScript(args.data[0],args.data[1]);else
return xajax.js.removeScript(args.data[0]);}else
return xajax.js.removeScript(args.data);}
xajax.commands['js']=function(args){args.cmdFullName='execute Javascript';return xajax.js.execute(args.data);}
xajax.commands['jc']=function(args){args.cmdFullName='call js function';return xajax.js.call(args.func,args.data);}
xajax.commands["al"]=function(args){args.cmdFullName="alert";alert(args.data);return true;}
xajax.commands["cc"]=function(args){args.cmdFullName="confirmCommands";return xajax.js.confirmCommands(args.data,args.id);}
xajax.commands["ci"]=function(args){args.cmdFullName="createInput";return xajax.forms.createInput(args.id,args.type,args.data,args.property);}
xajax.commands["ii"]=function(args){args.cmdFullName="insertInput";return xajax.forms.insertInput(args.id,args.type,args.data,args.property);}
xajax.commands["iia"]=function(args){args.cmdFullName="insertInputAfter";return xajax.forms.insertInputAfter(args.id,args.type,args.data,args.property);}
xajax.commands["ev"]=function(args){args.cmdFullName="addEvent";return xajax.events.setEvent(args.id,args.property,args.data);}
xajax.commands["ah"]=function(args){args.cmdFullName="addHandler";return xajax.events.addHandler(args.id,args.property,args.data);}
xajax.commands["rh"]=function(args){args.cmdFullName="removeHandler";return xajax.events.removeHandler(args.id,args.property,args.data);}
xajax.css={}
xajax.css.add=function(filename){var oDoc=xajax.config.baseDocument;var oHeads=oDoc.getElementsByTagName('head');var oHead=oHeads[0];var oLinks=oHead.getElementsByTagName('link');var found=false;var iLen=oLinks.length;for(var i=0;i < iLen&&false==found;++i)
if(0 < oLinks[i].href.indexOf(filename))
found=true;if(false==found){var oCSS=oDoc.createElement('link');oCSS.rel='stylesheet';oCSS.type='text/css';oCSS.href=filename;oHead.appendChild(oCSS);}
return true;}
xajax.css.remove=function(filename){var oDoc=xajax.config.baseDocument;var oHeads=oDoc.getElementsByTagName('head');var oHead=oHeads[0];var oLinks=oHead.getElementsByTagName('link');var i=0;while(i < oLinks.length)
if(0 <=oLinks[i].href.indexOf(filename))
oHead.removeChild(oLinks[i]);else++i;return true;}
xajax.css.waitForCSS=function(args){var oDocSS=xajax.config.baseDocument.styleSheets;var ssEnabled=[];var iLen=oDocSS.length;for(var i=0;i < iLen;++i){ssEnabled[i]=0;try{ssEnabled[i]=oDocSS[i].cssRules.length;}catch(e){try{ssEnabled[i]=oDocSS[i].rules.length;}catch(e){}
}
}
var ssLoaded=true;var iLen=ssEnabled.length;for(var i=0;i < iLen;++i)
if(0==ssEnabled[i])
ssLoaded=false;if(false==ssLoaded){if(xajax.tools.queue.retry(args,600)){xajax.tools.queue.setWakeup(xajax.response,10);return false;}
}
return true;}
xajax.dom={}
xajax.dom.assign=function(element,property,data){switch(property){case 'innerHTML':
element.innerHTML=data;break;case 'outerHTML':
if(undefined==element.outerHTML){var r=xajax.config.baseDocument.createRange();r.setStartBefore(element);var df=r.createContextualFragment(data);element.parentNode.replaceChild(df,element);}else element.outerHTML=data;break;default:
if(xajax.tools.willChange(element,property,data))
eval('element.'+property+' = data;');break;}
return true;}
xajax.dom.replace=function(element,sAttribute,aData){var sSearch=aData['s'];var sReplace=aData['r'];if(sAttribute=='innerHTML')
sSearch=xajax.tools.getBrowserHTML(sSearch);if("string"==typeof(element))
element=xajax.$(element);eval('var txt = element.'+sAttribute);var bFunction=false;if('function'==typeof(txt)){txt=txt.toString();bFunction=true;}
var start=txt.indexOf(sSearch);if(start >-1){var newTxt=[];while(start >-1){var end=start+sSearch.length;newTxt.push(txt.substr(0,start));newTxt.push(sReplace);txt=txt.substr(end,txt.length-end);start=txt.indexOf(sSearch);}
newTxt.push(txt);newTxt=newTxt.join('');if(bFunction){eval('element.'+sAttribute+'=newTxt;');}else if(xajax.tools.willChange(element,sAttribute,newTxt)){eval('element.'+sAttribute+'=newTxt;');}
}
return true;}
xajax.dom.remove=function(element){if('string'==typeof(element))
element=xajax.$(element);if(element&&element.parentNode&&element.parentNode.removeChild)
element.parentNode.removeChild(element);return true;}
xajax.dom.create=function(sParentId,sTag,sId){var objParent=xajax.$(sParentId);objElement=xajax.config.baseDocument.createElement(sTag);objElement.setAttribute('id',sId);if(objParent)
objParent.appendChild(objElement);return true;}
xajax.dom.append=function(element,property,data){eval('element.'+property+' += data;');return true;}
xajax.dom.prepend=function(element,property,data){eval('element.'+property+' = data + element.'+property);return true;}
xajax.dom.insert=function(sBeforeId,sTag,sId){var objSibling=xajax.$(sBeforeId);objElement=xajax.config.baseDocument.createElement(sTag);objElement.setAttribute('id',sId);objSibling.parentNode.insertBefore(objElement,objSibling);return true;}
xajax.dom.insertAfter=function(sAfterId,sTag,sId){var objSibling=xajax.$(sAfterId);objElement=xajax.config.baseDocument.createElement(sTag);objElement.setAttribute('id',sId);objSibling.parentNode.insertBefore(objElement,objSibling.nextSibling);return true;}
xajax.js={}
xajax.js.includeScriptOnce=function(fileName){var oDoc=xajax.config.baseDocument;var loadedScripts=oDoc.getElementsByTagName('script');var iLen=loadedScripts.length;for(var i=0;i < iLen;++i){var script=loadedScripts[i];if(script.src){if(0 <=script.src.indexOf(fileName))
return;}
}
return xajax.js.includeScript(fileName);}
xajax.js.includeScript=function(fileName){var oDoc=xajax.config.baseDocument;var objHead=oDoc.getElementsByTagName('head');var objScript=oDoc.createElement('script');objScript.type='text/javascript';objScript.src=fileName;objHead[0].appendChild(objScript);return true;}
xajax.js.removeScript=function(fileName,unload){var oDoc=xajax.config.baseDocument;var loadedScripts=oDoc.getElementsByTagName('script');var iLen=loadedScripts.length;for(var i=0;i < iLen;++i){var script=loadedScripts[i];if(script.src){if(0 <=script.src.indexOf(fileName)){if(undefined!=unload)
xajax.js.execute(unload);var parent=script.parentNode;parent.removeChild(script);}
}
}
}
xajax.js.execute=function(script){var returnValue=true;eval(script);return returnValue;}
xajax.js.waitFor=function(args){var bResult=false;var cmdToEval='bResult = (';cmdToEval+=args.data;cmdToEval+=');';try{eval(cmdToEval);}catch(e){}
if(false==bResult){if(xajax.tools.queue.retry(args,600)){xajax.tools.queue.setWakeup(xajax.response,10);return false;}
}
return true;}
xajax.js.call=function(func,parameters){var scr=new Array();scr.push(func);scr.push('(');if(0 < parameters.length){scr.push('parameters[0]');for(var i=1;i < parameters.length;++i)
scr.push(', parameters['+i+']');}
scr.push(');');eval(scr.join(''));return true;}
xajax.js.confirmCommands=function(msg,numberOfCommands){if(false==confirm(msg)){while(0 < numberOfCommands){xajax.tools.queue.pop(xajax.response);--numberOfCommands;}
}
return true;}
xajax.forms={}
if(undefined==window.addEventListener){xajax.forms.getInput=function(type,name,id){return xajax.config.baseDocument.createElement('<input type="'+type+'" name="'+name+'" id="'+id+'">');}
}else{xajax.forms.getInput=function(type,name,id){var oDoc=xajax.config.baseDocument;var Obj=oDoc.createElement('input');Obj.setAttribute('type',type);Obj.setAttribute('name',name);Obj.setAttribute('id',id);return Obj;}
}
xajax.forms.createInput=function(sParentId,sType,sName,sId){var objParent=xajax.$(sParentId);var objElement=xajax.forms.getInput(sType,sName,sId);if(objParent&&objElement)
objParent.appendChild(objElement);return true;}
xajax.forms.insertInput=function(sBeforeId,sType,sName,sId){var objSibling=xajax.$(sBeforeId);var objElement=xajax.forms.getInput(sType,sName,sId);if(objElement&&objSibling&&objSibling.parentNode)
objSibling.parentNode.insertBefore(objElement,objSibling);return true;}
xajax.forms.insertInputAfter=function(sAfterId,sType,sName,sId){var objSibling=xajax.$(sAfterId);var objElement=xajax.forms.getInput(sType,sName,sId);if(objElement&&objSibling&&objSibling.parentNode)
objSibling.parentNode.insertBefore(objElement,objSibling.nextSibling);return true;}
xajax.events={}
xajax.events.setEvent=function(element,event,code){if('string'==typeof element)
element=xajax.$(element);event=xajax.tools.addOnPrefix(event);eval('element.'+event+' = function() { '+code+'; }');return true;}
if(window.addEventListener){xajax.events.addHandler=function(element,event,fun){if('string'==typeof element)
element=xajax.$(element);event=xajax.tools.stripOnPrefix(event);eval('element.addEventListener("'+event+'", '+fun+', false);');return true;}
}else{xajax.events.addHandler=function(element,event,fun){if('string'==typeof element)
element=xajax.$(element);event=xajax.tools.addOnPrefix(event);eval('element.attachEvent("'+event+'", '+fun+', false);');return true;}
}
if(window.addEventListener){xajax.events.removeHandler=function(element,event,fun){if('string'==typeof element)
element=xajax.$(element);event=xajax.tools.stripOnPrefix(event);eval('element.removeEventListener("'+event+'", '+fun+', false);');return true;}
}else{xajax.events.removeHandler=function(element,event,fun){if('string'==typeof element)
element=xajax.$(element);event=xajax.tools.addOnPrefix(event);eval('element.detachEvent("'+event+'", '+fun+', false);');return true;}
}
xajax.callback={}
xajax.callback.create=function(){var xx=xajax;var xc=xx.config;var xcb=xx.callback;var oCB={}
oCB.timers={};oCB.timers.onResponseDelay=xcb.setupTimer(
(arguments.length > 0)
? arguments[0]
:xc.defaultResponseDelayTime);oCB.timers.onExpiration=xcb.setupTimer(
(arguments.length > 1)
? arguments[1]
:xc.defaultExpirationTime);oCB.onRequest=null;oCB.onResponseDelay=null;oCB.onExpiration=null;oCB.beforeResponseProcessing=null;oCB.onFailure=null;oCB.onRedirect=null;oCB.onSuccess=null;oCB.onComplete=null;return oCB;}
xajax.callback.setupTimer=function(iDelay){return{timer:null,delay:iDelay};}
xajax.callback.clearTimer=function(oCallback,sFunction){if(undefined!=oCallback.timers){if(undefined!=oCallback.timers[sFunction]){clearTimeout(oCallback.timers[sFunction].timer);}
}else if('object'==typeof oCallback){var iLen=oCallback.length;for(var i=0;i < iLen;++i)
xajax.callback.clearTimer(oCallback[i],sFunction);}
}
xajax.callback.global=xajax.callback.create();xajax.callback.execute=function(oCallback,sFunction,args){if(undefined!=oCallback[sFunction]){var func=oCallback[sFunction];if(undefined!=oCallback.timers[sFunction]){oCallback.timers[sFunction].timer=setTimeout(function(){func(args);},oCallback.timers[sFunction].delay);}
else{func(args);}
}else if('object'==typeof oCallback){var iLen=oCallback.length;for(var i=0;i < iLen;++i)
xajax.callback.execute(oCallback[i],sFunction,args);}
}
xjx={}
xjx.$=xajax.tools.$;xjx.getFormValues=xajax.tools.getFormValues;xajax.$=xajax.tools.$;xajax.getFormValues=xajax.tools.getFormValues;xajax.isLoaded=true;