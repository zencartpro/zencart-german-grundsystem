/**
 * xajax_core.js
 * 
 * This file contains the definition of the main xajax class.
 * 
 * This is a required component of the xajax javascript code.  Include this
 * file in the HEAD of each page for which you wish to use xajax.
 */

/**
 * The main xajax object
 */
try {
	if (undefined == xajax.config) xajax.config = {};
} catch (e) {
	xajax = {};
	xajax.config = {};
}

/**
 * xajax.config
 * 
 * Base of all xajax config flags and settings.  These are application level
 * settings; however, they can be overridden on a per call basis.
 * 
 * current settings include:
 * 
 * (boolean) waitCursor:
 *     indicates whether the cursor should be changed to a 'wait' cursor while
 *     a request is being sent/processed
 * (boolean) statusMessages:
 *     indicates whether status messages should be displayed on the browser's
 *     status bar while a request is being sent/processed
 * (string) requestURI:
 *     provides the default URI for sending requests to the server
 * (DOM Document Object) baseDocument:
 *     the base document (context) for which all response commands will execute
 *     setting this to an iframe will cause response commands to modify
 *     the DOM of the iframe
 * (string) defaultMode:
 *     'asynchronous' - control will return to the browser immediately, the 
 *     response will be processed when it is returned from the server.
 *     'synchronous' - control will not return to the browser until the
 *     response has been received from the server and processed.
 * (string) defaultHttpVersion:
 *     controls the http version sent as part of a post request to the server
 * (string) defaultContentType:
 *     specifies the default content-type used as part of a post request
 * (integer) defaultResponseDelayTime:
 *     number of milliseconds before the onRequestDelay callback event is fired
 * (integer) defaultExpirationTime:
 *     number of milliseconds before the onExpiration callback event is fired
 * (string) defaultMethod:
 *     'post' - xajax will attempt to send each request as a form post.
 *     'get' - xajax will attempt to send each request as a get.
 * (integer) defaultRetry:
 *     number of times the request will be sent, xajax will automatically
 *     retry if the connection fails; the request will not be retried if the
 *     server returns data, even when an error code is returned
 * (any data type) defaultReturnValue:
 *     the value returned from the xajax.call command; for synchronous calls
 *     this value may be overridden by the response from the server
 */
xajax.config.setDefault = function(option, defaultValue) {
	if (undefined == xajax.config[option])
		xajax.config[option] = defaultValue;
}
xajax.config.setDefault('waitCursor', false);
xajax.config.setDefault('statusMessages', false);
xajax.config.setDefault('baseDocument', document);
xajax.config.setDefault('requestURI', xajax.config.baseDocument.URL);
xajax.config.setDefault('defaultMode', 'asynchronous');
xajax.config.setDefault('defaultHttpVersion', 'HTTP/1.1');
xajax.config.setDefault('defaultContentType', 'application/x-www-form-urlencoded');
xajax.config.setDefault('defaultResponseDelayTime', 1000);
xajax.config.setDefault('defaultExpirationTime', 10000);
xajax.config.setDefault('defaultMethod', 'post');
xajax.config.setDefault('defaultRetry', 5);
xajax.config.setDefault('defaultReturnValue', false);

/**
 * xajax.tools
 *
 * Base of all xajax utility functions
 **/
xajax.tools = {}
 
/**
 * xajax.tools.queue
 * 
 * This contains all the variables and code for handling the response
 * command queue.  To add a command to the queue, simply call push(); to 
 * "re-add" a command at the front of the queue, call pushFront(); retrieve
 * the next command using pop();
 * 
 * start, size and end are used to maintain the queue; implemented as a 
 * ring buffer, the queue is empty when the start = the end; push adds
 * commands to the end of the queue; the queue is full when the end is one
 * less than the start; start and end are wrapped at size entries; commands
 * is the actual buffer; timeout is used to restart the queue processing
 * when a delay is needed.
 */
xajax.tools.queue = {}
xajax.tools.queue.create = function(size) {
	return {
		start: 0,
		size: size,
		end: 0,
		commands: [],
		timeout: null
	}
}
xajax.tools.queue.retry = function(obj, count) {
	var retries = obj.retries;
	if (retries) {
		--retries;
		if (1 > retries)
			return false;
	} else retries = count;
	obj.retries = retries;
	return true;
}
xajax.tools.queue.rewind = function(theQ) {
	if (0 < theQ.start)
		--theQ.start;
	else
		theQ.start = theQ.size;
}
xajax.tools.queue.setWakeup = function(theQ, when) {
	if (null != theQ.timeout) {
		clearTimeout(theQ.timeout);
		theQ.timeout = null;
	}
	theQ.timout = setTimeout(function() { xajax.tools.queue.process(theQ); }, 10);
}
xajax.tools.queue.process = function(theQ) {
	// clear the timeout, this function is not designed to be
	// reentrant
	if (null != theQ.timeout) {
		clearTimeout(theQ.timeout);
		theQ.timeout = null;
	}
	var obj = xajax.tools.queue.pop(theQ);
	while (null != obj) {
		try {
			if (false == xajax.executeCommand(obj)) 
				return false;
		} catch (e) {
			// do nothing, if the debug module is installed, it will
			// catch the exception and handle it
		}
		obj = xajax.tools.queue.pop(theQ);
	}
	return true;
}
xajax.tools.queue.push = function(theQ, obj) {
	var next = theQ.end + 1;
	if (next > theQ.size)
		next = 0;
	if (next != theQ.start) {				
		theQ.commands[theQ.end] = obj;
		theQ.end = next;
	} else
		throw { name: 'queue overflow', message: 'cannot push object onto queue because it is full' }
}
xajax.tools.queue.pushFront = function(theQ, obj) {
	xajax.tools.queue.rewind(theQ);
	theQ.commands[theQ.start] = obj;
}
xajax.tools.queue.pop = function(theQ) {
	var next = theQ.start;
	if (next == theQ.end)
		return null;
	next++;
	if (next > theQ.size)
		next = 0;
	var obj = theQ.commands[theQ.start];
	theQ.commands[theQ.start] = null;
	theQ.start = next;
	return obj;
}

/**
 * xajax.tools.$
 * 
 * This is shorthand for document.getElementById()
 * 
 * @param {string} sId	The ID of the element desired
 */
xajax.tools.$ = function(sId) {
	if (!sId)
		return null;
	
	var oDoc = xajax.config.baseDocument;

	var obj = oDoc.getElementById(sId);
	if (obj)
		return obj;
		
	if (oDoc.all)
		return oDoc.all[sId];

	return obj;
}

/**
 * xajax.tools.arrayContainsValue
 * 
 * This function looks for valueToCheck in array, if found, returns true;
 * otherwise returns false;
 * 
 * @param {Object} array
 * @param {Object} valueToCheck
 */
xajax.tools.arrayContainsValue = function(array, valueToCheck) {
	var i = 0;
	var l = array.length;
	while (i < l) {
		if (array[i] == valueToCheck)
			return true;
		++i;
	}
	return false;
}

/**
 * xajax.tools._escape
 * 
 * This function determines if the data contains special characters and
 * creates a CDATA section so the data can be safely transmitted via the
 * http protocol
 * 
 * @param {Object} data
 */
