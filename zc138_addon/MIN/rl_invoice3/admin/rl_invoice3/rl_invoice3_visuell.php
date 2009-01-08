<?php

echo <<<BEG
<link href="css/rl_invoice3_dialog.css" rel="stylesheet" type="text/css" />
<div id="header"><span id="result">RESULT</span></div>
<div id="form1">
  <form id="form2" name="form2" method="post" action="rl_invoice3_ajax.php?p=formsave">
    <label  for="label">RL_INVOICE3_ADDRESS1_POS</label>
    <input class="xxx" name="RL_INVOICE3_ADDRESS1_POS" type="text" id="RL_INVOICE3_ADDRESS1_POS" value="0|30" />
    <br />
    <label for="RL_INVOICE3_ADDRESS2_POS">RL_INVOICE3_ADDRESS2_POS</label>
    <input name="RL_INVOICE3_ADDRESS2_POS" type="text" id="RL_INVOICE3_ADDRESS2_POS" class="red" value="90|36" />
    <br />
    <label for="RL_INVOICE3_DELTA">RL_INVOICE3_DELTA</label>
    <input name="RL_INVOICE3_DELTA" type="text" id="RL_INVOICE3_DELTA" value="20|20" />
    <br />
    <label for="RL_INVOICE3_MARGIN">RL_INVOICE3_MARGIN</label>
    <input name="RL_INVOICE3_MARGIN" type="text" id="RL_INVOICE3_MARGIN" value="25|10|30|20" />
    <br />
    <label for="RL_INVOICE3_PAPER">RL_INVOICE3_PAPER</label>
    <input name="RL_INVOICE3_PAPER" type="text" id="RL_INVOICE3_PAPER" value="A4|mm|P" />
    <br />
    <label for="RL_INVOICE3_DELTA_2PAGE">RL_INVOICE3_DELTA_2PAGE</label>
    <input name="RL_INVOICE3_DELTA_2PAGE" type="text" id="RL_INVOICE3_DELTA_2PAGE" value="20" />
    <br />
    <label for="RL_INVOICE3_ADDRESS_WIDTH">RL_INVOICE3_ADDRESS_WIDTH</label>
    <input name="RL_INVOICE3_ADDRESS_WIDTH" type="text" id="RL_INVOICE3_ADDRESS_WIDTH" class="red" value="80|60" />
    <br />
    <br />
    <label for="A4/Letter/Legal">A4/Letter/Legal</label>
    <input name="paperformat" type="radio" class="paper-format" value="0" checked="checked" />
    <input name="paperformat" type="radio" class="paper-format" value="1" />
    <input name="paperformat" type="radio" class="paper-format" value="2" />
    <br />
    <label for="orientation">Portrait/Landscape</label>
    <input name="oriantation" type="radio" class="paper-format" value="0" checked="checked" />
    <input name="oriantation" type="radio" class="paper-format" value="1" />
    <br />
      <br/>
      <input type="submit" name="save" id="rl-save" value="Senden" />
      <br/>
  </form>
</div>
<div id="papercontainer">
  <div class="paper" >paper
    <div id="writing" class="writing"><span class="write">write</span>
      <div class="adr">address</div>
      <div class="adr2">address2</div>
      <div class="page2"></div>
      <div id="invoice" class="invoice">invoice</div>
      <div class="detail">
        <div id="example3">
          <div style="min-height: 50px; min-height:50px; height:auto !important;">
            <style type="text/css" media="screen"> 
                #placeholderSortable li { 
                    float: left; 
                } 
            </style>
            <ul id="placeholderSortable" style="list-style-position: inside; height: 30px; cursor: hand; cursor: pointer;">
              <li id='user_Jack'>Jack</li>
              <li id='user_John'>John</li>
              <li id='user_Marry'>Marry</li>
              <li id='user_Claire'>Claire</li>
              <li id='user_Daniel'>Daniel</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="../../ajax/jquery.form.js" type="text/javascript"></script>
<script src="../../ajax/rl_invoice3_template.js" type="text/javascript"></script>
<div id="extraDiv2"></div>
BEG;
#sleep(1);
