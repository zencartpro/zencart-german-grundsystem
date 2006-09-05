<?php /* Smarty version 2.6.13, created on 2006-07-19 10:50:58
         compiled from configuration.tpl.html */ ?>
<!-- configuration //-->
<hr>smarty example of config-menu<hr>
<li class="submenu"> 
<a target="_self" href="<?php echo $this->_tpl_vars['cfg_header']['link']; ?>
"><?php echo $this->_tpl_vars['cfg_header']['text']; ?>
</a><ul>
<ul>
<?php $_from = $this->_tpl_vars['cfg']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cid'] => $this->_tpl_vars['con']):
?>
<li><a href="<?php echo $this->_tpl_vars['con']['link']; ?>
"><?php echo $this->_tpl_vars['con']['text']; ?>
</a></li>
<?php endforeach; endif; unset($_from); ?>
</ul>
</li>
<!-- configuration_eof //-->
 