xajax.tools._escape = function(data) {
	if (undefined == data)
		return '';
	
	if ('string' != typeof (data))
		return data;
	
	var needCDATA = false;
	
	if (encodeURIComponent(data) != data) {
		needCDATA = true;
		
		var segments = data.split("<![CDATA[");
		data = '';
		for(var i = 0; i < segments.length; ++i) {
			var segment = segments[i];
			var fragments = segment.split("]]>");
			segment = '';
			for (var j = 0; j < fragments.length; ++j) {
				if (0 != j)
					segment += ']]]]><![CDATA[>';
				segment += fragments[j];
			}
			if (0 != i)
				data += '<![]]><![CDATA[CDATA[';
			data += segment;
		}
	}
	
	if (needCDATA)
		data = '<![CDATA[' + data + ']]>';
	
	return data;
}

/**
 * xajax.tools._objectToXML
 * 
 * This function converts javascript arrays and objects 
 * into XML suitable for inclusion in the request data.
 * 
 * @param {Object} obj
 * @param {Object} guard
 * 
 * guard is an object, therefore passed by reference, which
 * maintains the state of the recursion; this allows the 
 * function to cap off at a specified depth or number of
 * entries.
 * 
 * TODO: allow the caller to specify the max depth and size
 * by passing parameters in the guard object.
 */
xajax.tools._objectToXML = function(obj, guard) {
	if (undefined == guard.depth)
		guard.depth = 0;
	if (undefined == guard.size)
		guard.size = 0;
	if (20 < guard.depth)
		return '';
	if (2000 < guard.size)
		return '';

	var aXml = [];
	aXml.push("<xjxobj>");
	for (var key in obj) {
		++guard.size;
		if (obj[key]) {
			if ("constructor" == key)
				continue;
			if ("function" == typeof (obj[key]))
				continue;
			aXml.push("<e><k>");
			aXml.push(xajax.tools._escape(key));
			aXml.push("</k><v>");
			if ("object" == typeof (obj[key])) {
				++guard.depth;
				try {
					aXml.push(xajax.tools._objectToXML(obj[key], guard));
				} catch (e) {
					// do nothing, if the debug module is installed
					// it will catch the exception and handle it
				}
				--guard.depth;
			} else
				aXml.push(xajax.tools._escape(obj[key]));

			aXml.push("</v></e>");
		}
	}
	aXml.push("</xjxobj>");

	return aXml.join('');
}

/**
 * xajax.tools._nodeToObject
 * 
 * This function deserializes the data from the XML tree starting
 * with node.  This can be thought of as the opposite of 
 * xajaxResponse::_buildObjXml()
 * 
 * @param {Object} node
 */
xajax.tools._nodeToObject = function(node) {
	if (null == node)
		return '';
		
	if (undefined != node.nodeName) {
		if ("#cdata-section" == node.nodeName || "#text" == node.nodeName) {
			var data = '';
			do if (undefined != node.data) data += node.data; while (node = node.nextSibling);
			return data;
		} else if ("xjxobj" == node.nodeName) {
			var key = null;
			var value = null;
			var data = new Array;
			var child = node.firstChild;
			do {
				if ('e' == child.nodeName) {
					var grandChild = child.firstChild;
					do {
						if ('k' == grandChild.nodeName)
							key = xajax.tools._nodeToObject(grandChild.firstChild);
						else ('v' == grandChild.nodeName)
							value = xajax.tools._nodeToObject(grandChild.firstChild);
					} while (grandChild = grandChild.nextSibling);
					if (null != key && null != value) {
						data[key] = value;
						key = value = null;
					}
				}
			} while (child = child.nextSibling);
			return data;
		}
	}
	
	throw { name: 'Invalid XML', message: 'The response contains an unknown tag: ' + node.nodeName };
}

/**
 * xajax.tools.getRequestObject
 * 
 * This function constructs an XMLHttpRequest object
 * taking into account the various browsers and their support.
 */
if ("undefined" != typeof XMLHttpRequest) {
	xajax.tools.getRequestObject = function() {
		return new XMLHttpRequest();
	}
} else if ("undefined" != typeof ActiveXObject) {
	xajax.tools.getRequestObject = function() {
		try {
			return new ActiveXObject("Msxml2.XMLHTTP.4.0");
		} catch (e) {
			try {
				return new ActiveXObject("Msxml2.XMLHTTP");
			} catch (e2) {
				try {
				} catch (e3) {
					return new ActiveXObject("Microsoft.XMLHTTP");
				}
			}
		}
	}
} else if (window.createRequest) {
	xajax.tools.getRequestObject = function() {
		return window.createRequest();
	}
} else {
	xajax.tools.getRequestObject = function() {
		return null;
	}
}

/**
 * xajax.tools.getBrowserHTML
 * 
 * Gets the text as it would be if it were being retrieved from
 * the innerHTML property in the current browser
 * 
 * @param {Object} html
 */
xajax.tools.getBrowserHTML = function(sValue) {
	var oDoc = xajax.config.baseDocument;
	if (!oDoc.body)
		return '';
		
	var elWorkspace = xajax.$('xajax_temp_workspace');
	if (!elWorkspace)
	{
		elWorkspace = oDoc.createElement("div");
		elWorkspace.setAttribute('id', 'xajax_temp_workspace');
		elWorkspace.style.display = "none";
		elWorkspace.style.visibility = "hidden";
		oDoc.body.appendChild(elWorkspace);
	}
	elWorkspace.innerHTML = sValue;
	var browserHTML = elWorkspace.innerHTML;
	elWorkspace.innerHTML = '';	
	
	return browserHTML;
}

/**
 * xajax.tools.willChange
 * 
 * This function tests to see if the new data is the same as
 * the existing data.
 * 
 * @param {Object} element
 * @param {Object} attribute
 * @param {Object} newData
 */
xajax.tools.willChange = function(element, attribute, newData) {
	if ("string" == typeof (element))
		element = xajax.$(element);
	if (element) {
		var oldData;		
		eval("oldData=element."+attribute);
		return (newData !== oldData);
	}

	return false;
}

/**
 * xajax.tools.getFormValues
 * 
 * This function builds a query string XML message from the elements
 * of a form.
 * 
 * The first argument is the id of the form
 * The second argument (optional) can be set to true if you want to submit disabled elements
 * The third argument (optional) allows you to specify a string prefix that a form element
   name must contain if you want that element to be submitted
 * 
 * @param {Object} frm
 */
xajax.tools.getFormValues = function(element) {
	var submitDisabledElements = false;
	if (arguments.length > 1 && arguments[1] == true)
		submitDisabledElements = true;
	
	var prefix="";
	if(arguments.length > 2)
		prefix = arguments[2];
	
	if ("string" == typeof(element))
		element = xajax.$(element);
	
	var aXml = new Array;
	aXml.push("<xjxquery><q>");
	if (element && element.tagName && "FORM" == element.tagName.toUpperCase()) {
		var formElements = element.elements;
		for (var i = 0; i < formElements.length; ++i) {
			var child = formElements[i];
			if (!child.name)
				continue;
			if (prefix != child.name.substring(0, prefix.length))
				continue;
			if (child.type && (child.type == 'radio' || child.type == 'checkbox') && child.checked == false)
				continue;
			if (child.disabled && true == child.disabled && false == submitDisabledElements)
				continue;
			var name = child.name;
			if (name) {
				if (1 < aXml.length)
					aXml.push('&');
				if('select-multiple' == child.type) {
					if (name.substr(name.length-2, 2) != '[]')
						name += '[]';
					for (var j = 0; j < child.length; ++j) {
						var option = child.options[j];
						if (true == option.selected) {
							aXml.push(name);
							aXml.push("=");
							aXml.push(encodeURIComponent(option.value));
							aXml.push("&");
						}
					}
				} else {
					aXml.push(name);
					aXml.push("=");
					aXml.push(encodeURIComponent(child.value));
				}
			} 
		}
	}
	
	aXml.push("</q></xjxquery>");
	
	return aXml.join('');
}

