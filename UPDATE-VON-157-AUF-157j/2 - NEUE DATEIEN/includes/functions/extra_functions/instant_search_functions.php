<?php
/**
 * @package  Instant Search Plugin for Zen Cart German
 * @author   marco-pm
 * @version  4.0.3
 * @see      https://github.com/marco-pm/zencart_instantsearch
 * @license  GNU Public License V2.0
 * Zen Cart German Specific
 * modified for Zen Cart German
 * 2024-04-05 webchills
 */

/**
 * Returns the number of (enabled) products per manufacturer.
 *
 * @param int $manufacturers_id Manufacturer's id
 *
 * @return int Products count
 */
function zen_count_products_for_manufacturer(int $manufacturers_id): int
{
    global $db;

    $products = $db->Execute("
        SELECT COUNT(products_id) AS total
        FROM " . TABLE_PRODUCTS . "
        WHERE manufacturers_id = " . $manufacturers_id . "
        AND products_status = 1
    ");

    return (int)$products->fields['total'];
}
/**
 * Returns the display price without vatAddon for instant search results.
 * If you really want to display the vatAddon notice at every price in the ajax search results remove this function
 * And then change in includes/classes/ajax/zcAjaxInstantSearch.php around line 242 from zen_get_products_display_price_instant_search to zen_get_products_display_price
 */

function zen_get_products_display_price_instant_search($product_id)
{
    global $currencies, $zco_notifier;

    $free_tag = '';
    $call_tag = '';

    // if in catalog, check whether customer should see prices
    if (IS_ADMIN_FLAG === false) {
        // 0 = normal shopping
        // 1 = Login to shop
        // 2 = Can browse but no prices
        // verify whether to display prices
        switch (true) {
            case (CUSTOMERS_APPROVAL == '1' && !zen_is_logged_in()):
                // customer must be logged in to browse
                return '';
                break;
            case (CUSTOMERS_APPROVAL == '2' && !zen_is_logged_in()):
                // customer may browse but no prices
                return TEXT_LOGIN_FOR_PRICE_PRICE;
                break;
            case (CUSTOMERS_APPROVAL == '3' && TEXT_LOGIN_FOR_PRICE_PRICE_SHOWROOM != ''):
                // customer may browse but no prices
                return TEXT_LOGIN_FOR_PRICE_PRICE_SHOWROOM;
                break;
            case (CUSTOMERS_APPROVAL_AUTHORIZATION != '0' && CUSTOMERS_APPROVAL_AUTHORIZATION != '3' && !zen_is_logged_in()):
                // customer must be logged in to browse
                return TEXT_AUTHORIZATION_PENDING_PRICE;
                break;
            case (CUSTOMERS_APPROVAL_AUTHORIZATION != '0' && CUSTOMERS_APPROVAL_AUTHORIZATION != '3' && (int)$_SESSION['customers_authorization'] > 0):
                // customer must be logged in to browse
                return TEXT_AUTHORIZATION_PENDING_PRICE;
                break;
            case (isset($_SESSION['customers_authorization']) && (int)$_SESSION['customers_authorization'] == 2):
                // customer is logged in and was changed to must be approved to see prices
                return TEXT_AUTHORIZATION_PENDING_PRICE;
                break;
            default:
                // proceed normally
                break;
        }

        // no prices when showcase only
        if (STORE_STATUS == '1') {
            return '';
        }
    }

    $product_check = zen_get_product_details($product_id);

    if ($product_check->EOF) return '';

    // no prices on Document General
    if ($product_check->fields['products_type'] == 3) {
        return '';
    }

    $display_special_price = false;
    $display_normal_price = zen_get_products_base_price($product_id);
    $display_sale_price = zen_get_products_special_price($product_id, false);

    if ($display_sale_price !== false) {
        $display_special_price = zen_get_products_special_price($product_id, true);
    }

    $show_sale_discount = '';
    if (SHOW_SALE_DISCOUNT_STATUS == '1' && ($display_special_price != 0 || $display_sale_price != 0)) {
        // -----
        // Allows an observer to inject any override to the "Sale Price" formatting.
        // If an override is performed, the observer sets the 'pricing_handled' value to true.
        //
        $pricing_handled = false;
        $zco_notifier->notify(
            'NOTIFY_ZEN_GET_PRODUCTS_DISPLAY_PRICE_SALE',
            [
                'products_id' => $product_id,
                'display_sale_price' => $display_sale_price,
                'display_special_price' => $display_special_price,
                'display_normal_price' => $display_normal_price,
                'products_tax_class_id' => $product_check->fields['products_tax_class_id']
            ],
            $pricing_handled,
            $show_sale_discount
        );
        if (!$pricing_handled) {
            if ($display_sale_price) {
                if (SHOW_SALE_DISCOUNT == 1) {
                    if ($display_normal_price != 0) {
                        $show_discount_amount = number_format(100 - (($display_sale_price / $display_normal_price) * 100), SHOW_SALE_DISCOUNT_DECIMALS);
                    } else {
                        $show_discount_amount = '';
                    }
                    $show_sale_discount = '<span class="productPriceDiscount">';
                    $show_sale_discount .= '<br>';
                    $show_sale_discount .= PRODUCT_PRICE_DISCOUNT_PREFIX;
                    $show_sale_discount .= $show_discount_amount;
                    $show_sale_discount .= PRODUCT_PRICE_DISCOUNT_PERCENTAGE;
                    $show_sale_discount .= '</span>';

                } else {
                    $show_sale_discount = '<span class="productPriceDiscount">';
                    $show_sale_discount .= '<br>';
                    $show_sale_discount .= PRODUCT_PRICE_DISCOUNT_PREFIX;
                    $show_sale_discount .= $currencies->display_price(($display_normal_price - $display_sale_price), zen_get_tax_rate($product_check->fields['products_tax_class_id']));
                    $show_sale_discount .= PRODUCT_PRICE_DISCOUNT_AMOUNT;
                    $show_sale_discount .= '</span>';
                }
            } else {
                if (SHOW_SALE_DISCOUNT == 1) {
                    $show_sale_discount = '<span class="productPriceDiscount">';
                    $show_sale_discount .= '<br>';
                    $show_sale_discount .= PRODUCT_PRICE_DISCOUNT_PREFIX;
                    $show_sale_discount .= number_format(100 - (($display_special_price / $display_normal_price) * 100), SHOW_SALE_DISCOUNT_DECIMALS);
                    $show_sale_discount .= PRODUCT_PRICE_DISCOUNT_PERCENTAGE;
                    $show_sale_discount .= '</span>';
                } else {
                    $show_sale_discount = '<span class="productPriceDiscount">';
                    $show_sale_discount .= '<br>';
                    $show_sale_discount .= PRODUCT_PRICE_DISCOUNT_PREFIX;
                    $show_sale_discount .= $currencies->display_price(($display_normal_price - $display_special_price), zen_get_tax_rate($product_check->fields['products_tax_class_id']));
                    $show_sale_discount .= PRODUCT_PRICE_DISCOUNT_AMOUNT;
                    $show_sale_discount .= '</span>';
                }
            }
        }
    }

    if ($display_special_price) {
        // -----
        // Allows an observer to inject any override to the "Special/Normal Prices'" formatting.
        //
        $pricing_handled = false;
        $zco_notifier->notify(
            'NOTIFY_ZEN_GET_PRODUCTS_DISPLAY_PRICE_SPECIAL',
            [
                'products_id' => $product_id,
                'display_sale_price' => $display_sale_price,
                'display_special_price' => $display_special_price,
                'display_normal_price' => $display_normal_price,
                'products_tax_class_id' => $product_check->fields['products_tax_class_id'],
                'product_is_free' => $product_check->fields['product_is_free']
            ],
            $pricing_handled,
            $show_normal_price,
            $show_special_price,
            $show_sale_price
        );
        if (!$pricing_handled) {
            $show_normal_price = '<span class="normalprice">';
            $show_normal_price .= $currencies->display_price($display_normal_price, zen_get_tax_rate($product_check->fields['products_tax_class_id']));
            $show_normal_price .= ' </span>';

            if ($display_sale_price && $display_sale_price != $display_special_price) {
                $show_special_price = '&nbsp;';
                $show_special_price .= '<span class="productSpecialPriceSale">';
                $show_special_price .= $currencies->display_price($display_special_price, zen_get_tax_rate($product_check->fields['products_tax_class_id']));
                $show_special_price .= '</span>';
                if ($product_check->fields['product_is_free'] == 1) {
                    $show_sale_price = '<br>';
                    $show_sale_price .= '<span class="productSalePrice">';
                    $show_sale_price .= PRODUCT_PRICE_SALE;
                    $show_sale_price .= '<s>';
                    $show_sale_price .= $currencies->display_price($display_sale_price, zen_get_tax_rate($product_check->fields['products_tax_class_id']));
                    $show_sale_price .= '</s>';
                    $show_sale_price .= '</span>';
                } else {
                    $show_sale_price = '<br>';
                    $show_sale_price .= '<span class="productSalePrice">';
                    $show_sale_price .= PRODUCT_PRICE_SALE;
                    $show_sale_price .= $currencies->display_price($display_sale_price, zen_get_tax_rate($product_check->fields['products_tax_class_id']));
                    $show_sale_price .= '</span>';
                }
            } else {
                if ($product_check->fields['product_is_free'] == 1) {
                    $show_special_price = '&nbsp;';
                    $show_special_price .= '<span class="productSpecialPrice">';
                    $show_special_price .= '<s>';
                    $show_special_price .= $currencies->display_price($display_special_price, zen_get_tax_rate($product_check->fields['products_tax_class_id']));
                    $show_special_price .= '</s>';
                    $show_special_price .= '</span>';
                } else {
                    $show_special_price = '&nbsp;';
                    $show_special_price .= '<span class="productSpecialPrice">';
                    $show_special_price .= $currencies->display_price($display_special_price, zen_get_tax_rate($product_check->fields['products_tax_class_id']));
                    $show_special_price .= '</span>';
                }
                $show_sale_price = '';
            }
        }
    } else {
        // -----
        // Allows an observer to inject any override to the "Normal Prices'" formatting.
        //
        $pricing_handled = false;
        $zco_notifier->notify(
            'NOTIFY_ZEN_GET_PRODUCTS_DISPLAY_PRICE_NORMAL',
            [
                'products_id' => $product_id,
                'display_sale_price' => $display_sale_price,
                'display_special_price' => $display_special_price,
                'display_normal_price' => $display_normal_price,
                'products_tax_class_id' => $product_check->fields['products_tax_class_id'],
                'product_is_free' => $product_check->fields['product_is_free']
            ],
            $pricing_handled,
            $show_normal_price,
            $show_special_price,
            $show_sale_price
        );
        if (!$pricing_handled) {
            if ($display_sale_price) {
                $show_normal_price = '<span class="normalprice">';
                $show_normal_price .= $currencies->display_price($display_normal_price, zen_get_tax_rate($product_check->fields['products_tax_class_id']));
                $show_normal_price .= ' </span>';

                $show_special_price = '';

                $show_sale_price = '<br>';
                $show_sale_price .= '<span class="productSalePrice">';
                $show_sale_price .= PRODUCT_PRICE_SALE;
                $show_sale_price .= $currencies->display_price($display_sale_price, zen_get_tax_rate($product_check->fields['products_tax_class_id']));
                $show_sale_price .= '</span>';
            } else {
                if ($product_check->fields['product_is_free'] == 1) {
                    $show_normal_price = '<span class="productFreePrice">';
                    $show_normal_price .= '<s>';
                    $show_normal_price .= $currencies->display_price($display_normal_price, zen_get_tax_rate($product_check->fields['products_tax_class_id']));
                    $show_normal_price .= '</s>';
                    $show_normal_price .= '</span>';
                } else {
                    $show_normal_price = '<span class="productBasePrice">';
                    $show_normal_price .= $currencies->display_price($display_normal_price, zen_get_tax_rate($product_check->fields['products_tax_class_id']));
                    $show_normal_price .= '</span>';
                }
                $show_special_price = '';
                $show_sale_price = '';
            }
        }
    }

    if ($display_normal_price == 0) {
        // don't show the $0.00
        $final_display_price = $show_special_price . $show_sale_price . $show_sale_discount;
    } else {
        $final_display_price = $show_normal_price . $show_special_price . $show_sale_price . $show_sale_discount;
    }

    // -----
    // Allows an observer to inject any override to the "Free" and "Call for Price" formatting.
    //
    $tags_handled = false;
    $zco_notifier->notify(
        'NOTIFY_ZEN_GET_PRODUCTS_DISPLAY_PRICE_FREE_OR_CALL',
        [
            'product_is_free' => $product_check->fields['product_is_free'],
            'product_is_call' => $product_check->fields['product_is_call'],
        ],
        $tags_handled,
        $free_tag,
        $call_tag
    );
    if (!$tags_handled) {
        // If Free, Show it
        if ($product_check->fields['product_is_free'] == 1) {
            $free_tag = '<br>';
            if (OTHER_IMAGE_PRICE_IS_FREE_ON == '0') {
                $free_tag .= PRODUCTS_PRICE_IS_FREE_TEXT;
            } else {
                $free_tag .= zen_image(DIR_WS_TEMPLATE_IMAGES . OTHER_IMAGE_PRICE_IS_FREE, PRODUCTS_PRICE_IS_FREE_TEXT);
            }
        }

        // If Call for Price, Show it
        if ($product_check->fields['product_is_call']) {
            $call_tag = '<br>';
            if (PRODUCTS_PRICE_IS_CALL_IMAGE_ON == 0) {
                $call_tag .= PRODUCTS_PRICE_IS_CALL_FOR_PRICE_TEXT;
            } else {
                $call_tag .= zen_image(DIR_WS_TEMPLATE_IMAGES . OTHER_IMAGE_CALL_FOR_PRICE, PRODUCTS_PRICE_IS_CALL_FOR_PRICE_TEXT);
            }
        }
    }    
    return $final_display_price . $free_tag . $call_tag;    
}