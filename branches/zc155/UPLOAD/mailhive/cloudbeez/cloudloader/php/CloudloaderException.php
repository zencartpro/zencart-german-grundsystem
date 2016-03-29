<?php
/*
  MailBeez Automatic Trigger Email Campaigns
  http://www.mailbeez.com

  Copyright (c) 2010 - 2015 MailBeez

  inspired and in parts based on
  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License (Version 2)
  [http://www.gnu.org/licenses/gpl-2.0.html]

 */
    


class CloudloaderException extends Exception
{
    public $field;

    public function __construct($message, $field)
    {
        parent::__construct($message);
        $this->field = $field;
    }
}
