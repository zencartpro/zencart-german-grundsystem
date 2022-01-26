<?php
// -----
// Part of the "Cross Sell Advanced II" plugin by lat9.
//
if (!defined('IS_ADMIN_FLAG') || IS_ADMIN_FLAG !== true) {
    die('Illegal Access');
}

class XsellAdminObserver extends base 
{
    public function __construct() 
    {
        // -----
        // If the plugin's configuration is set, register for notifications from
        // various admin elements associated with an order's status-history updates.
        //
        if (defined('XSELL_VERSION')) {
            // -----
            // Always watch for notifications from the core Customers::Orders.
            //
            $this->attach(
                $this, 
                [
                    /* From /admin/general.php (zen_remove_product) */
                    'NOTIFIER_ADMIN_ZEN_REMOVE_PRODUCT',
                ]
            );
        }
    }

    public function update(&$class, $eventID, $p1, &$p2, &$p3, &$p4)
    {
        switch ($eventID) {
            // -----
            // Issued by /admin/includes/functions/general.php at the beginning of the function
            // zen_remove_product (which, er, removes a product).
            //
            // Any reference to that product in the products_xsell table is also removed.
            //
            // On entry:
            //
            // $p1 ... n/a
            // $p2 ... Contains a reference to the current to-be-removed product's ID.
            //
            case 'NOTIFIER_ADMIN_ZEN_REMOVE_PRODUCT':
                global $db, $messageStack;

                $products_id = $p2;
                $db->Execute(
                    "DELETE FROM " . TABLE_PRODUCTS_XSELL . "
                      WHERE products_id = $products_id
                         OR xsell_id = $products_id"
                );
                $xsells_removed = $db->affectedRows();
                if ($xsells_removed !== 0) {
                    $messageStack->add_session(sprintf(MESSAGE_XSELL_REMOVED, $xsells_removed), 'warning');
                }
                break;
 
            default:
                break;
        }
    }
}