/**
 * xajax.tools.stripOnPrefix
 * 
 * This helper function detects and removes the on prefix
 * for an event handler function name.
 * 
 * @param {Object} sEventName
 */
xajax.tools.stripOnPrefix = function(sEventName) {
	sEventName = sEventName.toLowerCase();
	if (0 == sEventName.indexOf('on'))
		sEventName = sEventName.replace(/on/,'');
	
	return sEventName;
}

/**
 * xajax.tools.addOnPrefix
 * 
 * This helper function detects or adds the on prefix
 * for an event handler function name.
 * 
 * @param {Object} sEventName
 */
xajax.tools.addOnPrefix = function(sEventName) {
	sEventName = sEventName.toLowerCase();
	if (0 != sEventName.indexOf('on'))
		sEventName = 'on' + sEventName;
	
	return sEventName;
}

/**
 * xajax.response
 *
 * queue object to hold response commands until they
 * are processed
 **/
xajax.response = xajax.tools.queue.create(1000);

/**
 * xajax.commands
 * 
 * This is the array of command handlers that are currently installed /
 * loaded.  As new commands are loaded, they will be added by key (command
 * nickname) (ie. xajax.commands['js'] = function(args) { ... }
 */
xajax.commands = [];
xajax.commands['rcmplt'] = function(args) {
	xajax.completeResponse(args.request);
	return true;
}

/**
 * xajax.responseSuccessCodes,
 * xajax.responseErrorsForAlert
 * 
 * These arrays contain the response codes that will be returned from the
 * web server.  The success codes will indicate a successful completion of
 * the request; a responseXML will be expected in this case.
 */
xajax.responseSuccessCodes = ['0', '200'];

// 10.4.1 400 Bad Request
// 10.4.2 401 Unauthorized
// 10.4.3 402 Payment Required
// 10.4.4 403 Forbidden
// 10.4.5 404 Not Found
// 10.4.6 405 Method Not Allowed
// 10.4.7 406 Not Acceptable
// 10.4.8 407 Proxy Authentication Required
// 10.4.9 408 Request Timeout
// 10.4.10 409 Conflict
// 10.4.11 410 Gone
// 10.4.12 411 Length Required
// 10.4.13 412 Precondition Failed
// 10.4.14 413 Request Entity Too Large
// 10.4.15 414 Request-URI Too Long
// 10.4.16 415 Unsupported Media Type
// 10.4.17 416 Requested Range Not Satisfiable
// 10.4.18 417 Expectation Failed
// 10.5 Server Error 5xx
// 10.5.1 500 Internal Server Error
// 10.5.2 501 Not Implemented
// 10.5.3 502 Bad Gateway
// 10.5.4 503 Service Unavailable
// 10.5.5 504 Gateway Timeout
// 10.5.6 505 HTTP Version Not Supported
xajax.responseErrorsForAlert = ['400','401','402','403','404','500','501','502','503'];

// 10.3.1 300 Multiple Choices
// 10.3.2 301 Moved Permanently
// 10.3.3 302 Found
// 10.3.4 303 See Other
// 10.3.5 304 Not Modified
// 10.3.6 305 Use Proxy
// 10.3.7 306 (Unused)
// 10.3.8 307 Temporary Redirect
xajax.responseRedirectCodes = ['301','302','307'];

/*
 * xajax.config.status (update and dontUpdate)
 *
 * this provides support for updating the browsers status bar
 * during the request process.  by splitting the status bar
 * functionality into an object, this gives the xajax developer
 * the opportunity to customize the status bar messages prior
 * to sending xajax requests
 */
xajax.config.status = {
	update: function() {
		return {
			onRequest: function() {
				window.status = "Sending Request...";
			},
			onWaiting: function() {
				window.status = "Waiting for Response...";
			},
			onProcessing: function() {
				window.status = "Processing...";
			},
			onComplete: function() {
				window.status = "Done.";
			}
		}
	},
	dontUpdate: function() {
		return {
			onRequest: function() {},
			onWaiting: function() {},
			onProcessing: function() {},
			onComplete: function() {}
		}
	}
}

/**
 * xajax.config.cursor (update and dontUpdate)
 * 
 * this provides the base functionality for updating the browser's cursor
 * during requests.  by splitting this functionality out into it's own
 * object, the xajax developer is now able to customize the functionality
 * prior to submitting requests
 */
xajax.config.cursor = {
	update: function() {
		return {
			onWaiting: function() {
				if (xajax.config.baseDocument.body)
					xajax.config.baseDocument.body.style.cursor = 'wait';
			},
			onComplete: function() {
				xajax.config.baseDocument.body.style.cursor = 'auto';
			}
		}
	},
	dontUpdate: function() {
		return {
			onWaiting: function() {},
			onComplete: function() {}
		}
	}
}

/**
 * xajax.initializeRequest
 * 
 * This function initializes a request object, populating default settings
 * where needed.
 * 
 * @param {Object} oRequest
 *     this object is used to hold all configuration options, from defaults to
 *     request specific settings, as well as data related to the current
 *     state of the request.
 */
xajax.initializeRequest = function(oRequest) {
	oRequest.set = function(option, defaultValue) {
		if (undefined == this[option])
			this[option] = defaultValue;
	}
	
	var xx = xajax;
	var xc = xx.config;
	
	oRequest.set('statusMessages', xc.statusMessages);
	oRequest.set('waitCursor', xc.waitCursor);
	oRequest.set('mode', xc.defaultMode);
	oRequest.set('method', xc.defaultMethod);
	oRequest.set('URI', xc.requestURI);
	oRequest.set('httpVersion', xc.defaultHttpVersion);
	oRequest.set('contentType', xc.defaultContentType);
	oRequest.set('retry', xc.defaultRetry);
	oRequest.set('returnValue', xc.defaultReturnValue);
	
	var xcb = xx.callback;
	var gcb = xcb.global;
	var lcb = xcb.create();
	
	lcb.take = function(frm, opt) {
		if (undefined != frm[opt]) {
			lcb[opt] = frm[opt];
			lcb.hasEvents = true;
		}
		frm[opt] = undefined;
	}
	
	lcb.take(oRequest, 'onRequest');
	lcb.take(oRequest, 'onResponseDelay');
	lcb.take(oRequest, 'onExpiration');
	lcb.take(oRequest, 'beforeResponseProcessing');
	lcb.take(oRequest, 'onFailure');
	lcb.take(oRequest, 'onRedirect');
	lcb.take(oRequest, 'onSuccess');
	lcb.take(oRequest, 'onComplete');
	
	if (undefined != oRequest.callback) {
		if (lcb.hasEvents)
			oRequest.callback = [oRequest.callback, lcb];
	} else
		oRequest.callback = lcb;
	
	oRequest.status = (oRequest.statusMessages) 
		? xc.status.update() 
		: xc.status.dontUpdate();
	
	oRequest.cursor = (oRequest.waitCursor) 
		? xc.cursor.update() 
		: xc.cursor.dontUpdate();
	
	oRequest.method = oRequest.method.toLowerCase();
	if ('get' != oRequest.method)
		oRequest.method = 'post';
	
	oRequest.setCommonRequestHeaders = function() {
		this.request.setRequestHeader('If-Modified-Since', 'Sat, 1 Jan 2000 00:00:00 GMT');
	}
	
	if (undefined == oRequest.URI)
		throw { name: 'Invalid request', message: 'Missing requestURI; autodetection failed; please specify a one explicitly.' }
}

