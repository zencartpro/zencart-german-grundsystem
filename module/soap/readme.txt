1. copy zen_root into your shop
2. run soap.wsdl.change.php to change the ZenCart.wsdl (write rights!!!)

3. copy zencart-soap-example\standalone into a webfolder
4. change soap.xajax.common.php
	$se = new SoapExample('http://YourShopUrl/soap/ZenCart.wsdl');  

5. point your browser to 
	http://webfolder/soap.example.php

have fun
hugo13
questions to: rainer[AT]ar-pub.com
