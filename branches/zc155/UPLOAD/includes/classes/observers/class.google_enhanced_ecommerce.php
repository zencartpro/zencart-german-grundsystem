<?php
/* **********************************************************************
 * Easy Google Analytics 2.2.0
 *
 * **********************************************************************/

class googleEnhancedEcommerceObserver extends base {
    function googleEnhancedEcommerceObserver() {
        $this->attach($this, array('NOTIFIER_CART_ADD_CART_START'));
    }

    function update(&$callingClass, $notifier, $paramsArray, $products_id, $qty, $attributes, $notify) {
    }
}
?>