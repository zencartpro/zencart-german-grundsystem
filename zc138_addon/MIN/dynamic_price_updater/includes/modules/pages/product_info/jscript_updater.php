<?php
// Dynamic Price Updater Vers. 0.97 - 08.02.2009 by rpa-com.de

// Small module to dynamically update main price when the product has price altering attributes

// (c) D Parry (Chrome) 2007 (dan@virtuawebtech.co.uk)
// This module is free to distribute and use as long as the above copyright message is left in tact

// Alterations are permitted but please let me know of any changes you make, specifically where incompatibility is concerned

//modified by web28 - www.rpa-com:
//FIX RADIO AND CHECKBOX OPTION PRICE =  0,00 
//NEW: USE ZENCART CURRENCIES FORMAT
//NEW: USE ZENCART DEFAULT  Decimal_Point, Thousands_Point
//FIX: ATTRIBUTE PICTURES 
// if attribute pictures used , Dynamic Price Updater don't find the label with attribut prices
/*
Attribute Style for Radio Buttons/Checkbox" :
Image Styles:
0= Images Below Option Names #WORK#
1= Element, Image and Option Value #WORK#
2= Element, Image and Option Name Below #WORK#
3= Option Name Below Element and Image #WORK#
4= Element Below Image and Option Name #WORK#
5= Element Above Image and Option Name #WORK#
*/
//end modified by web28 - www.rpa-com

//LIGHTBOX FIX
//To correct the issue with Lightbox (assuming that is the issue) I modified the jscript_updater.php as follows:
//There are two places in the code that check if: (prArr[i] !== null)
//I changed these two instances to: (prArr[i] == '')

// some contstant declarations
// text files declarations:  includes/languages/YOURLANGUAGE/jscript_updater.php
?>

<script language="javascript" type="text/javascript">
// <![CDATA[
// v.0.97 by web28 - www.rpa-com.de
var objPrice, origPrice;
var defaultCurrencyLeft, defaultCurrencyRight, defaultDecimal_Point, defaultThousands_Point;
defaultCurrencyLeft = defaultCurrencyRight = defaultDecimal_Point = defaultThousands_Point = '';
var quantity = false; // do not alter this // NICHT ÄNDERN
var showQuantity = false; // show the quantity the customer has requested in the main price header // Soll hinter dem geänderten Preis in Klammern die Anzahl der ausgewählten Artikel angezeigt werden? Mögliche Werte: true oder false
var showQuantitySB = false; // show the quantity the customer has requested in the sidebox // Falls Sidebox aktiv: Soll hinter dem geänderten Preis in der Sidebox in Klammern die Anzahl der ausgewählten Artikel angezeigt werden? Mögliche Werte: true oder false
var prArr = nameArr = new Array(); // holds an array of prices to be adjusted (for multiple price adjustments)
var _oflag = false; // do not alter this // NICHT ÄNDERN

//var seeker = new RegExp(/\(\s*([+-]?)([^0-9]*)([0-9,]+\.[0-9]+)([^0-9)]*)\s*\)/);
var seeker = new RegExp(/\(\s*([+-]?)([^0-9.,]*)([0-9]+[.,]?[0-9]*)\s*([^0-9)]*)\s*\)/);

// Updater sidebox settings - Falls die zusätzliche Sidebox verwendet werden soll (nur mit Zen-Cart 1.3.7 möglich!)
//var _sidebox = 'manufacturers'; // set this to: false - don't use or the ID of the sidebox you want the display to insert above (must be exact)
var _sidebox = false; // Mögliche Werte: false - keine Sidebox // oder ID der Sidebox, über der die Preisberechnungsbox erscheinen soll, z.B. information oder categories
var objSB = false; // this holds the sidebox object

// Second price setting // Soll ein zusätzlicher zweiter Preis angezeigt werden? 
// the following settings allow a second price to be displayed... if a page is very long this allows you to add another price display
// thanks to Ryk on the Zen Cart forums for the idea and pointing out the issue
var _secondPrice = false; //'cartAdd'; // set this to either false for disabled or supply the ID of an element for the price to appear BEFORE... for example, cartAdd // Mögliche Werte: false - keine zusätzliche Anzeige // oder die ID eines Elements vor dem der Zusatzpreis angezeigt werden soll, z.B. cartAdd
var _SPDisplay = 'update'; // governs the behaviour of the second... 'always' permanently displays and 'update' shows the second price only when an attribute is selected // Soll der Zusatzpreis immer angezeigt werden oder nur bei Auswahl eines Attributs? Mögliche Werte: always - immer anzeigen // oder update - nur bei Attributauswahl