/**
 * xajax.processParameters
 * 
 * This function processes request specific parameters and generates the
 * base request variables needed by the xajax server side
 * 
 * @param {Object} oRequest
 *     see xajax.initializeRequest for a description of this parameter
 */
xajax.processParameters = function(oRequest) {
	var xx = xajax;
	var xt = xx.tools;
	
	var rd = [];
	
	rd.push("xajax=");
	rd.push(encodeURIComponent(oRequest.functionName));
	rd.push("&xajaxr=");
	rd.push(new Date().getTime());

	if (oRequest.parameters) {
		var i = 0;
		var iLen = oRequest.parameters.length;
		while (i < iLen) {
			var oVal = oRequest.parameters[i];
			if ("object" == typeof(oVal)) {
				try {
					oVal = xt._objectToXML(oVal, {});
				} catch (e) {
					oVal = '';
					// do nothing, if the debug module is installed
					// it will catch the exception and handle it
				}
			} else
				oVal = xt._escape(oVal);
				
			rd.push("&xajaxargs[]=");
			rd.push(encodeURIComponent(oVal));
			++i;
		}
	}
	
	oRequest.parameters = undefined;
	
	if ('get' == oRequest.method) {
		oRequest.URI += oRequest.URI.indexOf('?')== -1 ? '?' : '&';
		oRequest.URI += rd.join('');
		rd = [];
	}
	
	oRequest.requestData = rd.join('');
}

/**
 * xajax.prepareRequest
 * 
 * This function prepares the XmlHttpRequest object for this xajax request
 * 
 * @param {Object} oRequest
 *     see xajax.initializeRequest above for a description of this object
 */
xajax.prepareRequest = function(oRequest) {
	var xx = xajax;
	var xt = xx.tools;
	
	oRequest.request = xt.getRequestObject();
	
	if ('asynchronous' == oRequest.mode) {
		// NOTE: references inside this function should be expanded
		// IOW, don't use shorthand references like xx for xajax
		oRequest.request.onreadystatechange = function() {
			if (oRequest.request.readyState != 4)
				return;
			xajax.responseReceived(oRequest);
		}
		oRequest.finishRequest = function() {
			return this.returnValue;
		}
	} else {
		oRequest.finishRequest = function() {
			return xajax.responseReceived(oRequest);
		}
	}
	
	oRequest.open = function() {
		this.request.open(this.method, this.URI, 'asynchronous' == this.mode);
	}
	
	if ('post' == oRequest.method) {
		oRequest.setRequestHeaders = function() {
			this.setCommonRequestHeaders();
			try {
				this.request.setRequestHeader('Method', 'POST ' + this.URI + ' ' + this.httpVersion);
				this.request.setRequestHeader('content-type', this.contentType);
			} catch (e) {
				this.method = 'get';
				this.URI += this.URI.indexOf('?')== -1 ? '?' : '&';
				this.URI += this.requestData;
				this.requestData = '';
				if (0 == this.retry) this.retry = 1;
				throw e;
			}
		}
	} else {
		oRequest.setRequestHeaders = oRequest.setCommonRequestHeaders;
	}
}

/**
 * xajax.call
 * 
 * This function initiates a call to the server.
 * 
 * @param {string} function name
 * @param {object} options
 */
xajax.call = function() {
	var numArgs = arguments.length;
	if (0 == numArgs)
		return false;
	
	var oRequest = {}
	if (1 < numArgs)
		oRequest = arguments[1];
	
	oRequest.functionName = arguments[0];
	
	var xx = xajax;
	
	xx.initializeRequest(oRequest);
	xx.processParameters(oRequest);
	
	while (0 < oRequest.retry) {
		try {
			--oRequest.retry;
			xx.prepareRequest(oRequest);
			return xx.submitRequest(oRequest);
		} catch (e) {
			xajax.callback.execute(
				[xajax.callback.global, oRequest.callback], 
				'onFailure', oRequest);
			if (0 == oRequest.retry)
				throw e;
		}
	}
}

/**
 * xajax.submitRequest
 * 
 * This function creates the request object and submits the request using
 * the request type specified; all request parameters should be finalized
 * by this point.  Upon failure of a POST, this function will fall back
 * to a GET request.
 * 
 * @param {Object} oRequest
 *                 the request context
 */
xajax.submitRequest = function(oRequest) {
	oRequest.status.onRequest();
	
	var xcb = xajax.callback;
	var gcb = xcb.global;
	var lcb = oRequest.callback;
	
	xcb.execute([gcb, lcb], 'onResponseDelay', oRequest);
	xcb.execute([gcb, lcb], 'onExpiration', oRequest);
	xcb.execute([gcb, lcb], 'onRequest', oRequest);
	
	oRequest.open();
	oRequest.setRequestHeaders();
	
	oRequest.cursor.onWaiting();
	oRequest.status.onWaiting();
	
	xajax._internalSend(oRequest);
	
	// synchronous mode causes response to be processed immediately here
	return oRequest.finishRequest();
}

/**
 * xajax._internalSend
 *
 * This function is used internally by the xajax to initiate a request to the
 * server.
 */
xajax._internalSend = function(oRequest) {
	// this may block if synchronous mode is selected
	oRequest.request.send(oRequest.requestData);
}

/**
 * xajax.abortRequest
 */
xajax.abortRequest = function(oRequest)
{
	oRequest.aborted = true;
	oRequest.request.abort();
	xajax.completeResponse(oRequest);
}

/**
 * xajax.responseReceived
 */
xajax.responseReceived = function(oRequest) {
	var xx = xajax;
	var xcb = xx.callback;
	var gcb = xcb.global;
	var lcb = oRequest.callback;
	
	// sometimes the responseReceived gets called when the
	// request is aborted
	if (oRequest.aborted)
		return;
	
	xcb.clearTimer([gcb, lcb], 'onExpiration');
	xcb.clearTimer([gcb, lcb], 'onResponseDelay');
	
	xcb.execute([gcb, lcb], 'beforeResponseProcessing', oRequest);
	
	var fProc = xx.getResponseProcessor(oRequest);
	if (undefined == fProc) {
		xcb.execute([gcb, lcb], 'onFailure', oRequest);
		xx.completeResponse(oRequest);
		return;
	}
	
	return fProc(oRequest);
}

