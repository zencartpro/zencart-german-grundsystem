<?php
/**
 * @package admin
 * @copyright Copyright 2003-2020 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: message_stack.php 734 2020-02-08 16:49:16Z webchills $
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
        $this->errors[] = array('params' => 'messageStackAlert alert alert-danger', 'text' => '<i class="fa fa-2x fa-exclamation-circle"></i> ' . $message);
      } elseif ($type == 'warning') {
        $this->errors[] = array('params' => 'messageStackAlert alert alert-warning', 'text' => '<i class="fa fa-2x fa-question-circle"></i> ' . $message);
      } elseif ($type == 'info') {
        $this->errors[] = array('params' => 'messageStackAlert alert alert-info', 'text' => '<i class="fa fa-2x fa-info-circle"></i> ' . $message);
      } elseif ($type == 'success') {
        $this->errors[] = array('params' => 'messageStackAlert alert alert-success', 'text' => '<i class="fa fa-2x fa-check-circle"></i> ' . $message);
      } elseif ($type == 'caution') {
        $this->errors[] = array('params' => 'messageStackAlert alert alert-warning', 'text' => '<i class="fa fa-2x fa-hand-stop-o"></i> ' . $message);
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