var objSP = false; // please don't adjust this // NICHT ÄNDERN

// debug settings // Gibt Fehlermeldungen zum Troubleshooting aus
var _debug = false; //true; // set to false to disable debug output // Mögliche Werte: true oder false
var _db = '';
var _dbdiv = false;

//###################################################
//FROM HERE NOTHING MORE CHANGE! // AB HIER NICHTS MEHR ÄNDERN!
//###################################################

function find_label(objlab) { //FIX: ATTRIBUTE PICTURES by web28 - www.rpa-com
	var objtmp = objlab;
	//alert ('objekt attribut: ' + attribid);	
	objtmp = objtmp.nextSibling;
	if(objtmp){
	    var Zaehler = 1;
		while (objtmp.nodeName != "LABEL" && Zaehler <= 3) {
			objtmp = objtmp.nextSibling;			
			Zaehler++;
		}
		//alert (Zaehler);
		if (Zaehler == 3) {
		    //alert ('- label not found');
			return ''; //'- label not find';
		} else {
		    //alert ('labelattribut: ' + objlab.getAttribute("for"));	
			return objtmp;			
		}
	} else { //Rückwärtssuche: Label befindet sich vor dem Input
	    objtmp = objlab.previousSibling;
		var Zaehler = 1;
		while (objtmp.nodeName != "LABEL" && Zaehler <= 3) {
			objtmp = objtmp.previousSibling;			
			Zaehler++;
		}
		if (Zaehler == 3) {
		    //alert ('- label not found');
			return ''; //'- label not find';
		} else {
		    //alert ('labelattribut: ' + objlab.getAttribute("for"));				
			return objtmp;					
		}	
	}
}

