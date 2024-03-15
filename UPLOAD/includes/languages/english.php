<?php
/**
* Zen Cart German Specific (158 code in 157 / zencartpro adaptations)
* 
* @copyright Copyright 2003-2024 Zen Cart Development Team
* Zen Cart German Version - www.zen-cart-pro.at
* @copyright Portions Copyright 2003 osCommerce
* @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
* @version $Id: english.php 2024-03-15 14:50:32Z webchills $
*/
// -----
// Since the languages are now loaded via classes, the $locales definition
// needs to be globalized for use in payment-methods (e.g. paypalwpp) and
// other processing.
// do NOT change or remove the following 3 lines
global $locales;
$locales = ['en_US', 'en_US.utf8', 'en', 'English_United States.1252'];
@setlocale(LC_TIME, $locales);
//
define('ARIA_DELETE_ITEM_FROM_CART','Delete this item from the cart');
define('ARIA_EDIT_QTY_IN_CART','Edit quantity in cart');
define('ARIA_PAGINATION_','');
define('ARIA_PAGINATION_CURRENTLY_ON','); now on page %s');
define('ARIA_PAGINATION_CURRENT_PAGE','Current Page');
define('ARIA_PAGINATION_ELLIPSIS_NEXT','Get next group of pages');
define('ARIA_PAGINATION_ELLIPSIS_PREVIOUS','Get previous group of pages');
define('ARIA_PAGINATION_GOTO','Go to ');
define('ARIA_PAGINATION_NEXT_PAGE','Go to Next Page');
define('ARIA_PAGINATION_PAGE_NUM','Page %s');
define('ARIA_PAGINATION_PREVIOUS_PAGE','Go to Previous Page');
define('ARIA_PAGINATION_ROLE_LABEL_FOR','%s Pagination');
define('ARIA_PAGINATION_ROLE_LABEL_GENERAL','Pagination');
define('ARIA_QTY_ADD_TO_CART','Enter quantity to add to cart');
define('ASK_A_QUESTION','Ask a question about this item');
define('ATTRIBUTES_PRICE_DELIMITER_PREFIX',' ( ');
define('ATTRIBUTES_PRICE_DELIMITER_SUFFIX',' )');
define('ATTRIBUTES_WEIGHT_DELIMITER_PREFIX',' (');
define('ATTRIBUTES_WEIGHT_DELIMITER_SUFFIX',') ');
define('BOX_HEADING_BANNER_BOX','Sponsors');
define('BOX_HEADING_BANNER_BOX2','Have you seen ...');
define('BOX_HEADING_BANNER_BOX_ALL','Sponsors');
define('BOX_HEADING_BESTSELLERS','Bestsellers');
define('BOX_HEADING_BRANDS','Shop by Brand');
define('BOX_HEADING_CATEGORIES','Categories');
define('BOX_HEADING_CURRENCIES','Currencies');
define('BOX_HEADING_CUSTOMER_ORDERS','Quick Re-Order');
define('BOX_HEADING_FEATURED_PRODUCTS','Featured');
define('BOX_HEADING_INFORMATION','Information');
define('BOX_HEADING_LANGUAGES','Languages');
define('BOX_HEADING_LINKS','&nbsp;&nbsp;[more]');
define('BOX_HEADING_MANUFACTURERS','Manufacturers');
define('BOX_HEADING_MANUFACTURER_INFO','Manufacturer Info');
define('BOX_HEADING_MORE_INFORMATION','More Information');
define('BOX_HEADING_NOTIFICATIONS','Notifications');
define('BOX_HEADING_REVIEWS','Reviews');
define('BOX_HEADING_SEARCH','Search');
define('BOX_HEADING_SHOPPING_CART','Shopping Cart');
define('BOX_HEADING_SPECIALS','Specials');
define('BOX_HEADING_WHATS_NEW','New Products');
define('BOX_INFORMATION_ABOUT_US','About Us');
define('BOX_INFORMATION_CONDITIONS','Conditions of Use');
define('BOX_INFORMATION_WIDERRUFSRECHT', 'Revocation Clause');
define('BOX_INFORMATION_ZAHLUNGSARTEN', 'Payment Options');
define('BOX_INFORMATION_IMPRESSUM', 'Imprint');
define('BOX_INFORMATION_CONTACT','Contact Us');
define('BOX_INFORMATION_DISCOUNT_COUPONS','Discount Coupons');
define('BOX_INFORMATION_ORDER_STATUS','Order Status');
define('BOX_INFORMATION_PAGE_2','Page 2');
define('BOX_INFORMATION_PAGE_3','Page 3');
define('BOX_INFORMATION_PAGE_4','Page 4');
define('BOX_INFORMATION_PRIVACY','Privacy Notice');
define('BOX_INFORMATION_SHIPPING','Shipping &amp; Returns');
define('BOX_INFORMATION_SITE_MAP','Site Map');
define('BOX_INFORMATION_UNSUBSCRIBE','Newsletter Unsubscribe');
define('BOX_MANUFACTURER_INFO_HOMEPAGE','%s Homepage');
define('BOX_MANUFACTURER_INFO_OTHER_PRODUCTS','Other products');
define('BOX_NOTIFICATIONS_NOTIFY','Notify me of updates to <strong>%s</strong>');
define('BOX_NOTIFICATIONS_NOTIFY_REMOVE','Do not notify me of updates to <strong>%s</strong>');
define('BOX_REVIEWS_NO_REVIEWS','There are currently no product reviews.');
define('BOX_REVIEWS_TEXT_OF_5_STARS','%s of 5 Stars!');
define('BOX_REVIEWS_WRITE_REVIEW','Write a review on this product.');
define('BOX_SEARCH_ADVANCED_SEARCH','Advanced Search');
define('BOX_SHOPPING_CART_EMPTY','Your cart is empty.');
define('CAPTION_UPCOMING_PRODUCTS','These items will be in stock soon');
define('CART_ITEMS','Items in Cart: ');
define('CART_QUANTITY_SUFFIX','&nbsp;x ');
define('CART_SHIPPING_METHOD_ADDRESS','Address:');
define('CART_SHIPPING_METHOD_ALL_DOWNLOADS','- Downloads');
define('CART_SHIPPING_METHOD_FREE_TEXT','Free Shipping');
define('CART_SHIPPING_METHOD_RATES','Rates');
define('CART_SHIPPING_METHOD_TEXT','Available Shipping Methods');
define('CART_SHIPPING_METHOD_TO','Ship to: ');
define('CART_SHIPPING_OPTIONS','Estimate Shipping Costs');
define('CART_SHIPPING_QUOTE_CRITERIA','Shipping quotes are based on the address information you selected:');
define('CATEGORIES_BOX_HEADING_FEATURED_PRODUCTS','Featured Products ...');
define('CATEGORIES_BOX_HEADING_PRODUCTS_ALL','All Products ...');
define('CATEGORIES_BOX_HEADING_SPECIALS','Specials ...');
define('CATEGORIES_BOX_HEADING_WHATS_NEW','New Products ...');
define('CATEGORY_COMPANY','Company Details');
define('CATEGORY_PERSONAL','Your Personal Details');
define('CHARSET','utf-8');
define('DATE_FORMAT','m/d/Y');
define('DATE_FORMAT_LONG','%A %d %B, %Y');
define('DB_ERROR_NOT_CONNECTED','Error - Could not connect to Database');
define('DIVERS', 'Divers/No Salutation'); 
define('DOB_FORMAT_STRING','mm/dd/yyyy');
define('DOWNLOADS_CONTROLLER_ON_HOLD_MSG','NOTE: Downloads are not available until payment has been confirmed');
define('EMAIL_SALUTATION','Dear');
define('EMAIL_SEND_FAILED','ERROR: Failed sending email to: "%s" <%s> with subject: "%s"');
define('EMPTY_CART_TEXT_NO_QUOTE','Whoops! Your session has expired ... Please update your shopping cart for Shipping Quote ...');
define('EMP_SHOPPING_FOR_MESSAGE','Currently shopping for %1$s (%2$s).');
define('ENTRY_CITY','City:');
define('ENTRY_CITY_ERROR','Your City must contain a minimum of ' . ENTRY_CITY_MIN_LENGTH . ' characters.');
define('ENTRY_CITY_TEXT','*');
define('ENTRY_COMPANY','Company Name:');
define('ENTRY_COMPANY_ERROR','Please enter a company name.');
define('ENTRY_COMPANY_TEXT','');
define('ENTRY_COUNTRY','Country:');
define('ENTRY_COUNTRY_ERROR','You must select a country from the Countries pull down menu.');
define('ENTRY_COUNTRY_TEXT','*');
define('ENTRY_CUSTOMERS_REFERRAL','Referral Code:');
define('ENTRY_DATE_FROM','Date From:');
define('ENTRY_DATE_OF_BIRTH','Date of Birth:');
define('ENTRY_DATE_OF_BIRTH_ERROR','Is your birth date correct? Our system requires the date in this format: MM/DD/YYYY (eg 05/21/1970) or this format: YYYY-MM-DD (eg 1970-05-21)');
define('ENTRY_DATE_OF_BIRTH_TEXT','* (eg. 05/21/1970 or 1970-05-21)');
define('ENTRY_DATE_TO','Date To:');
define('ENTRY_EMAIL','Email Address:');
define('ENTRY_EMAIL_ADDRESS','Email Address:');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR','Sorry, our system does not understand your email address. Please try again.');
define('ENTRY_EMAIL_ADDRESS_CONFIRM', 'Confirm Email:'); 
define('ENTRY_EMAIL_ADDRESS_CONFIRM_NOT_MATCHING', 'The email addresses provided do not match.'); 
define('ENTRY_EMAIL_ADDRESS_ERROR','Is your email address correct? It should contain at least ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' characters. Please try again.');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS','Our system already has a record of that email address - please try logging in with that email address. If you do not use that address any longer you can correct it in the My Account area.');
define('ENTRY_EMAIL_ADDRESS_TEXT','*');
define('ENTRY_EMAIL_CONTENT_CHECK_ERROR','Did you forget your message? We would like to hear from you. You can type your comments in the text area below.');
define('ENTRY_EMAIL_HTML_DISPLAY','HTML');
define('ENTRY_EMAIL_NAME_CHECK_ERROR','Sorry, is your name correct? Our system requires a minimum of ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' characters. Please try again.');
define('ENTRY_EMAIL_PREFERENCE','Newsletter and E-Mail Format'); 
define('ENTRY_EMAIL_TEXT_DISPLAY','TEXT-Only');
define('ENTRY_ENQUIRY','Message:');
define('ENTRY_FAX_NUMBER','Fax Number:');
define('ENTRY_FAX_NUMBER_TEXT','');
define('ENTRY_FIRST_NAME','First Name:');
define('ENTRY_FIRST_NAME_ERROR','Is your first name correct? Our system requires a minimum of ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' characters. Please try again.');
define('ENTRY_FIRST_NAME_TEXT','*');
define('ENTRY_GENDER','Salutation:');
define('ENTRY_GENDER_ERROR','Please choose a salutation.');
define('ENTRY_GENDER_TEXT','*');
define('ENTRY_INCLUDE_SUBCATEGORIES','Include Subcategories');
define('ENTRY_LAST_NAME','Last Name:');
define('ENTRY_LAST_NAME_ERROR','Is your last name correct? Our system requires a minimum of ' . ENTRY_LAST_NAME_MIN_LENGTH . ' characters. Please try again.');
define('ENTRY_LAST_NAME_TEXT','*');
define('ENTRY_NAME','Full Name:');
define('ENTRY_NEWSLETTER','Subscribe to Our Newsletter.');
define('ENTRY_NEWSLETTER_TEXT','');
define('ENTRY_NICK','Forum Nick Name:');
define('ENTRY_NICK_DUPLICATE_ERROR','That Nick Name is already being used. Please try another.');
define('ENTRY_NICK_TEXT','*');
define('ENTRY_PASSWORD','Password:');
define('ENTRY_PASSWORD_CONFIRMATION','Confirm Password:');
define('ENTRY_PASSWORD_CONFIRMATION_TEXT','*');
define('ENTRY_PASSWORD_CURRENT','Current Password:');
define('ENTRY_PASSWORD_CURRENT_TEXT','*');
define('ENTRY_PASSWORD_ERROR','Your Password must contain a minimum of ' . ENTRY_PASSWORD_MIN_LENGTH . ' characters.');
define('ENTRY_PASSWORD_ERROR_NOT_MATCHING','The Password Confirmation must match your Password.');
define('ENTRY_PASSWORD_NEW','New Password:');
define('ENTRY_PASSWORD_NEW_ERROR','Your new Password must contain a minimum of ' . ENTRY_PASSWORD_MIN_LENGTH . ' characters.');
define('ENTRY_PASSWORD_NEW_ERROR_NOT_MATCHING','The Password Confirmation must match your new Password.');
define('ENTRY_PASSWORD_NEW_TEXT','*');
define('ENTRY_PASSWORD_TEXT','* (at least ' . ENTRY_PASSWORD_MIN_LENGTH . ' characters)');
define('ENTRY_POST_CODE','Post/Zip Code:');
define('ENTRY_POST_CODE_ERROR','Your Post/ZIP Code must contain a minimum of ' . ENTRY_POSTCODE_MIN_LENGTH . ' characters.');
define('ENTRY_POST_CODE_TEXT','*');
define('ENTRY_PRICE_FROM','Price From:');
define('ENTRY_PRICE_TO','Price To:');
define('ENTRY_RECIPIENT_NAME','Recipient\'s Name:');
define('ENTRY_REQUIRED_SYMBOL','*');
define('ENTRY_STATE','State/Province:');
define('ENTRY_STATE_ERROR','Your State must contain a minimum of ' . ENTRY_STATE_MIN_LENGTH . ' characters.');
define('ENTRY_STATE_ERROR_SELECT','Please select a state from the States pull down menu.');
define('ENTRY_STATE_TEXT','*');
define('ENTRY_STREET_ADDRESS','Street Address:');
define('ENTRY_STREET_ADDRESS_ERROR','Your Street Address must contain a minimum of ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' characters.');
define('ENTRY_STREET_ADDRESS_TEXT','*');
define('ENTRY_SUBURB','Address Line 2:');
define('ENTRY_SUBURB_TEXT','');
define('ENTRY_TELEPHONE','Telephone Number:');
define('ENTRY_TELEPHONE_NUMBER','Telephone Number:');
define('ENTRY_TELEPHONE_NUMBER_ERROR','Your Telephone Number must contain a minimum of ' . ENTRY_TELEPHONE_MIN_LENGTH . ' characters.');
define('ENTRY_TELEPHONE_NUMBER_TEXT','*');
define('ERROR_AT_LEAST_ONE_INPUT','At least one of the fields in the search form must be entered.');
define('ERROR_CART_UPDATE','<strong>Please update your order.</strong> ');
define('ERROR_CONDITIONS_NOT_ACCEPTED','Please confirm you have read and agree to the terms and conditions bound to this order by ticking the box.');
define('ERROR_CORRECTIONS_HEADING','Please correct the following: <br>');
define('ERROR_CUSTOMERS_ID_INVALID','Customer information cannot be validated!<br>Please login or recreate your account ...');
define('ERROR_DATABASE_MAINTENANCE_NEEDED','<a href="https://docs.zen-cart.com/user/troubleshooting/error_71_maintenance_required/" rel="noopener" target="_blank">ERROR 0071 There appears to be a problem with the database. Maintenance is required.</a>');
define('ERROR_DESTINATION_DOES_NOT_EXIST','Error: destination does not exist.');
define('ERROR_DESTINATION_NOT_WRITEABLE','Error:  destination not writeable.');
define('ERROR_FILETYPE_NOT_ALLOWED','Error:  File type not allowed.');
define('ERROR_FILE_NOT_SAVED','Error:  File not saved.');
define('ERROR_FILE_TOO_BIG','Warning: File was too large to upload!<br>Order can be placed but please contact us for help with upload');
define('ERROR_INVALID_FROM_DATE','Invalid From Date.');
define('ERROR_INVALID_KEYWORDS','Invalid keywords.');
define('ERROR_INVALID_TO_DATE','Invalid To Date.');
define('ERROR_MAXIMUM_QTY','The quantity added to your cart has been adjusted because of a restriction on maximum you are allowed. See this item:<br>');
define('ERROR_MISSING_SEARCH_OPTIONS','Missing search options');
define('ERROR_NO_PAYMENT_MODULE_SELECTED','Please select a payment method for your order.');
define('ERROR_PRICE_FROM_MUST_BE_NUM','Price From must be a number.');
define('ERROR_PRICE_TO_LESS_THAN_PRICE_FROM','Price To must be greater than or equal to Price From.');
define('ERROR_PRICE_TO_MUST_BE_NUM','Price To must be a number.');
define('ERROR_PRIVACY_STATEMENT_NOT_ACCEPTED','Please confirm the privacy statement by ticking the box below.');
define('ERROR_PRODUCT','<br>The item: ');
define('ERROR_PRODUCT_ATTRIBUTES','<br>The item: ');
define('ERROR_PRODUCT_OPTION_SELECTION','<br> ... Invalid Option Values Selected ');
define('ERROR_PRODUCT_QUANTITY_MAX',' ... Maximum Quantity errors - ');
define('ERROR_PRODUCT_QUANTITY_MAX_SHOPPING_CART',' ... Maximum Quantity errors - ');
define('ERROR_PRODUCT_QUANTITY_MIN',');  ... Minimum Quantity errors - ');
define('ERROR_PRODUCT_QUANTITY_MIN_SHOPPING_CART','); has a minimum quantity restriction. ');
define('ERROR_PRODUCT_QUANTITY_ORDERED','<br>You ordered a total of: ');
define('ERROR_PRODUCT_QUANTITY_UNITS',' ... Quantity Units errors - ');
define('ERROR_PRODUCT_QUANTITY_UNITS_SHOPPING_CART',' ... Quantity Units errors - ');
define('ERROR_PRODUCT_STATUS_SHOPPING_CART','<br>We are sorry but this product has been removed from our inventory at this time.<br>This item has been removed from your shopping cart.');
define('ERROR_PRODUCT_STATUS_SHOPPING_CART_ATTRIBUTES','<br>We are sorry but selected options have changed for this product and have been removed from our inventory at this time.<br>This item has been removed from your shopping cart.');
define('ERROR_QUANTITY_ADJUSTED','The quantity added to your cart has been adjusted. The item you wanted is not available in fractional quantities. The quantity of item:<br>');
define('ERROR_QUANTITY_CHANGED_FROM','); has been changed from: ');
define('ERROR_QUANTITY_CHANGED_TO',' to ');
define('ERROR_TEXT_COUNTRY_DISABLED_PLEASE_CHANGE','Sorry, but we no longer accept billing or shipping addresses in "%s".  Please update this address to continue.');
define('ERROR_TO_DATE_LESS_THAN_FROM_DATE','To Date must be greater than or equal to From Date.');
define('FAILED_TO_ADD_UNAVAILABLE_PRODUCTS','The selected Product(s) are not currently available for purchase...');
define('FEMALE','Ms.');
define('FOOTER_TEXT_BODY','Copyright &copy; ' . date('Y') . ' <a href="' . zen_href_link(FILENAME_DEFAULT) . '">' . STORE_NAME . '</a>. Powered by <a href="https://www.zen-cart.com" rel="noopener noreferrer" target="_blank">Zen Cart</a>');
define('FORM_REQUIRED_INFORMATION','* Required information');
define('FREE_SHIPPING_DESCRIPTION','Free shipping for orders over %s');
define('HEADING_ADDRESS_INFORMATION','Address Information');
define('HEADING_BILLING_ADDRESS','Billing Address');
define('HEADING_DELIVERY_ADDRESS','Delivery Address');
define('HEADING_DOWNLOAD','To download your files click the download button and choose "Save to Disk" from the popup menu.');
define('HEADING_ORDER_COMMENTS','Special Instructions or Order Comments');
define('HEADING_ORDER_DATE','Order Date:');
define('HEADING_ORDER_HISTORY','Status History &amp; Comments');
define('HEADING_ORDER_NUMBER','Order #%s');
define('HEADING_PAYMENT_METHOD','Payment Method');
define('HEADING_PRODUCTS','Products');
define('HEADING_QUANTITY','Qty.');
define('HEADING_SEARCH_HELP','Search Help');
define('HEADING_SHIPPING_METHOD','Shipping Method');
define('HEADING_TAX','Tax');
define('HEADING_TOTAL','Total');
define('HTML_PARAMS','dir="ltr" lang="en"');
define('ICON_ERROR_ALT','Error');
define('ICON_IMAGE_ERROR','error.png');
define('ICON_IMAGE_SUCCESS','success.png');
define('ICON_IMAGE_TINYCART','cart.gif');
define('ICON_IMAGE_TRASH','small_delete.png');
define('ICON_IMAGE_UPDATE','button_update_cart.png');
define('ICON_IMAGE_WARNING','warning.png');
define('ICON_SUCCESS_ALT','Success');
define('ICON_TINYCART_ALT','Add this product to your cart by clicking here.');
define('ICON_TRASH_ALT','Delete');
define('ICON_UPDATE_ALT','Update');
define('ICON_WARNING_ALT','Warning');
define('IMAGE_ALT_PREFIX','(image for)');
define('IMAGE_ALT_TEXT_NO_TITLE','A generic image');
define('JS_ERROR','Errors have occurred during the processing of your form.\n\nPlease make the following corrections:\n\n');
define('JS_ERROR_NO_PAYMENT_MODULE_SELECTED','* Please select a payment method for your order.');
define('JS_ERROR_SUBMITTED','This form has already been submitted. Please press OK and wait for this process to be completed.');
define('JS_REVIEW_RATING','* Please choose a rating for this item.');
define('JS_REVIEW_TEXT','* Please add a few more words to your comments. The review needs to have at least ' . REVIEW_TEXT_MIN_LENGTH . ' characters.');
define('LANGUAGE_CURRENCY','EUR');
define('MALE','Mr.');
define('META_TAG_PRODUCTS_PRICE_IS_FREE_TEXT','It\'s Free!');
define('MORE_INFO_TEXT','... more info');
define('NOT_LOGGED_IN_TEXT','Not logged in');
define('ORDER_HEADING_DIVIDER','&nbsp;-&nbsp;');
define('OTHER_BOX_NOTIFY_REMOVE_ALT','Remove this product notification.');
define('OTHER_BOX_NOTIFY_YES_ALT','Notify me of updates to this product.');
define('OTHER_BOX_WRITE_REVIEW_ALT','Write a review on this product.');
define('OTHER_DOWN_FOR_MAINTENANCE_ALT','The site is currently down for maintenance. Please come back later.');
define('OTHER_IMAGE_BLACK_SEPARATOR','pixel_black.gif');
define('OTHER_IMAGE_BOX_NOTIFY_REMOVE','box_products_notifications_remove.gif');
define('OTHER_IMAGE_BOX_NOTIFY_YES','box_products_notifications.gif');
define('OTHER_IMAGE_BOX_WRITE_REVIEW','box_write_review.gif');
define('OTHER_IMAGE_CALL_FOR_PRICE','call_for_prices.png');
define('OTHER_IMAGE_CUSTOMERS_AUTHORIZATION','customer_authorization.gif');
define('OTHER_IMAGE_CUSTOMERS_AUTHORIZATION_ALT','CUSTOMER APPROVAL IS PENDING ...');
define('OTHER_IMAGE_DOWN_FOR_MAINTENANCE','down_for_maintenance.png');
define('OTHER_IMAGE_PRICE_IS_FREE','free.png');
define('OTHER_IMAGE_REVIEWS_RATING_STARS_FIVE','stars_5_small.png');
define('OTHER_IMAGE_REVIEWS_RATING_STARS_FOUR','stars_4_small.png');
define('OTHER_IMAGE_REVIEWS_RATING_STARS_ONE','stars_1_small.png');
define('OTHER_IMAGE_REVIEWS_RATING_STARS_THREE','stars_3_small.png');
define('OTHER_IMAGE_REVIEWS_RATING_STARS_TWO','stars_2_small.png');
define('OTHER_REVIEWS_RATING_STARS_FIVE_ALT','Five Stars');
define('OTHER_REVIEWS_RATING_STARS_FOUR_ALT','Four Stars');
define('OTHER_REVIEWS_RATING_STARS_ONE_ALT','One Star');
define('OTHER_REVIEWS_RATING_STARS_THREE_ALT','Three Stars');
define('OTHER_REVIEWS_RATING_STARS_TWO_ALT','Two Stars');
define('OUT_OF_STOCK_CANT_CHECKOUT','Products marked with ' . STOCK_MARK_PRODUCT_OUT_OF_STOCK . ' are out of stock or there are not enough in stock to fill your order.<br>Please change the quantity of products marked with (' . STOCK_MARK_PRODUCT_OUT_OF_STOCK . '). Thank you');
define('OUT_OF_STOCK_CAN_CHECKOUT','Products marked with ' . STOCK_MARK_PRODUCT_OUT_OF_STOCK . ' are out of stock.<br>Items not in stock will be placed on backorder.');
define('PAGE_ACCOUNT','My Account');
define('PAGE_ACCOUNT_EDIT','Account Information');
define('PAGE_ACCOUNT_HISTORY','Order History');
define('PAGE_ACCOUNT_NOTIFICATIONS','Newsletter Subscriptions');
define('PAGE_ADDRESS_BOOK','Address Book');
define('PAGE_ADVANCED_SEARCH','Search');
define('PAGE_CHECKOUT_SHIPPING','Checkout');
define('PAGE_FEATURED','Featured');
define('PAGE_PRODUCTS_ALL','All Products');
define('PAGE_PRODUCTS_NEW','New Products');
define('PAGE_REVIEWS','Reviews');
define('PAGE_SHOPPING_CART','Shopping Cart');
define('PAGE_SPECIALS','Specials');
define('PAYMENT_JAVASCRIPT_DISABLED','We could not continue with checkout as Javascript is disabled. You must enable it to continue');
define('PAYMENT_METHOD_GV','Gift Certificate/Coupon');
define('PAYMENT_MODULE_GV','GV/DC');
define('PLEASE_SELECT','Please select ...');
define('PREVNEXT_BUTTON_NEXT','[Next&nbsp;&raquo;]');
define('PREVNEXT_BUTTON_PREV','[&laquo;&nbsp;Prev]');
define('PREVNEXT_TITLE_NEXT_PAGE','Next Page');
define('PREVNEXT_TITLE_NEXT_SET_OF_NO_PAGE','Next Set of %d Pages');
define('PREVNEXT_TITLE_PAGE_NO','Page %d');
define('PREVNEXT_TITLE_PREVIOUS_PAGE','Previous Page');
define('PREVNEXT_TITLE_PREV_SET_OF_NO_PAGE','Previous Set of %d Pages');
define('PREV_NEXT_PRODUCT','Product ');
define('PRIMARY_ADDRESS_TITLE','Primary Address');
define('PRODUCTS_ORDER_QTY_TEXT','Add to Cart: ');
define('PRODUCTS_ORDER_QTY_TEXT_IN_CART','Quantity in Cart: ');
define('PRODUCTS_PRICE_IS_CALL_FOR_PRICE_TEXT','Call for Price');
define('PRODUCTS_PRICE_IS_FREE_TEXT','It\'s Free!');
define('PRODUCTS_QUANTITY_MAX_TEXT_LISTING','Max:');
define('PRODUCTS_QUANTITY_MIN_TEXT_LISTING','Min: ');
define('PRODUCTS_QUANTITY_UNIT_TEXT_LISTING','Units: ');
define('PRODUCT_PRICE_DISCOUNT_AMOUNT','&nbsp;off');
define('PRODUCT_PRICE_DISCOUNT_PERCENTAGE','% off');
define('PRODUCT_PRICE_DISCOUNT_PREFIX','Save:&nbsp;');
define('PRODUCT_PRICE_SALE','Sale:&nbsp;');
define('PULL_DOWN_ALL','Please Select');
define('PULL_DOWN_ALL_RESET','- RESET - ');
define('PULL_DOWN_DEFAULT','Please Choose Your Country');
define('PULL_DOWN_MANUFACTURERS','- Reset -');
define('PULL_DOWN_SHIPPING_ESTIMATOR_SELECT','Please Select');
define('SEND_TO_TEXT','Send Email To:');
define('SET_AS_PRIMARY','Set as Primary Address');
define('SUCCESS_ADDED_TO_CART_PRODUCT','Successfully added Product to the cart ...');
define('SUCCESS_ADDED_TO_CART_PRODUCTS','Successfully added selected Product(s) to the cart ...');
define('SUCCESS_FILE_SAVED_SUCCESSFULLY','Success:  file saved successfully.');
define('TABLE_ATTRIBUTES_QTY_PRICE_PRICE','PRICE');
define('TABLE_ATTRIBUTES_QTY_PRICE_QTY','QTY');
define('TABLE_HEADING_ADDRESS_DETAILS','Address Details');
define('TABLE_HEADING_BUY_NOW','Buy Now');
define('TABLE_HEADING_BYTE_SIZE','File Size');
define('TABLE_HEADING_CREDIT_PAYMENT','Credits Available');
define('TABLE_HEADING_DATE_EXPECTED','Date Expected');
define('TABLE_HEADING_DATE_OF_BIRTH','Verify Your Age');
define('TABLE_HEADING_DOWNLOAD_COUNT','Remaining');
define('TABLE_HEADING_DOWNLOAD_DATE','Link Expires');
define('TABLE_HEADING_DOWNLOAD_FILENAME','Filename');
define('TABLE_HEADING_FEATURED_PRODUCTS','Featured Products');
define('TABLE_HEADING_IMAGE','Product Image');
define('TABLE_HEADING_LOGIN_DETAILS','Login Details');
define('TABLE_HEADING_MANUFACTURER','Manufacturer');
define('TABLE_HEADING_MODEL','Model');
define('TABLE_HEADING_NEW_PRODUCTS','New Products For %s');
define('TABLE_HEADING_PHONE_FAX_DETAILS','Additional Contact Details');
define('TABLE_HEADING_PRICE','Price');
define('TABLE_HEADING_PRIVACY_CONDITIONS','Privacy Statement');
define('TABLE_HEADING_PRODUCTS','Product Name');
define('TABLE_HEADING_PRODUCT_NAME','Item Name');
define('TABLE_HEADING_QUANTITY','Qty.');
define('TABLE_HEADING_REFERRAL_DETAILS','Were You Referred to Us?');
define('TABLE_HEADING_SHIPPING_ADDRESS','Shipping Address');
define('TABLE_HEADING_SPECIALS_INDEX','Monthly Specials For %s');
define('TABLE_HEADING_STATUS_COMMENTS','Comments');
define('TABLE_HEADING_STATUS_DATE','Date');
define('TABLE_HEADING_STATUS_ORDER_STATUS','Order Status');
define('TABLE_HEADING_TOTAL','Total');
define('TABLE_HEADING_UPCOMING_PRODUCTS','Upcoming Products');
define('TABLE_HEADING_WEIGHT','Weight');
define('TEXT_ADMIN_DOWN_FOR_MAINTENANCE','NOTICE: The website is currently down for maintenance to the public');
define('TEXT_ALL_CATEGORIES','All Categories');
define('TEXT_ALL_MANUFACTURERS','All Manufacturers');
define('TEXT_ALSO_PURCHASED_PRODUCTS','Customers who bought this product also purchased...');
define('TEXT_APPROVAL_REQUIRED','<strong>NOTE:</strong>  Reviews require prior approval before they will be displayed.');
define('TEXT_ASCENDINGLY','ascendingly');
define('TEXT_ATTRIBUTES_PRICE_WAS',' [was: ');
define('TEXT_ATTRIBUTES_QTY_PRICES_HELP','Option Quantity Discounts');
define('TEXT_ATTRIBUTES_QTY_PRICES_ONETIME_HELP','Option Quantity Discounts Onetime Charges');
define('TEXT_ATTRIBUTES_QTY_PRICE_HELP_LINK','Quantity Discounts Available');
define('TEXT_ATTRIBUTE_IS_FREE',' now is: Free]');
define('TEXT_AUTHORIZATION_PENDING_BUTTON_REPLACE','APPROVAL PENDING');
define('TEXT_AUTHORIZATION_PENDING_CHECKOUT','Checkout Unavailable - Approval Pending');
define('TEXT_AUTHORIZATION_PENDING_PRICE','Price Unavailable');
define('TEXT_BANNER_BOX','Please Visit Our Sponsors ...');
define('TEXT_BANNER_BOX2','Check this out today!');
define('TEXT_BANNER_BOX_ALL','Please Visit Our Sponsors ...');
define('TEXT_BASE_PRICE','Starting at: ');
define('TEXT_BEFORE_DOWN_FOR_MAINTENANCE','NOTICE: This website is scheduled to be down for maintenance on: ');
define('TEXT_BY',' by ');
define('TEXT_CALL_FOR_PRICE','Call for price');
define('TEXT_CCVAL_ERROR_INVALID_DATE','The expiration date entered for the credit card is invalid. Please check the date and try again.');
define('TEXT_CCVAL_ERROR_INVALID_NUMBER','The credit card number entered is invalid. Please check the number and try again.');
define('TEXT_CCVAL_ERROR_UNKNOWN_CARD','The credit card number starting with %s was not entered correctly, or we do not accept that kind of card. Please try again or use another credit card.');
define('TEXT_CHARGES_LETTERS','Calculated Charge:');
define('TEXT_CHARGES_WORD','Calculated Charge:');
define('TEXT_CLICK_TO_ENLARGE','larger image');
define('TEXT_CLOSE_WINDOW_IMAGE',' - Click Image to Close');
define('TEXT_COUPON_GV_RESTRICTION_ZONES','Billing Address Restrictions apply.');
define('TEXT_COUPON_HELP_DATE','The coupon is valid between %s and %s');
define('TEXT_COUPON_HELP_HEADER','The Discount Coupon Redemption Code you have entered is for ');
define('TEXT_COUPON_HELP_MINORDER','You need to spend %s to use this coupon, on qualifying products.');
define('TEXT_COUPON_LINK_TITLE','see the Coupon conditions');
define('TEXT_CURRENT_CLOSE_WINDOW','[ Close Window ]');
define('TEXT_CURRENT_REVIEWS','Current Reviews:');
define('TEXT_DATE_ADDED','This product was added to our catalog on %s.');
define('TEXT_DATE_ADDED_LISTING','Date Added:');
define('TEXT_DATE_AVAILABLE','This product will be in stock on %s.');
define('TEXT_DESCENDINGLY','descendingly');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS','Displaying <strong>%d</strong> to <strong>%d</strong> (of <strong>%d</strong> Orders)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS','Displaying <strong>%d</strong> to <strong>%d</strong> (of <strong>%d</strong> Products)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_ALL','Displaying <strong>%d</strong> to <strong>%d</strong> (of <strong>%d</strong> Products)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_FEATURED_PRODUCTS','Displaying <strong>%d</strong> to <strong>%d</strong> (of <strong>%d</strong> Featured Products)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_NEW','Displaying <strong>%d</strong> to <strong>%d</strong> (of <strong>%d</strong> New Products)');
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS','Displaying <strong>%d</strong> to <strong>%d</strong> (of <strong>%d</strong> Reviews)');
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS','Displaying <strong>%d</strong> to <strong>%d</strong> (of <strong>%d</strong> Specials)');
define('TEXT_DOWNLOADS_UNLIMITED','Unlimited');
define('TEXT_DOWNLOADS_UNLIMITED_COUNT','--- *** ---');
define('TEXT_ERROR','An error has occurred');
define('TEXT_ERROR_OPTION_FOR',' On the Option for: ');
define('TEXT_EZPAGES_STATUS_FOOTER_ADMIN','WARNING: EZ-PAGES FOOTER - On for Admin IP Only');
define('TEXT_EZPAGES_STATUS_HEADER_ADMIN','WARNING: EZ-PAGES HEADER - On for Admin IP Only');
define('TEXT_EZPAGES_STATUS_SIDEBOX_ADMIN','WARNING: EZ-PAGES SIDEBOX - On for Admin IP Only');
define('TEXT_FIELD_REQUIRED','&nbsp;<span class="alert">*</span>');
define('TEXT_FILESIZE_BYTES',' bytes');
define('TEXT_FILESIZE_KBS',' KB');
define('TEXT_FILESIZE_MEGS',' MB');
define('TEXT_FILESIZE_UNKNOWN','Unknown');
define('TEXT_FOOTER_DISCOUNT_QUANTITIES','* Discounts may vary based on options above');
define('TEXT_GV_NAME','Gift Certificate');
define('TEXT_GV_NAMES','Gift Certificates');
define('TEXT_GV_REDEEM','Redemption Code');
define('TEXT_HEADER_DISCOUNTS_OFF','Qty Discounts Unavailable ...');
define('TEXT_HEADER_DISCOUNT_PRICES_ACTUAL_PRICE','Qty Discounts New Price');
define('TEXT_HEADER_DISCOUNT_PRICES_AMOUNT_OFF','Qty Discounts Off Price');
define('TEXT_HEADER_DISCOUNT_PRICES_PERCENTAGE','Qty Discounts Off Price');
define('TEXT_INFO_SORT_BY','Sort by:');
define('TEXT_INFO_SORT_BY_PRODUCTS_DATE','Date Added - Old to New');
define('TEXT_INFO_SORT_BY_PRODUCTS_DATE_DESC','Date Added - New to Old');
define('TEXT_INFO_SORT_BY_PRODUCTS_MODEL','Model');
define('TEXT_INFO_SORT_BY_PRODUCTS_NAME','Product Name');
define('TEXT_INFO_SORT_BY_PRODUCTS_NAME_DESC','Product Name - desc');
define('TEXT_INFO_SORT_BY_PRODUCTS_PRICE','Price - low to high');
define('TEXT_INFO_SORT_BY_PRODUCTS_PRICE_DESC','Price - high to low');
define('TEXT_INVALID_COUPON_ORDER_LIMIT','You have exceeded the total number of orders permitted (%2$u), to use the Coupon "%1$s".');
define('TEXT_INVALID_COUPON_PRODUCT','The Coupon "%1$s" is not valid for any product in your shopping cart.');
define('TEXT_INVALID_FINISHDATE_COUPON','The Coupon "%1$s" is now not valid (expired %2$s).');
define('TEXT_INVALID_REDEEM_COUPON','Coupon code "%s" is not a valid code.');
define('TEXT_INVALID_REDEEM_COUPON_MINIMUM','You must spend at least %2$s to redeem Coupon "%1$s".');
define('TEXT_INVALID_SELECTION',' You picked an Invalid Selection: ');
define('TEXT_INVALID_STARTDATE_COUPON','The Coupon "%1$s" is not valid for use until %2$s.');
define('TEXT_INVALID_USER_INPUT','User Input Required<br>');
define('TEXT_INVALID_USES_COUPON','Coupon "%1$s" has already been used the maximum permitted times (%2$u).');
define('TEXT_INVALID_USES_USER_COUPON','You have used Coupon "%1$s" the maximum number of times allowed per customer (%2$u).');
define('TEXT_LETTERS_FREE',' Letter(s) free ');
define('TEXT_LOGIN_FOR_PRICE_BUTTON_REPLACE','Login for price');
define('TEXT_LOGIN_FOR_PRICE_BUTTON_REPLACE_SHOWROOM','Show Room Only');
define('TEXT_LOGIN_FOR_PRICE_PRICE','Price Unavailable');
define('TEXT_LOGIN_FOR_PRICE_PRICE_SHOWROOM','');
define('TEXT_LOGIN_TO_SHOP_BUTTON_REPLACE','Login to Shop');
define('TEXT_MANUFACTURER','Manufacturer:');
define('TEXT_MAXIMUM_CHARACTERS_ALLOWED',' maximum characters allowed');
define('TEXT_MORE_INFORMATION','For more information, please visit this product\'s <a href="%s" rel="noreferrer noopener" target="_blank">webpage</a>.');
define('TEXT_NO_ALL_PRODUCTS','More products will be added soon. Please check back later.');
define('TEXT_NO_CAT_RESTRICTIONS','This coupon is valid for all categories.');
define('TEXT_NO_CAT_TOP_ONLY_DENY','This coupon has specific Product Restrictions.');
define('TEXT_NO_FEATURED_PRODUCTS','More featured products will be added soon. Please check back later.');
define('TEXT_NO_NEW_PRODUCTS','More new products will be added soon. Please check back later.');
define('TEXT_NO_PROD_RESTRICTIONS','This coupon is valid for all products.');
define('TEXT_NO_PROD_SALES','This coupon is not valid for products on sale.');
define('TEXT_NO_SHIPPING_AVAILABLE_ESTIMATOR', 'Sorry, we have no online options for shipping this order to the address selected.<br><br>Please login, or edit your desired shipping address to get updated quotes.<br><br>If quotes are still not available, please contact us to make alternate arrangements!');
define('TEXT_NO_REVIEWS','There are currently no product reviews.');
define('TEXT_NUMBER_SYMBOL','# ');
define('TEXT_OF_5_STARS','');
define('TEXT_ONETIME_CHARGES','*onetime charges = ');
define('TEXT_ONETIME_CHARGES_EMAIL',"\t" . '*onetime charges = ');
define('TEXT_ONETIME_CHARGE_DESCRIPTION',' One time charges may apply');
define('TEXT_ONETIME_CHARGE_SYMBOL',' *');
define('TEXT_OPTION_DIVIDER','&nbsp;-&nbsp;');
define('TEXT_OUT_OF_STOCK','Out of Stock');
define('TEXT_PASSWORD_FORGOTTEN','Forgot your password?');
define('TEXT_PER_LETTER','<br>Price per letter: ');
define('TEXT_PER_WORD','<br>Price per word: ');
define('TEXT_PRICE','Price:');
define('TEXT_PRIVACY_CONDITIONS_CONFIRM','I have read and agreed to your privacy statement.');
define('TEXT_PRIVACY_CONDITIONS_DESCRIPTION','Please acknowledge you agree with our privacy statement by ticking the following box. The privacy statement can be read <a href="' . zen_href_link(FILENAME_PRIVACY) . '"><span class="pseudolink">here</span></a>.');
define('TEXT_PRODUCTS_LISTING_ALPHA_SORTER','');
define('TEXT_PRODUCTS_LISTING_ALPHA_SORTER_NAMES','Items starting with ...');
define('TEXT_PRODUCTS_LISTING_ALPHA_SORTER_NAMES_RESET','-- Reset --');
define('TEXT_PRODUCTS_MIX_OFF','*Mixed OFF');
define('TEXT_PRODUCTS_MIX_OFF_SHOPPING_CART','<br>*You can not mix the options on this item to meet the minimum quantity requirement.*<br>');
define('TEXT_PRODUCTS_MIX_ON','*Mixed ON');
define('TEXT_PRODUCTS_MIX_ON_SHOPPING_CART','*Mixed Option Values is ON<br>');
define('TEXT_PRODUCTS_QUANTITY','In Stock: ');
define('TEXT_PRODUCTS_WEIGHT','Weight: ');
define('TEXT_PRODUCT_ALL_LISTING_MULTIPLE_ADD_TO_CART','Add: ');
define('TEXT_PRODUCT_FEATURED_LISTING_MULTIPLE_ADD_TO_CART','Add: ');
define('TEXT_PRODUCT_LISTING_MULTIPLE_ADD_TO_CART','Add: ');
define('TEXT_PRODUCT_MANUFACTURER','Manufactured by: ');
define('TEXT_PRODUCT_MODEL','Model: ');
define('TEXT_PRODUCT_NEW_LISTING_MULTIPLE_ADD_TO_CART','Add: ');
define('TEXT_PRODUCT_NOT_FOUND','Sorry, the product was not found.');
define('TEXT_PRODUCT_OPTIONS','Please Choose: ');
define('TEXT_PRODUCT_QUANTITY',' Units in Stock');
define('TEXT_PRODUCT_WEIGHT','Shipping Weight: ');
define('TEXT_PRODUCT_WEIGHT_UNIT',' lbs');
define('TEXT_REMOVE_REDEEM_COUPON_ZONE','The Coupon "%s" is not valid for the address you have selected.');
define('TEXT_RESULT_PAGE','');
define('TEXT_REVIEW_BY','by %s');
define('TEXT_REVIEW_DATE_ADDED','Date Added: %s');
define('TEXT_SEARCH_HELP','<p>Keywords may be separated by AND and/or OR statements for greater control of the search results.<br>For example, Microsoft AND mouse would return results that contain both words.<br>However, for mouse OR keyboard, the results returned would contain both or either words.</p><p>Exact matches can be found by enclosing the keywords in double-quotes.<br>For example, "notebook computer" would return results containing the exact string.</p><p>Parentheses may also be used for even finer control of results.<br>For example, Microsoft AND (keyboard OR mouse OR "visual basic").</p>');
define('TEXT_SEARCH_HELP_LINK','Search Help [?]');
define('TEXT_SEARCH_IN_DESCRIPTION','Search In Product Descriptions');
define('TEXT_SHIPPING_BOXES','Boxes');
define('TEXT_SHIPPING_WEIGHT',' lbs');
define('TEXT_SHOWCASE_ONLY','Contact Us');
define('TEXT_SORT_PRODUCTS','Sort products ');
define('TEXT_TOP','Top');
define('TEXT_TOTAL_AMOUNT','&nbsp;&nbsp;Amount: ');
define('TEXT_TOTAL_ITEMS','Total Items: ');
define('TEXT_TOTAL_WEIGHT','&nbsp;&nbsp;Weight: ');
define('TEXT_UNKNOWN_TAX_RATE','Sales Tax');
define('TEXT_VALID_COUPON','Congratulations you have redeemed the Discount Coupon');
define('TEXT_WORDS_FREE',' Word(s) free ');
define('TEXT_XSELL_PRODUCTS', 'Related Products');  
define('TEXT_YOUR_IP_ADDRESS','Your IP Address is: ');
define('TYPE_BELOW','Type a choice below ...');
define('WARNING_COULD_NOT_LOCATE_LANG_FILE','WARNING: Could not locate language file: ');
define('WARNING_NO_FILE_UPLOADED','Warning:  no file uploaded.');
define('WARNING_PRODUCT_QUANTITY_ADJUSTED','Quantity has been adjusted to what is in stock. ');
define('WARNING_SHOPPING_CART_COMBINED','NOTICE: For your convenience, your current shopping cart has been combined with your shopping cart from your last visit. Please review your shopping cart before checking out.');
// Definitions that require references to other definitions
define('ATTRIBUTES_QTY_PRICE_SYMBOL', zen_image(DIR_WS_TEMPLATE_ICONS . 'icon_status_green.gif', TEXT_ATTRIBUTES_QTY_PRICE_HELP_LINK, 10, 10) . '&nbsp;'); 
define('BOX_HEADING_GIFT_VOUCHER', TEXT_GV_NAME . ' Account'); 
define('BOX_INFORMATION_GV', TEXT_GV_NAME . ' FAQ'); 
define('ENTRY_EMAIL_PREFERENCE','Newsletter and Email Details'); 
if (ACCOUNT_NEWSLETTER_STATUS === '0') {
define('ENTRY_EMAIL_PREFERENCE','Email Details'); 
}
define('ERROR_NO_INVALID_REDEEM_GV', 'Invalid ' . TEXT_GV_NAME . ' ' . TEXT_GV_REDEEM); 
define('ERROR_NO_REDEEM_CODE', 'You did not enter a ' . TEXT_GV_REDEEM . '.'); 
define('ERROR_REDEEMED_AMOUNT', 'Congratulations, you have redeemed ');
define('GV_FAQ', TEXT_GV_NAME . ' FAQ');
define('TABLE_HEADING_CREDIT', 'Credits Available'); 
define('TEXT_AVAILABLE_BALANCE', 'Your ' . TEXT_GV_NAME . ' Account'); 
define('TEXT_BALANCE_IS', 'Your ' . TEXT_GV_NAME . ' balance is: '); 
define('TEXT_COUPON_GV_RESTRICTION','<p class="smallText">Discount Coupons may not be applied towards the purchase of ' . TEXT_GV_NAMES . '. Limit 1 coupon per order.</p>'); 
define('TEXT_SEND_OR_SPEND','You have a balance available in your ' . TEXT_GV_NAME . ' account. You may spend it or send it to someone else. To send click the button below.'); 
define('VOUCHER_BALANCE', TEXT_GV_NAME . ' Balance '); 