/**
 * xajax.getResponseProcessor
 * 
 * This function attempts to determine, based on the content type of the
 * response, what processor should be used for handling the response data.
 * 
 * the default xajax response will be text/xml which will invoke the
 * xajax xml response processor.  other response processors may be added
 * in the future.  The user can specify their own response processor on 
 * a call by call basis.
 */
xajax.getResponseProcessor = function(oRequest) {
	var fProc;
	
	if (undefined == oRequest.responseProcessor) {
		var cTyp = oRequest.request.getResponseHeader('content-type');
		if (cTyp) {
			if (0 <= cTyp.indexOf('text/xml')) {
				fProc = xajax.responseProcessor.xml;
	//		} else if (0 <= cTyp.indexOf('application/json')) {
	//			fProc = xajax.responseProcessor.json;
			}
		}
	} else fProc = oRequest.responseProcessor;
	
	return fProc;
}

xajax.responseProcessor = {};

/**
 * xajax.responseProcessor.xml
 * 
 * This function parses the response XML into a series
 * of commands.  The commands are constructed by calling
 * parseAttributes and parseChildren, then stored in the
 * response command queue.
 * 
 * @param {Object} xml
 */
xajax.responseProcessor.xml = function(oRequest) {
	var xx = xajax;
	var xt = xx.tools;
	var xcb = xx.callback;
	var gcb = xcb.global;
	var lcb = oRequest.callback;
	
	var oRet = oRequest.returnValue;
	
	var request = oRequest.request;
	var status = request.status;
	
	if (xt.arrayContainsValue(xx.responseSuccessCodes, status)) {
		xcb.execute([gcb, lcb], 'onSuccess', oRequest);
		var seq = 0;
		if (request.responseXML) {
			var responseXML = request.responseXML;
			if (responseXML.documentElement) {
				oRequest.status.onProcessing();
				
				var child = responseXML.documentElement.firstChild;
				while (child) {
					if ('cmd' == child.nodeName) {
						var obj = {};
						obj.cmdFullName = '*unknown*';
						obj.sequence = seq;
						obj.request = oRequest;
						
						xx.parseAttributes(child, obj);
						xx.parseChildren(child, obj);
						
						xt.queue.push(xx.response, obj);
					} else if ('xjxrv' == child.nodeName) {
						oRet = xt._nodeToObject(child.firstChild);
					} else if ('debugmsg' == child.nodeName) {
						// txt = xt._nodeToObject(child.firstChild);
					} else 
						throw { name: 'Invalid response', message: 'The response contains an unexpected tag or text: ' + child.nodeName }
						
					++seq;
					child = child.nextSibling;
				}
			}
		}
		
		var obj = {};
		obj.cmdFullName = 'Response Complete';
		obj.sequence = seq;
		obj.request = oRequest;
		obj.cmd = 'rcmplt';
		xt.queue.push(xx.response, obj);
		
		// do not re-start the queue if a timeout is set
		if (null == xx.response.timeout)
			xt.queue.process(xx.response);
	} else if (xt.arrayContainsValue(xx.responseRedirectCodes, status)) {
		xcb.execute([gcb, lcb], 'onRedirect', oRequest);
		window.location = request.getResponseHeader("location");
		xx.completeResponse(oRequest);
	} else if (xt.arrayContainsValue(xx.responseErrorsForAlert, status)) {
		xcb.execute([gcb, lcb], 'onFailure', oRequest);
		xx.completeResponse(oRequest);
	}
	
	return oRet;
}

/**
 * xajax.parseAttributes
 * 
 * This function takes the parameters passed in the command
 * (cmd tag) of the xml response and convert them to parameters
 * of the args object.  This will serve as the command object
 * which will be stored in the response command queue.
 * 
 * @param {Object} child
 * @param {Object} args
 */
xajax.parseAttributes = function(child, obj) {
	var iLen = child.attributes.length;
	for (var i = 0; i < iLen; ++i) {
		var attr = child.attributes[i];
		switch (attr.name) {
		case "n":
			obj.cmd = attr.value;
			break;
		case "t":
			obj.id = attr.value;
			break;
		case "p":
			obj.property = attr.value;
			break;
		case "c":
			obj.type = attr.value;
			break;
		case "f":
			obj.func = attr.value;
			break;
		}
	}
}

/**
 * xajax.parseChildren
 * 
 * This function parses the child nodes of the command 
 * (cmd tag) of the response XML.  Generally, the child
 * nodes contain the data element of the command; this member
 * may be an object, which will be deserialized by _nodeToObject.
 * 
 * @param {Object} child
 * @param {Object} args
 */
xajax.parseChildren = function(child, obj) {
	obj.data = '';
	if (0 < child.childNodes.length) {
		if (1 < child.childNodes.length) {
			var grandChild = child.firstChild;
			do {
				if ('#cdata-section' == grandChild.nodeName || '#text' == grandChild.nodeName) {
					obj.data += grandChild.data;
				}
			} while (grandChild = grandChild.nextSibling);
		} else {
			var grandChild = child.firstChild;
			if ('xjxobj' == grandChild.nodeName) {
				obj.data = xajax.tools._nodeToObject(grandChild);
			} else if ('#cdata-section' == grandChild.nodeName || '#text' == grandChild.nodeName) {
				obj.data = grandChild.data;
			}
		}
	} else if (undefined != child.data) {
		obj.data = child.data;
	}
}

/**
 * xajax.executeCommand
 *
 * This function performs a lookup on the command specified by the response
 * command object passed in parameter one.  If the command exists, the 
 * function checks to see if the command references a DOM object by ID; if so,
 * the object is located within the DOM and added to the command data.  The
 * command handler is then called.
 *
 * If the command handler returns true, it is assumed that the command 
 * completed successfully.  If the command handler returns false, then the
 * command is considered pending; xajax enteres a wait state.  It is up to the
 * command handler to set an interval, timeout or event handler which will
 * restart the xajax response processing.
 * 
 * @param {object} obj
 */
xajax.executeCommand = function(obj) {
	// if the command handler exists
	if (xajax.commands[obj.cmd]) {
		// it is important to grab the element here as the previous command
		// might have just created the element
		if (obj.id)
			obj.objElement = xajax.$(obj.id);
		// process the command
		if (false == xajax.commands[obj.cmd](obj)) {
			xajax.tools.queue.pushFront(xajax.response, obj);
			return false;
		}
	}
	return true;
}

/**
 * xajax.completeResponse
 * 
 * This function is called by the response command queue
 * processor when all commands have been processed.
 */
xajax.completeResponse = function(oRequest) {
	xajax.callback.execute(
		[xajax.callback.global, oRequest.callback], 
		'onComplete', oRequest);
	oRequest.cursor.onComplete();
	oRequest.status.onComplete();
}

/**
 * Command handlers
 * 
 * @param {Object} args
 */
xajax.commands['css'] = function(args) {
	args.cmdFullName = 'includeCSS';
	return xajax.css.add(args.data);
}
xajax.commands['rcss'] = function(args) {
	args.cmdFullName = 'removeCSS';
	return xajax.css.remove(args.data);
}
xajax.commands['wcss'] = function(args) {
	args.cmdFullName = 'waitForCSS';
	return xajax.css.waitForCSS(args);
}