function init() { // discover the selects that are required to adjust the main price
	var centre = document.getElementById('productGeneral');
	var objSel = centre.getElementsByTagName('SELECT');
	var objInp = centre.getElementsByTagName('INPUT');
	var db = '';
	var _flag = false; // flag to decide if a load of attribute information is needed

	if (!_oflag)	{ // get the base price and the quantity box (if it exists)
		// firstly find out if debug messages should be shown
		if (_debug === true) { // build the div that will hold debug messages
			createdb();
		}

		if (_secondPrice !== false && _SPDisplay == 'always') {
			regdb('SP Onload', 'Type: ' + _SPDisplay);
			updSP();
		}

		// quantity box
		var qtemp = document.getElementById('cartAdd');
		if (qtemp) { // got the containing div... go for the quantity!
			var itemp = qtemp.getElementsByTagName('INPUT');
			if (itemp) { // make sure some inputs are available to scan
				for (var i=0; itemp[i]; i++) {
					if (itemp[i].name == 'cart_quantity') { // we have the input we need
						quantity = itemp[i].value;
						regdb('Onload quantity', 'Cart add INPUT discovered (' + quantity + ')');
						itemp[i].onkeyup = function () { adjQuan(this); }
					}
				}
			}
		}
		// if quantity is still false we'll assign it a value of 1
		if (quantity === false)	quantity = 1;

		//NEW ### FIND THE DISPLAYED PRICE ###  by web28 - www.rpa-com	
		var displayed_price = document.getElementById('productPrices');
		if (!(temp = displayed_price.getElementsByTagName('SPAN')[0])) { //CHECK FOR SPECIAL PRICE 
			//alert ('NO SPAN');
			var priceHTML= displayed_price.innerHTML;			
		} else {
		    //alert ('SPAN - SPECIAL PRICE');
			regdb('Onload sale', 'Looks like an item on sale');
			var temp = displayed_price.getElementsByTagName('SPAN');
			for (var i=0; temp[i]; i++) {				
				if (temp[i].className == 'productSpecialPrice'){
					var priceHTML = temp[i].innerHTML;					
				}
			}
			
			//if there is no "productSpecialPrice", but a Span Container, then take "displayed_price.innerHTML"
			if (!priceHTML) priceHTML= displayed_price.innerHTML;				
		}
		
		
		// IF WE FOUND A PRODUCTS_PRICE,  FILTER THE NUMBER
		if (priceHTML) origPrice = Number(priceHTML.match(/([0-9,.]+)/g)[0].replace(/,/g, '').replace(/\./g, ''));
		var db = '';
		if (!origPrice) {
			db = 'Price not found!';
			regdb('Initial phase failure', db);
			return;
		} else {
			db= origPrice;			
			regdb('Onload base price', db);
		}

		// Find the default currency symbols		
		var temp = '<? echo $currencies->format(1000.00);?>'; //NEW: USE ZENCART CURRENCIES FORMAT
        regdb('Currencies Format', temp);
		temp= temp.match(/s*([^0-9 ]*)([0-9.,]+)(.*)/); //OLD: origHTML.match(/.*:\s*([^0-9 ]*)([0-9.,]+)(.*)/);	
		defaultCurrencyLeft = temp[1];
		db = 'Left: ' + defaultCurrencyLeft;
		defaultCurrencyRight = temp[3];
		db += ' - Right: ' + defaultCurrencyRight;        	
		regdb('Onload default currency locator', db);	
		
		//NEW: FIND defaultDecimal_Point		
		var tempdp = '<? echo $currencies->format(0.00);?>';		
		tempdp = tempdp.match(/([0-9,.]+)/g)[0]; 	
		regdb('Price Format', tempdp);
		defaultDecimal_Point = tempdp.match(/([,.]+)/g)[0];
		regdb('defaultDecimal_Point', defaultDecimal_Point);
		
		//NEW: FIND defaultThousands_Point		
		var temptp = '<? echo $currencies->format(1000);?>';		
		temptp = temptp.match(/([0-9,.]+)/g)[0]; 	
		regdb('Price Format', temptp);
		defaultThousands_Point = temptp.match(/([,.]+)/g)[0];
		regdb('defaultThousands_Point', defaultThousands_Point);
			
	}

	for (var i=0; objSel[i]; i++) {
		var _this = objSel[i];

		objSel[i].onchange = function () { updatePrice(this); }
		db = 'Name - ' + objSel[i].name + ' : ID - ' + objSel[i].id;

		// scan the attributes to find out if any adjustments are needed
		var matches = objSel[i][objSel[i].selectedIndex].text.match(seeker);

		if (matches) { // yep
			db += ' - Adjusted!';
			prArr[objSel[i].id] = new Array();
			//prArr[objSel[i].id]['p'] = Number(matches[3].replace(/,/, '')); // push the value onto the stack
			prArr[objSel[i].id]['p'] = Number(matches[3].replace(/,/, '').replace(/\./, '')); 
			prArr[objSel[i].id]['n'] = objSel[i][objSel[i].selectedIndex].text.replace(seeker, '');
			prArr[objSel[i].id]['m'] = matches[1]; // mode indicator
			prArr[objSel[i].id]['l'] = matches[2]; // left side currency indeicator
			prArr[objSel[i].id]['r'] = matches[4]; // the right side currency indicator
			_flag = true;
		}

		regdb ('Onload SELECT', db);
	}

	for (var i=0; objInp[i]; i++) {
	    //regdb('objinp', i);
		if (objInp[i].type == 'radio' || objInp[i].type == 'checkbox') { // make sure we're dealing with radio boxes
			db = 'Name - ' + objInp[i].name + ' : ID - ' + objInp[i].id;			     		
			var temp = find_label(objInp[i]); //FIND THE LABEL by rpa-com.de		
			//matches = temp.innerHTML.match(seeker);	//matches = objInp[i].nextSibling.innerHTML.match(seeker);
			//db += matches;
			if (temp) {
				db += ' : Adjusted!';
				objInp[i].onclick = function () { updateR(this); }
				if (objInp[i].checked)	updateR(objInp[i]);
			}
		}
		regdb('Onload RAD/CH', db);
	}

	if (_flag  && !_oflag)	{
		updatePriceNow();
	}

	if (_oflag === true)	regdb('Onload', '--- End of loading procedures ---');
	_oflag = true;
}

