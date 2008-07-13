<!-- bof Better Together Marketing -->
<?php 
  // Better Together Discount Marketing
  $value = "ot_better_together.php";
  include_once(zen_get_file_directory(DIR_WS_LANGUAGES . $_SESSION['language'] .
          '/modules/order_total/', $value, 'false'));
  include_once(DIR_WS_MODULES . "order_total/" . $value);
  $discount = new ot_better_together();
  if ($discount->check() > 0) { 
     $resp = $discount->get_discount_info($_GET['products_id'], $current_category_id); 
     $rresp = $discount->get_reverse_discount_info($_GET['products_id'], $current_category_id); 
     if ( (count($resp) > 0) || (count($rresp) > 0) ) {
        echo '<div class="content" id="betterTogetherDiscountPolicy">';
        for ($i=0, $n=count($resp); $i<$n; $i++) {
              echo $resp[$i] . "<br />"; 
        }
        // Now the reverse info (new in Better Together 1.3)
        for ($i=0, $n=count($rresp); $i<$n; $i++) {
              echo $rresp[$i] . "<br />"; 
        }
        echo '</div>';
        echo '<br class="clearBoth" />'; 
     }
  }
?>
<!-- eof Better Together Marketing -->
