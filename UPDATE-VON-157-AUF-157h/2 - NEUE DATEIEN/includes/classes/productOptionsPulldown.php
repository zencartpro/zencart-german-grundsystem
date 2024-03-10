<?php
/**
 * Class productOptionsPulldown 
 *
 * Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: productOptionsPulldown.php 2023-10-24 20:31:16Z webchills $
 */

    class productOptionsPulldown extends pulldown
    {
        /**
         *
         */
        public function __construct()
        {
            parent::__construct();

            $this->sort = " ORDER BY products_options_name";

            $this->keyword_search_fields = [
                'products_options_name',
            ];
        }

        /**
         * @return mixed|void
         */
        protected function setSQL()
        {
            $this->sql = "SELECT products_options_id, products_options_name
                                    FROM " . TABLE_PRODUCTS_OPTIONS . "
                                    WHERE language_id = " . $_SESSION['languages_id'];
        }

        /**
         * @return mixed|void
         */
        protected function processSQL()
        {
            $this->setSQL();
            $this->runSQL();

            $this->values[] = [
                'id' => '',
                'text' => PLEASE_SELECT
            ];

            foreach ($this->results as $result) {
                $this->values[] = [
                    'id' => $result['products_options_id'],
                    'text' => $this->optionText($result),
                ];
            }
        }

        /**
         * @param $optionValue
         *
         * @return string
         */
        private function optionText($optionValue)
        {
            $return = "(" . $optionValue['products_options_id'] . ") " . $optionValue['products_options_name'];
            return $return;
        }
    }
