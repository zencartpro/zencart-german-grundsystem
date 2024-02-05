<?php
/**
 * Zen Cart German Specific (158 code in 157)
 * @copyright Copyright 2003-2024 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: message_stack.php 2024-02-05 13:50:16Z webchills $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

/*
  Example usage:

  $messageStack = new messageStack();
  $messageStack->add('Error: Error 1', 'error');
  $messageStack->add('Error: Error 2', 'warning');
  if ($messageStack->size > 0) echo $messageStack->output();
*/

  class messageStack extends boxTableBlock {
    var $size = 0;
    var $errors = array();

    function add($message, $type = 'error') {
      if ($type == 'error') {
        $this->errors[] = array('params' => 'messageStackAlert alert alert-danger', 'text' => '<i class="fa-solid fa-2x fa-circle-exclamation"></i> ' . $message);
      } elseif ($type == 'warning') {
        $this->errors[] = array('params' => 'messageStackAlert alert alert-warning', 'text' => '<i class="fa-solid fa-2x fa-circle-question"></i> ' . $message);
      } elseif ($type == 'info') {
        $this->errors[] = array('params' => 'messageStackAlert alert alert-info', 'text' => '<i class="fa-solid fa-2x fa-circle-info"></i> ' . $message);
      } elseif ($type == 'success') {
        $this->errors[] = array('params' => 'messageStackAlert alert alert-success', 'text' => '<i class="fa-solid fa-2x fa-circle-check"></i> ' . $message);
      } elseif ($type == 'caution') {
        $this->errors[] = array('params' => 'messageStackAlert alert alert-warning', 'text' => '<i class="fa-solid fa-2x fa-hand"></i> ' . $message);
      } else {
        $this->errors[] = array('params' => 'messageStackAlert alert alert-danger', 'text' => $message);
      }


      $this->size++;
    }

    function add_session($message, $type = 'error') {

      if (!(!empty($_SESSION['messageToStack']) && is_array($_SESSION['messageToStack']))) {
        $_SESSION['messageToStack'] = array();
      }

      $_SESSION['messageToStack'][] = array('text' => $message, 'type' => $type);
    }
    
    function add_from_session() {
      if (isset($_SESSION['messageToStack']) && is_array($_SESSION['messageToStack'])) {
        for ($i = 0, $n = sizeof($_SESSION['messageToStack']); $i < $n; $i++) {
          $this->add($_SESSION['messageToStack'][$i]['text'], $_SESSION['messageToStack'][$i]['type']);
        }
        $_SESSION['messageToStack'] = '';
      }
    }

    function reset() {
      $this->errors = array();
      $this->size = 0;
    }

    function output() {
      $this->table_data_parameters = 'class="messageBox"';
      return $this->tableBlock($this->errors);
    }
  }