xajax.commands['as'] = function(args) {
	args.cmdFullName = 'assign/clear';
	try {
		return xajax.dom.assign(args.objElement, args.property, args.data);
	} catch (e) {
		// do nothing, if the debug module is installed it will
		// catch and handle the exception
	}
	return true;
}
xajax.commands['ap'] = function(args) {
	args.cmdFullName = 'append';
	return xajax.dom.append(args.objElement, args.property, args.data);
}
xajax.commands['pp'] = function(args) {
	args.cmdFullName = 'prepend';
	return xajax.dom.prepend(args.objElement, args.property, args.data);
}
xajax.commands['rp'] = function(args) {
	args.cmdFullName = 'replace';
	return xajax.dom.replace(args.id, args.property, args.data);
}
xajax.commands['rm'] = function(args) {
	args.cmdFullName = 'remove';
	return xajax.dom.remove(args.id);
}
xajax.commands['ce'] = function(args) {
	args.cmdFullName = 'create';
	return xajax.dom.create(args.id, args.data, args.property);
}
xajax.commands['ie'] = function(args) {
	args.cmdFullName = 'insert';
	return xajax.dom.insert(args.id, args.data, args.property);
}
xajax.commands['ia'] = function(args) {
	args.cmdFullName = 'insertAfter';
	return xajax.dom.insertAfter(args.id, args.data, args.property);
}

xajax.commands['wf'] = function(args) {
	args.cmdFullName = 'waitFor';
	return xajax.js.waitFor(args);
}
xajax.commands['ino'] = function(args) {
	args.cmdFullName = 'includeScriptOnce';
	return xajax.js.includeScriptOnce(args.data);
}
xajax.commands['in'] = function(args) {
	args.cmdFullName = 'includeScript';
	return xajax.js.includeScript(args.data);
}
xajax.commands['rjs'] = function(args) {
	args.cmdFullName = 'removeScript';
	if ('object' == typeof args.data) {
		if (2 == args.data.length)
			return xajax.js.removeScript(args.data[0], args.data[1]);
		else
			return xajax.js.removeScript(args.data[0]);
	} else
		return xajax.js.removeScript(args.data);
}
xajax.commands['js'] = function(args) {
	args.cmdFullName = 'execute Javascript';
	return xajax.js.execute(args.data);
}
xajax.commands['jc'] = function(args) {
	args.cmdFullName = 'call js function';
	return xajax.js.call(args.func, args.data);
}
xajax.commands["al"] = function(args) {
	args.cmdFullName = "alert";
	alert(args.data);
	return true;
}
xajax.commands["cc"] = function(args) {
	args.cmdFullName = "confirmCommands";
	return xajax.js.confirmCommands(args.data, args.id);
}

xajax.commands["ci"] = function(args) {
	args.cmdFullName = "createInput";
	return xajax.forms.createInput(args.id, args.type, args.data, args.property);
}
xajax.commands["ii"] = function(args) {
	args.cmdFullName = "insertInput";
	return xajax.forms.insertInput(args.id, args.type, args.data, args.property);
}
xajax.commands["iia"] = function(args) {
	args.cmdFullName = "insertInputAfter";
	return xajax.forms.insertInputAfter(args.id, args.type, args.data, args.property);
}

xajax.commands["ev"] = function(args) {
	args.cmdFullName = "addEvent";
	return xajax.events.setEvent(args.id, args.property, args.data);

}
xajax.commands["ah"] = function(args) {
	args.cmdFullName = "addHandler";
	return xajax.events.addHandler(args.id, args.property, args.data);
}
xajax.commands["rh"] = function(args) {
	args.cmdFullName = "removeHandler";
	return xajax.events.removeHandler(args.id, args.property, args.data);
}


/**
 * xajax.css
 *
 * object which contains the functions for handling CSS files
 **/
xajax.css = {}

/**
 * xajax.css.add
 * 
 * This function checks for the existance of the requested CSS file
 * and adds a link reference to it if none is found.
 * 
 * @param {Object} filename
 */
xajax.css.add = function(filename) {
	var oDoc = xajax.config.baseDocument;
	var oHeads = oDoc.getElementsByTagName('head');
	var oHead = oHeads[0];
	var oLinks = oHead.getElementsByTagName('link');
	
	var found = false;
	var iLen = oLinks.length;
	for (var i = 0; i < iLen && false == found; ++i)
		if (0 < oLinks[i].href.indexOf(filename))
			found = true;
	
	if (false == found) {
		var oCSS = oDoc.createElement('link');
		oCSS.rel = 'stylesheet';
		oCSS.type = 'text/css';
		oCSS.href = filename;
		oHead.appendChild(oCSS);
	}
	
	return true;
}

/**
 * xajax.css.remove
 * 
 * This function will locate and remove a link tag referencing the
 * specified file.
 * 
 * @param {Object} filename
 */
xajax.css.remove = function(filename) {
	var oDoc = xajax.config.baseDocument;
	var oHeads = oDoc.getElementsByTagName('head');
	var oHead = oHeads[0];
	var oLinks = oHead.getElementsByTagName('link');
	
	var i = 0;
	while (i < oLinks.length)
		if (0 <= oLinks[i].href.indexOf(filename))
			oHead.removeChild(oLinks[i]);
		else ++i;
	
	return true;
}
xajax.css.waitForCSS = function(args) {
	var oDocSS = xajax.config.baseDocument.styleSheets;
	var ssEnabled = [];
	var iLen = oDocSS.length;
	for (var i = 0; i < iLen; ++i) {
		ssEnabled[i] = 0;
		try {
			ssEnabled[i] = oDocSS[i].cssRules.length;
		} catch (e) {
			try {
				ssEnabled[i] = oDocSS[i].rules.length;
			} catch (e) {
			}
		}
	}
	
	var ssLoaded = true;
	var iLen = ssEnabled.length;
	for (var i = 0; i < iLen; ++i)
		if (0 == ssEnabled[i])
			ssLoaded = false;
	
	if (false == ssLoaded) {
		// inject a delay in the queue processing
		// handle retry counter
		if (xajax.tools.queue.retry(args, 600)) {
			xajax.tools.queue.setWakeup(xajax.response, 10);
			return false;
		}
		// give up, continue processing queue
	}
	return true;
}

/**
 * xajax.dom
 *
 * object which contains the functions for dom manipulation
 **/
xajax.dom = {}

/**
 * xajax.dom.assign
 * 
 * This function will assign a value to a specified
 * property of the specified element.
 * 
 * @param {Object} element
 * @param {Object} property
 * @param {Object} data
 */
xajax.dom.assign = function(element, property, data) {
	switch (property) {
	case 'innerHTML':
			element.innerHTML = data;
		break;
	case 'outerHTML':
		if (undefined == element.outerHTML) {
			var r = xajax.config.baseDocument.createRange();
			r.setStartBefore(element);
			var df = r.createContextualFragment(data);
			element.parentNode.replaceChild(df, element);
		} else element.outerHTML = data;
		break;
	default:
		if (xajax.tools.willChange(element, property, data))
			eval('element.' + property + ' = data;');
		break;
	}
	return true;
}

/**
 * xajax.dom.replace
 * 
 * This function searches for text in an attribute of an element and replaces
 * it with a different text
 * 
 * @param {Object} sId
 * @param {Object} sAttribute
 * @param {Object} aData
 */
