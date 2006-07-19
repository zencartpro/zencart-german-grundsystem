<?php /* Smarty version 2.6.13, created on 2006-07-19 10:50:58
         compiled from rl_language.tpl.html */ ?>
rl_language version: <?php echo $this->_tpl_vars['version']; ?>
//<?php echo $this->_tpl_vars['languages_id']; ?>
//<?php echo $this->_tpl_vars['SOAPSERVER']; ?>
//tC:<?php echo $this->_tpl_vars['transCount']; ?>

<div id="rl-language-wrap1"> 
  <div id="rl-language-form1"><form action="" method="get" enctype="application/x-www-form-urlencoded" name="rl-language" target="_self">
	<strong>last changes: <?php echo $this->_tpl_vars['lm']; ?>
</strong>
    <input type="submit" name="Submit" value="update_languages">
    <?php if ($this->_tpl_vars['name'] == 'Fred'): ?>
    <input name="update[]" type="checkbox" id="update[]" value="1"> 
    update all
    <select name="update[]" id="update[]">
      <option value="CORE">CORE</option>
      <option value="LANG">LANG</option>
      <option value="ALL">ALL</option>
    </select>
    <?php endif; ?>
  </form> </div>
<div id="rl-language-result"><table>
  <tr>
    <th scope="col"><span>KEY</span></th>
    <th scope="col">TITLE</th>
    <th scope="col">DESCRIPTION</th>
    <th scope="col">&nbsp;</th>
    <th scope="col">&nbsp;</th>
  </tr>
<?php $_from = $this->_tpl_vars['checkedA']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cid'] => $this->_tpl_vars['checked']):
?>     
  <tr class="p20">
    <td class="p20b"><span class="rl-language-key" id="id-<?php echo $this->_tpl_vars['checked']['new']['configuration_id']; ?>
"><?php echo $this->_tpl_vars['checked']['ori']['configuration_key']; ?>
</span>
    <td><span class="Stil1"><?php echo $this->_tpl_vars['checked']['ori']['configuration_title']; ?>
</span>
    <td><span class="Stil1"><?php echo $this->_tpl_vars['checked']['ori']['configuration_description']; ?>
</span>
    <td><span class="Stil1">ori</span>
    <td>
  </tr>
  <tr class="p21" id="tab-<?php echo $this->_tpl_vars['checked']['ori']['configuration_key']; ?>
">  
    <td><span class="rl-language-pad">&nbsp;<?php echo $this->_tpl_vars['checked']['new']['configuration_id']; ?>
</span></td>
    <td><span class="Stil2"><?php echo $this->_tpl_vars['checked']['new']['configuration_title']; ?>
</span></td>
    <td><span class="Stil2"><?php echo $this->_tpl_vars['checked']['new']['configuration_description']; ?>
</span></td>
    <td>new</td>
    <td><div id="but-<?php echo $this->_tpl_vars['checked']['new']['configuration_id']; ?>
" align="right"><button id="butt-<?php echo $this->_tpl_vars['checked']['new']['configuration_id']; ?>
" onclick="xajax_makeTrans('<?php echo $this->_tpl_vars['checked']['ori']['configuration_key']; ?>
', '<?php echo $this->_tpl_vars['checked']['new']['configuration_key']; ?>
', <?php echo $this->_tpl_vars['languages_id']; ?>
, <?php echo $this->_tpl_vars['checked']['new']['configuration_id']; ?>
);">GetTrans</button></div></td>
  </tr>
<?php endforeach; endif; unset($_from); ?>
</table>
</div> 
</div>