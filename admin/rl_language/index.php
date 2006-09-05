<?php
define('HTML_PARAMS', 'dir="ltr" lang="de"');
define('CHARSET', 'UTF-8');
define('TITLE', 'rl_language');

require('/home/html/kzen/zc130/smarty/Smarty.class.php');
$smarty = new Smarty();

$smarty->template_dir = '/home/html/kzen/zc130/smarty/templates';
$smarty->compile_dir = '/home/html/kzen/zc130/smarty/templates_c';
$smarty->cache_dir = '/home/html/kzen/zc130/smarty/cache';
$smarty->config_dir = '/home/html/kzen/zc130/smarty/configs';

$smarty->assign('path', '../');
$smarty->assign('name', 'Ned');
$smarty->display('index.tpl.html');

?>
