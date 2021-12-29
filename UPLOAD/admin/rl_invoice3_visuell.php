<?php
/**
 * @package pdf Rechnung
 * @copyright Copyright 2005-2012 langheiter.com 
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * Zen Cart German Version - www.zen-cart-pro.at
 * @copyright Portions Copyright 2003 osCommerce
 * @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
 * @version $Id: rl_invoice3_visuell.php 2016-06-19 07:19:17Z webchills $
 */

echo <<<BEG
<link href="rl_invoice3/css/rl_invoice3_ges.css" rel="stylesheet" type="text/css" />
  <div id="papercontainer">
    <div id="paper">paper
      <div id="writing">writing
        <div id="adr1" class="RL_INVOICE3_ADDRESS2_POS_Y">address1</div>
        <div id="adr2">address2</div>
        <div id="page2">page2</div>
        <div id="invoice">invoice</div>
        <div id="detail">detail</div>
      </div>
    </div>
  </div>
  <div id="form1">
    <form id="form2" name="form2" method="post" action="rl_invoice3_ajax.php?p=formsave" >
      <div class="row1">
        <label  for="RL_INVOICE3_ADDRESS1_POS_X">RL_INVOICE3_ADDRESS1_POS</label>
        <input name="RL_INVOICE3_ADDRESS1_POS_X" type="text" id="RL_INVOICE3_ADDRESS1_POS_X" class="x adr1" value="99" />
        <input name="RL_INVOICE3_ADDRESS1_POS_Y" type="text" id="RL_INVOICE3_ADDRESS1_POS_Y" class="y adr1" value="99" />
      </div>
      <div class="row1">
        <label for="RL_INVOICE3_ADDRESS2_POS">RL_INVOICE3_ADDRESS2_POS</label>
        <input name="RL_INVOICE3_ADDRESS2_POS_X" type="text" id="RL_INVOICE3_ADDRESS2_POS_X" class="x adr2" value="77" />
        <input name="RL_INVOICE3_ADDRESS2_POS_Y" type="text" id="RL_INVOICE3_ADDRESS2_POS_Y" class="y adr2" value="88" />
      </div>
      <div class="row1">
        <label for="RL_INVOICE3_DELTA">RL_INVOICE3_DELTA</label>
        <input name="RL_INVOICE3_DELTA_1" type="text" value="99" id="RL_INVOICE3_DELTA_1" class="y delta1" />
        <input name="RL_INVOICE3_DELTA_2" type="text" value="99" id="RL_INVOICE3_DELTA_2" class="y delta2" />
      </div>
      <div class="row1">
        <label for="RL_INVOICE3_MARGIN">RL_INVOICE3_MARGIN</label>
        <input name="RL_INVOICE3_MARGIN_TOP" type="text" class="m RL_INVOICE3_MARGIN_TOP" value="99" id="RL_INVOICE3_MARGIN_TOP" />
        <input name="RL_INVOICE3_MARGIN_RIGHT" type="text" class="m RL_INVOICE3_MARGIN_RIGHT" value="99" id="RL_INVOICE3_MARGIN_RIGHT" />
        <input name="RL_INVOICE3_MARGIN_BOTTOM" type="text" class="m RL_INVOICE3_MARGIN_BOTTOM" value="99" id="RL_INVOICE3_MARGIN_BOTTOM" />
        <input name="RL_INVOICE3_MARGIN_LEFT" type="text" class="m RL_INVOICE3_MARGIN_LEFT" value="99" id="RL_INVOICE3_MARGIN_LEFT" />
      </div>
      <div class="row1">
        <label for="RL_INVOICE3_PAPER">RL_INVOICE3_PAPER</label>
        <input name="RL_INVOICE3_PAPER_SIZE" type="text" class="RL_INVOICE3_PAPER_SIZE" value="A4" id="RL_INVOICE3_PAPER_SIZE" />
        <input name="RL_INVOICE3_PAPER_UNIT" type="text" class="RL_INVOICE3_PAPER_UNIT" value="mm" id="RL_INVOICE3_PAPER_UNIT" />
        <input name="RL_INVOICE3_PAPER_ORIANTATION" type="text" class="RL_INVOICE3_PAPER_ORIANTATION" value="P" id="RL_INVOICE3_PAPER_ORIANTATION" />
      </div>
      <div class="row1">
        <label for="RL_INVOICE3_DELTA_2PAGE">RL_INVOICE3_DELTA_2PAGE</label>
        <input name="RL_INVOICE3_DELTA_2PAGE" type="text" value="99" id="RL_INVOICE3_DELTA_2PAGE" class="y page2" />
      </div>
      <div class="row1">
        <label for="RL_INVOICE3_ADDRESS_WIDTH">RL_INVOICE3_ADDRESS_WIDTH</label>
        <input name="RL_INVOICE3_ADDRESS_WIDTH_1" type="text" class="w adr1" value="99" id="RL_INVOICE3_ADDRESS_WIDTH_1" />
        <input name="RL_INVOICE3_ADDRESS_WIDTH_2" type="text" class="w adr2" value="99" id="RL_INVOICE3_ADDRESS_WIDTH_2" />
      </div>
      <div class="row1">
        <label for="A4-Letter-Legal">A4/Letter/Legal</label>
        <input name="paperformat" type="radio" class="paper-format" value="0" checked="checked" id="A4-Letter-Legal" />
        <input name="paperformat" type="radio" class="paper-format" value="1" />
        <input name="paperformat" type="radio" class="paper-format" value="2" />
      </div>
      <div class="row1">
        <label for="orientation">Portrait/Landscape</label>
        <input name="oriantation" type="radio" class="paper-format" value="0" checked="checked" id="orientation" />
        <input name="oriantation" type="radio" class="paper-format" value="1" />
      </div>
      <div class="row1">
        <input type="submit" name="save" id="rl-save" value="Senden" />
      </div>
    </form>
  </div>
  <div id="result"></div>
<script src="rl_invoice3/ajax/rl_invoice3_template.js" type="text/javascript"></script>
BEG;
#sleep(1);