function updSP() {
	// adjust the second price display; create the div if necessary
	var flag = false; // error tracking flag

	if (_secondPrice !== false) { // second price is active
		var centre = document.getElementById('productGeneral');
		var temp = document.getElementById('productPrices');
		var itemp = document.getElementById(_secondPrice);

		if (objSP === false) { // create the second price object
			if (!temp || !itemp)	flag = true;

			if (!flag) {
				objSP = temp.cloneNode(true);
				objSP.id = temp.id + 'Second';
				regdb('updSP', 'Price node cloned!');

				if (!itemp.parentNode.insertBefore(objSP, itemp.nextSibling)) {
					regdb('updSP', 'Unable to insert node at point ' + _secondPrice);
				} else {
					regdb('updSP', 'Node inserted successfully');
				}
			} else {
				regdb('updSP', 'Unable to clone price node!');
			}
		}

		regdb('updSP', 'Duplicating price, by jove!');
		objSP.innerHTML = temp.innerHTML;
	} else { // second price inactive
		regdb('updSP', 'Cancelled');
	}
}

function adjQuan(objInp) {
	// adjust the global cart quantity for multiplication
	var newVal = Number(objInp.value.match(/[0-9]+/g));

	quantity = newVal;
	regdb('Quantity change', newVal);
	updatePriceNow();
	if (_sidebox !== false && objSB === false)	createSB();
	if (objSB !== false)	updateSB(); // update the sidebox
}

function updateR(objInp) {
    var temp = find_label(objInp); //FIND THE LABEL by rpa-com.de    
	var matches = temp.innerHTML.match(seeker);	
	//var matches = objInp.nextSibling.innerHTML.match(seeker);
	var priceAdj, totalAdj = 0;
	var flag = false;
	var db = '';

	if (matches) { // make sure this attribute is price-adjust-worthy
		db += '*Adj* - ';
		//priceAdj = Number(matches[3].replace(/,/g, '')); // Number(matches[0].match(/[0-9.]+/)[0]);
		priceAdj = Number(matches[3].replace(/,/g, '').replace(/\./g, '')); // Number(matches[0].match(/[0-9.]+/)[0]);		
	} else {
		db += '*No adj* - ';
		priceAdj = 0;
		//FIX RADIO AND CHECKBOX OPTION PRICE =  0,00 by web28 - www.rpa-com
		var matches = new Array();		
		matches[1]= '+';		
	}

	if (objInp.type == 'radio') {
		// the radio type input can be inserted into the array using its name as a reference as radio boxes are mutually
		// exclusive in their group
		db += 'Radio - Name: ' + objInp.name + ' - ';
		prArr[objInp.name] = new Array();
		prArr[objInp.name]['p'] = priceAdj; // push the price adjustment into the array referenced by the ID of the calling select		
		//prArr[objInp.name]['n'] = objInp.nextSibling.innerHTML.replace(seeker, '');
		prArr[objInp.name]['n'] = temp.innerHTML.replace(seeker, ''); //by web28 - www.rpa-com
		prArr[objInp.name]['m'] = matches[1];
		prArr[objInp.name]['l'] = matches[2]; // left side currency indeicator
		prArr[objInp.name]['r'] = matches[4]; // the right side currency indicator
		db += 'Price adjust: ' + priceAdj + ' - Mode: ' + matches[1];
	} 
	
	if (objInp.type == 'checkbox'){
		// checkboxes are always autonomous so can have multiple selections from a group so use the ID as before
		if (objInp.checked) {
			db += 'Checkbox - ID: ' + objInp.id + ' - ';
			prArr[objInp.id] = new Array();
			prArr[objInp.id]['p'] = priceAdj; // push the price adjustment into the array referenced by the ID of the calling select
			//prArr[objInp.id]['n'] = objInp.nextSibling.innerHTML.replace(seeker, ''); // attribute name, price removed
			prArr[objInp.id]['n'] = temp.innerHTML.replace(seeker, ''); //by web28 - www.rpa-com  // attribute name, price removed 
			prArr[objInp.id]['m'] = matches[1]; // the mode (+, - or base) of the attribute
			prArr[objInp.id]['l'] = matches[2]; // left side currency indeicator
			prArr[objInp.id]['r'] = matches[4]; // the right side currency indicator
			db += 'Price adjust: ' + priceAdj + ' - Mode: ' + matches[1];
		} else {
			prArr[objInp.id] = null;
			db = 'Checkbox ID ' + objInp.id + ' is now NULL';
		}
	}

	regdb('updateR', db);
	updatePriceNow();
}

