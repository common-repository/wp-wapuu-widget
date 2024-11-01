<?php
if (!defined('ABSPATH') && !defined('WP_UNINSTALL_PLUGIN')) {exit();}
delete_option('widget_wapuuwidget');
delete_option('widget_wapoowidget'); // For older version
?>
