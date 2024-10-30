<?php
/*
Plugin Name: Česká podpora WordPressu
Plugin URI: http://wp-blog.cz
Description: Plugin České podpory WordPressu. Informace, novinky, rady, tipy a triky, vše přehledně na nástěnce v administraci vašeho webu
Version: 2.0.0
Author: Lukenzi
Author URI: http://wp-blog.cz/
License: GPLv3
*/

if (!defined('ABSPATH')) die();

if(!is_admin()){
    return;
}else{
    $cp_plugin_url = plugin_dir_url(__FILE__);

    require dirname(__FILE__).'/plugin-config/config.php';
    require dirname(__FILE__).'/plugin-library/feed.php';
    require dirname(__FILE__).'/plugin-library/widget.php';

    CP_RunPlugin();
}