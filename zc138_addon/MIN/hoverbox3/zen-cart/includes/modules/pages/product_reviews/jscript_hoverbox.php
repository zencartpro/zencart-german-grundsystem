<?php if(HOVERBOX_ENABLED == 'true'){?>
<script type="text/javascript" src="<?php echo $template->get_template_dir('/ic_effects.js',DIR_WS_TEMPLATE, $current_page_base,'jscript'). '/ic_effects.js'; ?>"></script>
<?php require_once($template->get_template_dir('/ic_hoverbox_config.php',DIR_WS_TEMPLATE, $current_page_base,'jscript'). '/ic_hoverbox_config.php');?>
<script type="text/javascript" src="<?php echo $template->get_template_dir('/ic_hoverbox3.js',DIR_WS_TEMPLATE, $current_page_base,'jscript'). '/ic_hoverbox3.js'; ?>"></script>
<?php }?>