xajax.dom.replace = function(element, sAttribute, aData) {
	var sSearch = aData['s'];
	var sReplace = aData['r'];
	
	if (sAttribute == 'innerHTML')
		sSearch = xajax.tools.getBrowserHTML(sSearch);
	
	if ("string" == typeof (element))
		element = xajax.$(element);
	
	eval('var txt = element.' + sAttribute);
	
	var bFunction = false;
	if ('function' == typeof (txt)) {
        txt = txt.toString();
        bFunction = true;
    }
	
	var start = txt.indexOf(sSearch);
	if (start > -1) {
		var newTxt = [];
		while (start > -1) {
			var end = start + sSearch.length;
			newTxt.push(txt.substr(0, start));
			newTxt.push(sReplace);
			txt = txt.substr(end, txt.length - end);
			start = txt.indexOf(sSearch);
		}
		newTxt.push(txt);
		newTxt = newTxt.join('');
		
		if (bFunction) {
			eval('element.' + sAttribute + '=newTxt;');
		} else if (xajax.tools.willChange(element, sAttribute, newTxt)) {
			eval('element.' + sAttribute + '=newTxt;');
		}
	}
	return true;
}

/**
 * xajax.dom.remove
 * 
 * This deletes an element
 * 
 * @param {Object} sId
 */
xajax.dom.remove = function(element) {
	if ('string' == typeof (element))
		element = xajax.$(element);
	
	if (element && element.parentNode && element.parentNode.removeChild)
		element.parentNode.removeChild(element);

	return true;
}

/**
 * xajax.dom.create
 * 
 * This creates a new child node under the specified parent.
 * 
 * @param {Object} sParentId
 * @param {Object} sTag
 * @param {Object} sId
 */	
xajax.dom.create = function(sParentId, sTag, sId) {
	var objParent = xajax.$(sParentId);
	objElement = xajax.config.baseDocument.createElement(sTag);
	objElement.setAttribute('id', sId);
	if (objParent)
		objParent.appendChild(objElement);
	return true;
}

xajax.dom.append = function(element, property, data) {
	eval('element.' + property + ' += data;');
	return true;
}

xajax.dom.prepend = function(element, property, data) {
	eval('element.' + property + ' = data + element.' + property);
	return true;
}

/**
 * xajax.dom.insert
 * 
 * This inserts a new node before the specified node.
 * 
 * @param {Object} sBeforeId
 * @param {Object} sTag
 * @param {Object} sId
 */
xajax.dom.insert = function(sBeforeId, sTag, sId) {
	var objSibling = xajax.$(sBeforeId);
	objElement = xajax.config.baseDocument.createElement(sTag);
	objElement.setAttribute('id', sId);
	objSibling.parentNode.insertBefore(objElement, objSibling);
	return true;
}

/**
 * xajax.dom.insertAfter
 * 
 * This inserts a new node after the specified node.
 * 
 * @param {Object} sAfterId
 * @param {Object} sTag
 * @param {Object} sId
 */
xajax.dom.insertAfter = function(sAfterId, sTag, sId) {
	var objSibling = xajax.$(sAfterId);
	objElement = xajax.config.baseDocument.createElement(sTag);
	objElement.setAttribute('id', sId);
	objSibling.parentNode.insertBefore(objElement, objSibling.nextSibling);
	return true;
}

/**
 * xajax.js
 *
 * object which contains the functions for js file manipulation
 **/
xajax.js = {}

/**
 * xajax.js.includeOnce
 * 
 * This function attempts to locate the specified script file in 
 * the list of loaded scripts; if it is not found, a new script
 * reference is added to the head of the document.
 * 
 * @param {Object} fileName
 */
xajax.js.includeScriptOnce = function(fileName) {
	//Check to see if this file has already been loaded
	var oDoc = xajax.config.baseDocument;
    var loadedScripts = oDoc.getElementsByTagName('script');
	var iLen = loadedScripts.length;
    for (var i = 0; i < iLen; ++i) {
		var script = loadedScripts[i];
        if (script.src) {
			if (0 <= script.src.indexOf(fileName))
				return;
		}
    }
	return xajax.js.includeScript(fileName);
}

xajax.js.includeScript = function(fileName) {
	var oDoc = xajax.config.baseDocument;
	var objHead = oDoc.getElementsByTagName('head');
	var objScript = oDoc.createElement('script');
	objScript.type = 'text/javascript';
	objScript.src = fileName;
	objHead[0].appendChild(objScript);
	return true;
}

xajax.js.removeScript = function(fileName, unload) {
	var oDoc = xajax.config.baseDocument;
    var loadedScripts = oDoc.getElementsByTagName('script');
	var iLen = loadedScripts.length;
    for (var i = 0; i < iLen; ++i) {
		var script = loadedScripts[i];
        if (script.src) {
			if (0 <= script.src.indexOf(fileName)) {
				if (undefined != unload)
					xajax.js.execute(unload);
				var parent = script.parentNode;
				parent.removeChild(script);
			}
		}
    }
}

xajax.js.execute = function(script) {
	var returnValue = true;
	eval(script);
	return returnValue;
}

xajax.js.waitFor = function(args) {
	var bResult = false;
	var cmdToEval = 'bResult = (';
	cmdToEval += args.data;
	cmdToEval += ');';
	try {
		eval(cmdToEval);
	} catch (e) {
	}
	if (false == bResult) {
		// inject a delay in the queue processing
		// handle retry counter
		// TODO: make retry count adjustable
		if (xajax.tools.queue.retry(args, 600)) {
			xajax.tools.queue.setWakeup(xajax.response, 10);
			return false;
		}
		// give up, continue processing queue
	}
	return true;
}

/**
 * xajax.js.call
 * 
 * This function can be used to call a javascript function with a
 * series of parameters passed in as a single-dimensional array.
 * 
 * @param {Object} func
 * @param {Object} parameters
 */
xajax.js.call = function(func, parameters) {
	var scr = new Array();
	scr.push(func);
	scr.push('(');
	if (0 < parameters.length) {
		scr.push('parameters[0]');
		for (var i = 1; i < parameters.length; ++i)
			scr.push(', parameters[' + i + ']');
	}
	scr.push(');');
	eval(scr.join(''));
	return true;
}

/**
 * xajax.js.confirmCommands
 * 
 * This function can be used to prompt the user with some text, if the user
 * responds by clicking No, the following numberOfCommands are skipped in the
 * response command queue.  If the user clicks Yes, the command processing 
 * resumes normal operation.
 * 
 * @param {Object} msg
 * @param {Object} numberOfCommands
 */
xajax.js.confirmCommands = function(msg, numberOfCommands) {
	if (false == confirm(msg)) {
		while (0 < numberOfCommands) {
			xajax.tools.queue.pop(xajax.response);
			--numberOfCommands;
		}
	}
	return true;
}

/**
 * xajax.forms
 *
 * object which contains the functions for html form manipulation
 **/
xajax.forms = {}

/**
 * xajax.forms.getInput
 * 
 * This function creates and returns a form input object with the specified
 * parameters.
 * 
 * @param {Object} type
 * @param {Object} name
 * @param {Object} id
 */
