<?php
/**
 * Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: salemaker_info.php 2023-10-28 15:49:16Z webchills $
 */

define('HEADING_TITLE', 'Salemaker');
define('SUBHEADING_TITLE', 'Salemaker Usage Tips:');
define('INFO_TEXT', '<ul>
                      <li>
                        Always use a \'.\' as decimal point as the decimal separator for deduction and pricerange.
                      </li>
                      <li>
                        Enter amounts in the same currency as when creating/editing a product.
                      </li>
                      <li>
                        In the Deduction fields, you can enter an amount or a percentage to deduct,
                        or a replacement price. (eg. deduct $5.00 from all prices, deduct 10% from
                        all prices or change all prices to $25.00)
                      </li>
                      <li>
                        Entering a price range restricts the products that will be affected. (eg.
                        only products from $50.00 to $150.00)
                      </li>
                      <li>
                        You must choose the action to take if a product is a special <i>and</i> is subject to this sale:
						<ul>
                          <li>
                            <strong>Ignore Specials Price - Apply to Product Price and Replace Special</strong><br>
							The salededuction will be applied to the regular price of the product.
                            (eg. Regular price $10.00, Specials price is $9.50, SaleCondition is 10%.
							The product\'s final price will show $9.00 on sale. The Specials price is ignored.)
                          </li>
                          <li>
                            <strong>Ignore SaleCondition - No Sale Applied When Special Exists</strong><br>
                            The sale deduction will not be applied to Specials. The Specials price will display 
                            independently of the sale. (eg. Regular price $10.00, Specials price is $9.50,
                            Sale Condition is 10%. The product\'s final price will show $9.50 on sale.
                            The Sale Condition is ignored.)
                          </li>
                          <li>
                            <strong>Apply the Sale Deduction to the Special Price - Otherwise Apply to Price</strong><br>
                            The sale deduction will be applied to the Special price. A compounded price will be displayed.
                            (eg. Regular price $10.00, Specials price is $9.50, SaleCondition is 10%. The product\'s
                            final price will show $8.55. An additional 10% off the Specials price.)
                          </li>
                        </ul>
                      </li>
                      <li>
                        Leaving the start date empty will start the sale immediately.
                      </li>
                      <li>
                        Leave the end date empty if you do not want the sale to expire.</li>
                      <li>
                        Checking a category automatically includes the sub-categories.
                      </li>
                    </ul>');
