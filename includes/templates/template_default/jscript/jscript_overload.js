// workaround for using html entities in javascript i.e. alert function
// wflohr 26.9.06

// html entity  -> unicode translation table (thx ray)
var ent2uc = new Array();
ent2uc['nbsp'] = '00A0';	// no-break space = non-breaking space
ent2uc['iexcl'] = '00A1';	// inverted exclamation mark
ent2uc['cent'] = '00A2';	// cent sign
ent2uc['pound'] = '00A3';	// pound sign
ent2uc['curren'] = '00A4';	// currency sign
ent2uc['yen'] = '00A5';	// yen sign = yuan sign
ent2uc['brvbar'] = '00A6';	// broken bar = broken vertical bar
ent2uc['sect'] = '00A7';	// section sign
ent2uc['uml'] = '00A8';	// diaeresis = spacing diaeresis
ent2uc['copy'] = '00A9';	// copyright sign
ent2uc['ordf'] = '00AA';	// feminine ordinal indicator
ent2uc['laquo'] = '00AB';	// left-pointing double angle quotation mark = left pointing guillemet
ent2uc['not'] = '00AC';	// not sign
ent2uc['shy'] = '00AD';	// soft hyphen = discretionary hyphen
ent2uc['reg'] = '00AE';	// registered sign = registered trade mark sign
ent2uc['macr'] = '00AF';	// macron = spacing macron = overline = APL overbar
ent2uc['deg'] = '00B0';	// degree sign
ent2uc['plusmn'] = '00B1';	// plus-minus sign = plus-or-minus sign
ent2uc['sup2'] = '00B2';	// superscript two = superscript digit two = squared
ent2uc['sup3'] = '00B3';	// superscript three = superscript digit three = cubed
ent2uc['acute'] = '00B4';	// acute accent = spacing acute
ent2uc['micro'] = '00B5';	// micro sign
ent2uc['para'] = '00B6';	// pilcrow sign = paragraph sign
ent2uc['middot'] = '00B7';	// middle dot = Georgian comma = Greek middle dot
ent2uc['cedil'] = '00B8';	// cedilla = spacing cedilla
ent2uc['sup1'] = '00B9';	// superscript one = superscript digit one
ent2uc['ordm'] = '00BA';	// masculine ordinal indicator
ent2uc['raquo'] = '00BB';	// right-pointing double angle quotation mark = right pointing guillemet
ent2uc['frac14'] = '00BC';	// vulgar fraction one quarter = fraction one quarter
ent2uc['frac12'] = '00BD';	// vulgar fraction one half = fraction one half
ent2uc['frac34'] = '00BE';	// vulgar fraction three quarters = fraction three quarters
ent2uc['iquest'] = '00BF';	// inverted question mark = turned question mark
ent2uc['Agrave'] = '00C0';	// latin capital letter A with grave = latin capital letter A grave
ent2uc['Aacute'] = '00C1';	// latin capital letter A with acute
ent2uc['Acirc'] = '00C2';	// latin capital letter A with circumflex
ent2uc['Atilde'] = '00C3';	// latin capital letter A with tilde
ent2uc['Auml'] = '00C4';	// latin capital letter A with diaeresis
ent2uc['Aring'] = '00C5';	// latin capital letter A with ring above = latin capital letter A ring
ent2uc['AElig'] = '00C6';	// latin capital letter AE = latin capital ligature AE
ent2uc['Ccedil'] = '00C7';	// latin capital letter C with cedilla
ent2uc['Egrave'] = '00C8';	// latin capital letter E with grave
ent2uc['Eacute'] = '00C9';	// latin capital letter E with acute
ent2uc['Ecirc'] = '00CA';	// latin capital letter E with circumflex
ent2uc['Euml'] = '00CB';	// latin capital letter E with diaeresis
ent2uc['Igrave'] = '00CC';	// latin capital letter I with grave
ent2uc['Iacute'] = '00CD';	// latin capital letter I with acute
ent2uc['Icirc'] = '00CE';	// latin capital letter I with circumflex
ent2uc['Iuml'] = '00CF';	// latin capital letter I with diaeresis
ent2uc['ETH'] = '00D0';	// latin capital letter ETH
ent2uc['Ntilde'] = '00D1';	// latin capital letter N with tilde
ent2uc['Ograve'] = '00D2';	// latin capital letter O with grave
ent2uc['Oacute'] = '00D3';	// latin capital letter O with acute
ent2uc['Ocirc'] = '00D4';	// latin capital letter O with circumflex
ent2uc['Otilde'] = '00D5';	// latin capital letter O with tilde
ent2uc['Ouml'] = '00D6';	// latin capital letter O with diaeresis
ent2uc['times'] = '00D7';	// multiplication sign
ent2uc['Oslash'] = '00D8';	// latin capital letter O with stroke = latin capital letter O slash
ent2uc['Ugrave'] = '00D9';	// latin capital letter U with grave
ent2uc['Uacute'] = '00DA';	// latin capital letter U with acute
ent2uc['Ucirc'] = '00DB';	// latin capital letter U with circumflex
ent2uc['Uuml'] = '00DC';	// latin capital letter U with diaeresis
ent2uc['Yacute'] = '00DD';	// latin capital letter Y with acute
ent2uc['THORN'] = '00DE';	// latin capital letter THORN
ent2uc['szlig'] = '00DF';	// latin small letter sharp s = ess-zed
ent2uc['agrave'] = '00E0';	// latin small letter a with grave = latin small letter a grave
ent2uc['aacute'] = '00E1';	// latin small letter a with acute
ent2uc['acirc'] = '00E2';	// latin small letter a with circumflex
ent2uc['atilde'] = '00E3';	// latin small letter a with tilde
ent2uc['auml'] = '00E4';	// latin small letter a with diaeresis
ent2uc['aring'] = '00E5';	// latin small letter a with ring above = latin small letter a ring
ent2uc['aelig'] = '00E6';	// latin small letter ae = latin small ligature ae
ent2uc['ccedil'] = '00E7';	// latin small letter c with cedilla
ent2uc['egrave'] = '00E8';	// latin small letter e with grave
ent2uc['eacute'] = '00E9';	// latin small letter e with acute
ent2uc['ecirc'] = '00EA';	// latin small letter e with circumflex
ent2uc['euml'] = '00EB';	// latin small letter e with diaeresis
ent2uc['igrave'] = '00EC';	// latin small letter i with grave
ent2uc['iacute'] = '00ED';	// latin small letter i with acute
ent2uc['icirc'] = '00EE';	// latin small letter i with circumflex
ent2uc['iuml'] = '00EF';	// latin small letter i with diaeresis
ent2uc['eth'] = '00F0';	// latin small letter eth
ent2uc['ntilde'] = '00F1';	// latin small letter n with tilde
ent2uc['ograve'] = '00F2';	// latin small letter o with grave
ent2uc['oacute'] = '00F3';	// latin small letter o with acute
ent2uc['ocirc'] = '00F4';	// latin small letter o with circumflex
ent2uc['otilde'] = '00F5';	// latin small letter o with tilde
ent2uc['ouml'] = '00F6';	// latin small letter o with diaeresis
ent2uc['divide'] = '00F7';	// division sign
ent2uc['ugrave'] = '00F9';	// latin small letter u with grave
ent2uc['uacute'] = '00FA';	// latin small letter u with acute
ent2uc['ucirc'] = '00FB';	// latin small letter u with circumflex
ent2uc['uuml'] = '00FC';	// latin small letter u with diaeresis
ent2uc['yacute'] = '00FD';	// latin small letter y with acute
ent2uc['thorn'] = '00FE';	// latin small letter thorn
ent2uc['yuml'] = '00FF';	// latin small letter y with diaeresis
ent2uc['fnof'] = '0192';	// latin small f with hook = function = florin
ent2uc['Alpha'] = '0391';	// greek capital letter alpha
ent2uc['Beta'] = '0392';	// greek capital letter beta
ent2uc['Gamma'] = '0393';	// greek capital letter gamma
ent2uc['Delta'] = '0394';	// greek capital letter delta
ent2uc['Epsilon'] = '0395';	// greek capital letter epsilon
ent2uc['Zeta'] = '0396';	// greek capital letter zeta
ent2uc['Eta'] = '0397';	// greek capital letter eta
ent2uc['Theta'] = '0398';	// greek capital letter theta
ent2uc['Iota'] = '0399';	// greek capital letter iota
ent2uc['Kappa'] = '039A';	// greek capital letter kappa
ent2uc['Lambda'] = '039B';	// greek capital letter lambda
ent2uc['Mu'] = '039C';	// greek capital letter mu
ent2uc['Nu'] = '039D';	// greek capital letter nu
ent2uc['Xi'] = '039E';	// greek capital letter xi
ent2uc['Omicron'] = '039F';	// greek capital letter omicron
ent2uc['Pi'] = '03A0';	// greek capital letter pi
ent2uc['Rho'] = '03A1';	// greek capital letter rho
ent2uc['Sigma'] = '03A3';	// greek capital letter sigma
ent2uc['Tau'] = '03A4';	// greek capital letter tau
ent2uc['Upsilon'] = '03A5';	// greek capital letter upsilon
ent2uc['Phi'] = '03A6';	// greek capital letter phi
ent2uc['Chi'] = '03A7';	// greek capital letter chi
ent2uc['Psi'] = '03A8';	// greek capital letter psi
ent2uc['Omega'] = '03A9';	// greek capital letter omega
ent2uc['alpha'] = '03B1';	// greek small letter alpha
ent2uc['beta'] = '03B2';	// greek small letter beta
ent2uc['gamma'] = '03B3';	// greek small letter gamma
ent2uc['delta'] = '03B4';	// greek small letter delta
ent2uc['epsilon'] = '03B5';	// greek small letter epsilon
ent2uc['zeta'] = '03B6';	// greek small letter zeta
ent2uc['eta'] = '03B7';	// greek small letter eta
ent2uc['theta'] = '03B8';	// greek small letter theta
ent2uc['iota'] = '03B9';	// greek small letter iota
ent2uc['kappa'] = '03BA';	// greek small letter kappa
ent2uc['lambda'] = '03BB';	// greek small letter lambda
ent2uc['mu'] = '03BC';	// greek small letter mu
ent2uc['nu'] = '03BD';	// greek small letter nu
ent2uc['xi'] = '03BE';	// greek small letter xi
ent2uc['omicron'] = '03BF';	// greek small letter omicron
ent2uc['pi'] = '03C0';	// greek small letter pi
ent2uc['rho'] = '03C1';	// greek small letter rho
ent2uc['sigmaf'] = '03C2';	// greek small letter final sigma
ent2uc['sigma'] = '03C3';	// greek small letter sigma
ent2uc['tau'] = '03C4';	// greek small letter tau
ent2uc['upsilon'] = '03C5';	// greek small letter upsilon
ent2uc['phi'] = '03C6';	// greek small letter phi
ent2uc['chi'] = '03C7';	// greek small letter chi
ent2uc['psi'] = '03C8';	// greek small letter psi
ent2uc['omega'] = '03C9';	// greek small letter omega
ent2uc['thetasym'] = '03D1';	// greek small letter theta symbol
ent2uc['upsih'] = '03D2';	// greek upsilon with hook symbol
ent2uc['piv'] = '03D6';	// greek pi symbol
ent2uc['bull'] = '2022';	// bullet = black small circle
ent2uc['hellip'] = '2026';	// horizontal ellipsis = three dot leader
ent2uc['prime'] = '2032';	// prime = minutes = feet
ent2uc['Prime'] = '2033';	// double prime = seconds = inches
ent2uc['oline'] = '203E';	// overline = spacing overscore
ent2uc['frasl'] = '2044';	// fraction slash
ent2uc['weierp'] = '2118';	// script capital P = power set = Weierstrass p
ent2uc['image'] = '2111';	// blackletter capital I = imaginary part
ent2uc['real'] = '211C';	// blackletter capital R = real part symbol
ent2uc['trade'] = '2122';	// trade mark sign
ent2uc['alefsym'] = '2135';	// alef symbol = first transfinite cardinal
ent2uc['larr'] = '2190';	// leftwards arrow
ent2uc['uarr'] = '2191';	// upwards arrow
ent2uc['rarr'] = '2192';	// rightwards arrow
ent2uc['darr'] = '2193';	// downwards arrow
ent2uc['harr'] = '2194';	// left right arrow
ent2uc['crarr'] = '21B5';	// downwards arrow with corner leftwards = carriage return
ent2uc['lArr'] = '21D0';	// leftwards double arrow
ent2uc['uArr'] = '21D1';	// upwards double arrow
ent2uc['rArr'] = '21D2';	// rightwards double arrow
ent2uc['dArr'] = '21D3';	// downwards double arrow
ent2uc['hArr'] = '21D4';	// left right double arrow
ent2uc['forall'] = '2200';	// for all
ent2uc['part'] = '2202';	// partial differential
ent2uc['exist'] = '2203';	// there exists
ent2uc['empty'] = '2205';	// empty set = null set = diameter
ent2uc['nabla'] = '2207';	// nabla = backward difference
ent2uc['isin'] = '2208';	// element of
ent2uc['notin'] = '2209';	// not an element of
ent2uc['ni'] = '220B';	// contains as member
ent2uc['prod'] = '220F';	// n-ary product = product sign
ent2uc['sum'] = '2211';	// n-ary sumation
ent2uc['minus'] = '2212';	// minus sign
ent2uc['lowast'] = '2217';	// asterisk operator
ent2uc['radic'] = '221A';	// square root = radical sign
ent2uc['prop'] = '221D';	// proportional to
ent2uc['infin'] = '221E';	// infinity
ent2uc['ang'] = '2220';	// angle
ent2uc['and'] = '2227';	// logical and = wedge
ent2uc['or'] = '2228';	// logical or = vee
ent2uc['cap'] = '2229';	// intersection = cap
ent2uc['cup'] = '222A';	// union = cup
ent2uc['int'] = '222B';	// integral
ent2uc['there4'] = '2234';	// therefore
ent2uc['sim'] = '223C';	// tilde operator = varies with = similar to
ent2uc['cong'] = '2245';	// approximately equal to
ent2uc['asymp'] = '2248';	// almost equal to = asymptotic to
ent2uc['ne'] = '2260';	// not equal to
ent2uc['equiv'] = '2261';	// identical to
ent2uc['le'] = '2264';	// less-than or equal to
ent2uc['ge'] = '2265';	// greater-than or equal to
ent2uc['sub'] = '2282';	// subset of
ent2uc['sup'] = '2283';	// superset of
ent2uc['nsub'] = '2284';	// not a subset of
ent2uc['sube'] = '2286';	// subset of or equal to
ent2uc['supe'] = '2287';	// superset of or equal to
ent2uc['oplus'] = '2295';	// circled plus = direct sum
ent2uc['otimes'] = '2297';	// circled times = vector product
ent2uc['perp'] = '22A5';	// up tack = orthogonal to = perpendicular
ent2uc['sdot'] = '22C5';	// dot operator
ent2uc['lceil'] = '2308';	// left ceiling = apl upstile
ent2uc['rceil'] = '2309';	// right ceiling
ent2uc['lfloor'] = '230A';	// left floor = apl downstile
ent2uc['rfloor'] = '230B';	// right floor
ent2uc['lang'] = '2329';	// left-pointing angle bracket = bra
ent2uc['rang'] = '232A';	// right-pointing angle bracket = ket
ent2uc['loz'] = '25CA';	// lozenge
ent2uc['spades'] = '2660';	// black spade suit
ent2uc['clubs'] = '2663';	// black club suit = shamrock
ent2uc['hearts'] = '2665';	// black heart suit = valentine
ent2uc['diams'] = '2666';	// black diamond suit
ent2uc['quot'] = '0022';	// quotation mark = APL quote
ent2uc['amp'] = '0026';	// ampersand
ent2uc['lt'] = '003C';	// less-than sign
ent2uc['gt'] = '003E';	// greater-than sign
ent2uc['OElig'] = '0152';	// latin capital ligature OE
ent2uc['oelig'] = '0153';	// latin small ligature oe
ent2uc['Scaron'] = '0160';	// latin capital letter S with caron
ent2uc['scaron'] = '0161';	// latin small letter s with caron
ent2uc['Yuml'] = '0178';	// latin capital letter Y with diaeresis
ent2uc['circ'] = '02C6';	// modifier letter circumflex accent
ent2uc['tilde'] = '02DC';	// small tilde
ent2uc['ensp'] = '2002';	// en space
ent2uc['emsp'] = '2003';	// em space
ent2uc['thinsp'] = '2009';	// thin space
ent2uc['ndash'] = '2013';	// en dash
ent2uc['mdash'] = '2014';	// em dash
ent2uc['lsquo'] = '2018';	// left single quotation mark
ent2uc['rsquo'] = '2019';	// right single quotation mark
ent2uc['sbquo'] = '201A';	// single low-9 quotation mark
ent2uc['ldquo'] = '201C';	// left double quotation mark
ent2uc['rdquo'] = '201D';	// right double quotation mark
ent2uc['bdquo'] = '201E';	// double low-9 quotation mark
ent2uc['dagger'] = '2020';	// dagger
ent2uc['Dagger'] = '2021';	// double dagger
ent2uc['permil'] = '2030';	// per mille sign
ent2uc['euro'] = '20AC';	// euro sign

function entities2unicode(str) {
	var m, nchar;
	while(m = str.match(/&(\w+);/)) {
		if(ent2uc[m[1]]) {
			eval('nchar = "\\u' + ent2uc[m[1]] + '";');
		} else {
			nchar = '?';
		}
		str = str.replace(m[0], nchar);
	}
	return str;
}

function newAlert (msgpara) {
	alert0(entities2unicode(msgpara));
}

// override original browser alert
window.alert0 = window.alert;
window.alert = window.newAlert;

// override original Option constructor
window.Option0 = window.Option;
eval("function Option(s1, s2) { return new window.Option0(entities2unicode(s1),s2);};");