if (undefined == window.addEventListener) {
	xajax.forms.getInput = function(type, name, id) {
		return xajax.config.baseDocument.createElement('<input type="'+type+'" name="'+name+'" id="'+id+'">');
	}
} else {
	xajax.forms.getInput = function(type, name, id) {
		var oDoc = xajax.config.baseDocument;
		var Obj = oDoc.createElement('input');
		Obj.setAttribute('type', type);
		Obj.setAttribute('name', name);
		Obj.setAttribute('id', id);
		return Obj;
	}
}

/**
 * xajax.forms.createInput
 * 
 * This function creates a new input node under the specified parent.
 * 
 * @param {Object} sParentId
 * @param {Object} sType
 * @param {Object} sName
 * @param {Object} sId
 */
xajax.forms.createInput = function(sParentId, sType, sName, sId) {
	var objParent = xajax.$(sParentId);
	var objElement = xajax.forms.getInput(sType, sName, sId);
	if (objParent && objElement)
		objParent.appendChild(objElement);
	return true;
}

/**
 * xajax.forms.insertInput
 * 
 * This function creates a new input node before the specified node.
 * 
 * @param {Object} sBeforeId
 * @param {Object} sType
 * @param {Object} sName
 * @param {Object} sId
 */
xajax.forms.insertInput = function(sBeforeId, sType, sName, sId) {
	var objSibling = xajax.$(sBeforeId);
	var objElement = xajax.forms.getInput(sType, sName, sId);
	if (objElement && objSibling && objSibling.parentNode)
		objSibling.parentNode.insertBefore(objElement, objSibling);
	return true;
}

/**
 * xajax.forms.insertInputAfter
 * 
 * This function inserts a new input node after the specified node.
 * 
 * @param {Object} sAfterId
 * @param {Object} sType
 * @param {Object} sName
 * @param {Object} sId
 */
xajax.forms.insertInputAfter = function(sAfterId, sType, sName, sId) {
	var objSibling = xajax.$(sAfterId);
	var objElement = xajax.forms.getInput(sType, sName, sId);
	if (objElement && objSibling && objSibling.parentNode)
		objSibling.parentNode.insertBefore(objElement, objSibling.nextSibling);
	return true;
}

/**
 * xajax.events
 *
 * object which contains the functions for dom event handler manipulation
 **/
xajax.events = {}

xajax.events.setEvent = function(element, event, code) {
	if ('string' == typeof element)
		element = xajax.$(element);
	event = xajax.tools.addOnPrefix(event);
	eval('element.' + event + ' = function() { ' + code + '; }');
	return true;
}

/**
 * xajax.events.addHandler
 * 
 * This helper function is called by the addEvent command handler
 * to add an event handler to an element.
 * 
 * @param {Object} sElementId
 * @param {Object} sEvent
 * @param {Object} sFunctionName
 */
if (window.addEventListener) {
	xajax.events.addHandler = function(element, event, fun) {
		if ('string' == typeof element)
			element = xajax.$(element);
		event = xajax.tools.stripOnPrefix(event);
		eval('element.addEventListener("' + event + '", ' + fun + ', false);');
		return true;
	}
} else {
	xajax.events.addHandler = function(element, event, fun) {
		if ('string' == typeof element)
			element = xajax.$(element);
		event = xajax.tools.addOnPrefix(event);
		eval('element.attachEvent("' + event + '", ' + fun + ', false);');
		return true;
	}
}

/**
 * xajax.events.removeHandler
 * 
 * This helper function is called by the removeHandler command handler
 * to remove an event handler from an element.
 * 
 * @param {Object} element
 * @param {Object} event
 * @param {Object} function
 */
if (window.addEventListener) {
	xajax.events.removeHandler = function(element, event, fun) {
		if ('string' == typeof element)
			element = xajax.$(element);
		event = xajax.tools.stripOnPrefix(event);
		eval('element.removeEventListener("' + event + '", ' + fun + ', false);');
		return true;
	}
} else {
	xajax.events.removeHandler = function(element, event, fun) {
		if ('string' == typeof element)
			element = xajax.$(element);
		event = xajax.tools.addOnPrefix(event);
		eval('element.detachEvent("' + event + '", ' + fun + ', false);');
		return true;
	}
}

/**
 * xajax.callback
 * 
 * This contains all the variables and code used to add callback 
 * handling onto the xajax core.
 */
xajax.callback = {}

/**
 * xajax.callback.create
 *
 * This function will create a blank callback object. Two optional arguments
 * let you set the timer delay for the onResponseDelay and onExpiration
 * callback, respectively.
 **/
xajax.callback.create = function() {
	var xx = xajax;
	var xc = xx.config;
	var xcb = xx.callback;
	
	var oCB = {}
	oCB.timers = {};
	
	oCB.timers.onResponseDelay = xcb.setupTimer(
		(arguments.length > 0) 
			? arguments[0] 
			: xc.defaultResponseDelayTime);
	
	oCB.timers.onExpiration = xcb.setupTimer(
		(arguments.length > 1) 
			? arguments[1] 
			: xc.defaultExpirationTime);

	oCB.onRequest = null;
	oCB.onResponseDelay = null;
	oCB.onExpiration = null;
	oCB.beforeResponseProcessing = null;
	oCB.onFailure = null;
	oCB.onRedirect = null;
	oCB.onSuccess = null;
	oCB.onComplete = null;
	
	return oCB;
}

xajax.callback.setupTimer = function(iDelay)
{
	return { timer: null, delay: iDelay };
}
xajax.callback.clearTimer = function(oCallback, sFunction)
{
	if (undefined != oCallback.timers) {
		if (undefined != oCallback.timers[sFunction]) {
			clearTimeout(oCallback.timers[sFunction].timer);
		}
	} else if ('object' == typeof oCallback) {
		var iLen = oCallback.length;
		for (var i = 0; i < iLen; ++i)
			xajax.callback.clearTimer(oCallback[i], sFunction);
	}
}

/**
 * xajax.callback.global
 * 
 * This object contains the definition of a callback object which
 * can be used by the developer to add global callback (perhaps
 * to show a loading message, or similar)
 */
xajax.callback.global = xajax.callback.create();

/**
 * xajax.callback.start
 * 
 * @param {Object} what
 */
xajax.callback.execute = function(oCallback, sFunction, args) {
	if (undefined != oCallback[sFunction]) {
		var func = oCallback[sFunction];
		if (undefined != oCallback.timers[sFunction]) {
			oCallback.timers[sFunction].timer = setTimeout(function() { 
				func(args);
			}, oCallback.timers[sFunction].delay);
		}
		else {
			func(args);
		}
	} else if ('object' == typeof oCallback) {
		var iLen = oCallback.length;
		for (var i = 0; i < iLen; ++i)
			xajax.callback.execute(oCallback[i], sFunction, args);
	}
}


/**
 * xjx object
 * 
 * The xjx object contains shortcuts to commonly used tools
 **/

xjx = {}

xjx.$ = xajax.tools.$;
xjx.getFormValues = xajax.tools.getFormValues;

/**
 * xajax shortcuts for backward compatibility
 **/
 
xajax.$ = xajax.tools.$;
xajax.getFormValues = xajax.tools.getFormValues;

xajax.isLoaded = true;