function updatePrice(objSel) { // update the main price from the value extracted by the regex
	var matches = objSel[objSel.selectedIndex].text.match(seeker);
	var priceAdj, totalAdj = 0;
	var db = '';

	if (matches) { // make sure this attribute is price-adjust-worthy
		db = '*Adj* - ';
		//priceAdj = Number(matches[3].replace(/,/g, ''));
		priceAdj = Number(matches[3].replace(/,/g, '').replace(/\./g, '')); 
	} else {
		db = '*No adj* - ';
		priceAdj = 0;		
	}

	if (matches)	{
		prArr[objSel.id] = new Array();
		prArr[objSel.id]['p'] = priceAdj; // push the price adjustment into the array referenced by the ID of the calling select
		prArr[objSel.id]['n'] = objSel[objSel.selectedIndex].text.replace(seeker, '');
		prArr[objSel.id]['m'] = matches[1];
		prArr[objSel.id]['l'] = matches[2]; // left side currency indeicator
		prArr[objSel.id]['r'] = matches[4]; // the right side currency indicator
		db += 'ID: ' + objSel.id + ' - Price adjust: ' + priceAdj + ' - Mode: ' + matches[1];
	} else {
		prArr[objSel.id] = null;
		db = 'SELECT ID ' + objSel.id + ' is now NULL';
	}

	regdb('updatePrice', db);
	updatePriceNow();
}

function updatePriceNow() { // update the price display
	var totalAdj = 0;
	var db = '';
	var l = defaultCurrencyLeft;
	var r = defaultCurrencyRight;

	for (var i in prArr) {
		if (prArr[i]=='') { //if (prArr[i] !== null) {
			l = (prArr[i]['l'] == '' || typeof(prArr[i]['l']) == 'undefined' ? defaultCurrencyLeft : prArr[i]['l']);
			r = (prArr[i]['r'] == '' || typeof(prArr[i]['r']) == 'undefined' ? defaultCurrencyRight : prArr[i]['r']);
			db = 'Item: ' + prArr[i]['n'] + ' - ';
			switch (true) { // adjust the price according to its given mode
				case prArr[i]['m'] == '+': // add the attribute price to the base price
					db += 'Mode: Add';
					db += ' - totalAdj: ' + totalAdj + ' - Adding ' + prArr[i]['p'];
					totalAdj += prArr[i]['p'];
					break;
				case prArr[i]['m'] == '-': // subtract the attribute price from the base
					db += 'Mode: Subtract';
					db += ' - totalAdj: ' + totalAdj + ' - Subtracting ' + prArr[i]['p'];
					totalAdj -= prArr[i]['p'];
					break;
				case prArr[i]['m'] == '': // this means the attribute actually replaces the base price
					db += 'Mode: Base';
					db += ' - Altering base to ' + prArr[i]['p'];
					origPrice = prArr[i]['p'];
					break;
			}
			regdb('updatePriceNow', db);
		}
		
	}

	var newPrice = ((origPrice + totalAdj) * quantity / 100).toFixed(2);
	document.getElementById('productPrices').innerHTML = '<?php echo UPDATER_PREFIX_TEXT; ?>' + l + addCommas(newPrice) + r + (showQuantity ? ' (' + quantity + ')' : '');
	if (_sidebox !== false && objSB === false)	createSB();
	if (objSB !== false)	updateSB(); // update the sidebox
	updSP();
}

function createSB() { // create the sidebox for the attributes info display
	if (_sidebox !== false) {
		var temp = document.getElementById(_sidebox); // get a handle to the sidebox to insertBefore
		if (temp) {
			objSB = document.createElement('DIV'); // create the sidebox wrapper
			objSB.id = 'updaterSB';
			objSB.className = 'leftBoxContainer'; // set the CSS reference
			// create the heading bit
			var tempH = document.createElement('H3');
			tempH.id = 'updateSBHeading';
			tempH.className = 'leftBoxHeading';
			tempH.innerHTML = '<?php echo UPDATER_SB_TITLE; ?>';
			objSB.appendChild(tempH);
			// create the content div
			var tempC = document.createElement('DIV');
			tempC.id = 'updaterSBContent';
			tempC.className = 'sideBoxContent';
			tempC.innerHTML = 'If you can read this Chrome has broken something';
			objSB.appendChild(tempC);

			temp.parentNode.insertBefore(objSB, temp);
			regdb('createSB', 'Sidebox created!');
		} else {
			regdb('createSB', 'Sidebox could not be created!');
		}
	}
}

