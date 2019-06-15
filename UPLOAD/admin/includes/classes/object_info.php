<?php
/**
 * @package admin
 * @copyright Copyright 2003-2019 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: object_info.php 731 2019-04-12 08:49:16Z webchills $
 */

/**
 * Class objectInfo
 */
class objectInfo
{
    /**
     * @param $object_array
     */
    public function __construct($object_array)
    {
        $this->updateObjectInfo($object_array);
    }

    /**
     * @param $object_array array
     */
    public function objectInfo($object_array)
    {
        if (!is_array($object_array)) return;

        foreach ($object_array as $key => $value) {
            $this->$key = zen_db_prepare_input($value);
        }
    }

    /**
     * @param $object_array array
     */
    public function updateObjectInfo($object_array)
    {
        if (!is_array($object_array)) return;

        foreach ($object_array as $key => $value) {
            $this->$key = zen_db_prepare_input($value);
        }
    }

    public function __isset($field)
    {
        return isset($this->$field);
    }

    public function __set($field, $value)
    {
        $this->$field = $value;
    }

    public function __get($field)
    {
        if (isset($this->$field)) return $this->$field;

        if ($field == 'keys') return array();

        return null;
    }
}