function updateSB() { // update the contents of the sidebox with the updated info from the attributes selector
	var newText = hText = '';
	var l = defaultCurrencyLeft;
	var r = defaultCurrencyRight;
	var totalAdj = origPrice;

	for (var i in prArr) {
		if (prArr[i]=='') { //if (prArr[i] !== null) {
			l = (prArr[i]['l'] == '' || typeof(prArr[i]['l']) == 'undefined' ? defaultCurrencyLeft : prArr[i]['l']);
			r = (prArr[i]['r'] == '' ? defaultCurrencyRight : prArr[i]['r']);

			if (prArr[i]['m'] !== null && prArr[i]['m'] != '')	{
				if (prArr[i]['m'] == '-')	newText += '<span style="color: red;">';
				newText += prArr[i]['n'] + (prArr[i]['p'] != 0 ? ' - ' + (showQuantitySB ? quantity + 'x ' : '') + prArr[i]['l'] + prArr[i]['p'].toFixed(2) + prArr[i]['r']: '') + '<br/>';
				if (prArr[i]['m'] == '-')	newText += '<\/span>';
				switch (true) { // adjust the price according to its given mode
					case prArr[i]['m'] == '+': // add the attribute price to the base price
						totalAdj += prArr[i]['p'];
						break;
					case prArr[i]['m'] == '-': // subtract the attribute price from the base
						totalAdj -= prArr[i]['p'];
						break;
					case prArr[i]['m'] == '': // this means the attribute actually replaces the base price
						origPrice = prArr[i]['p'];
						break;
				}
			}
		}
	}

	hText += '<?php echo UPDATER_BASIS; ?>' + (showQuantitySB ? quantity + 'x ' : '') + l + addCommas(origPrice.toFixed(2)) + r + '<br/>';
	newText += '<hr /><?php echo UPDATER_TOTAL; ?>' + l + addCommas((totalAdj * quantity).toFixed(2)) + r;

	// I know innerHTML is cheating but I careth not :)
	objSB.getElementsByTagName('DIV')[0].innerHTML = hText + newText;
}

function addCommas(nStr) //modified by rpa-com.de  - use defaultDecimal_Point, defaultThousands_Point
{ // this function can be found at http://www.mredkj.com/javascript/numberFormat.html#addcommas
	nStr += '';
	var x = nStr.split('.');
	var x1 = x[0];
	var x2 = x.length > 1 ? defaultDecimal_Point + x[1] : ''; //NEW by rpa-com.de //'.'
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + defaultThousands_Point + '$2'); // NEW by rpa-com.de //','
	}	
	return x1 + x2;	
}

function createdb () {
	var centre = document.getElementById('productGeneral');

	if (_dbdiv === false) {
		_dbdiv = document.createElement('DIV');
		_dbdiv.style.border = '2px dashed #666';
		_dbdiv.style.padding = '0.1em';
		centre.appendChild(_dbdiv)
	}
	_dbdiv.innerHTML = '<div style="cursor: pointer; width: 100%; text-align: center; margin-bottom: 5px; background-color: #aaa; padding: 1px; font-size: 110%; font-weight: bold;" onclick="createdb();">Debug messages<\/div>';
}

function regdb(strTitle, strText) { // simple routine to format and output the debug messages
	if (_debug === true) { // make sure debug messages should be displayed
		_dbdiv.innerHTML += '<div style="margin: 2px 0; background-color: #ddd; border-top: 1px solid #aaa; border-bottom: 1px solid #aaa;"><span style="font-weight: bold;">' + strTitle + ':<\/span> ' + strText + '<\/div>';
	}
}

// the following statements should allow multiple onload handlers to be applied
// I know this type of event registration is technically deprecated but I decided to use it because I haven't before
// There shouldn't be any fallout from the downsides of this method as only a single function is registered (and in the bubbling phase of each model)
// For backwards compatibility I've included the traditional DOM registration method
try { // the IE event registration model
	window.attachEvent('onload', init);
} catch (e) { // W3C event registration model
	window.addEventListener('load', init, false);
} finally {
	window.onload = init;
}

// ]]></script>