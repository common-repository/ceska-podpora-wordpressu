<?php
if (!defined('ABSPATH')) die();

function CP_ViewWidget(){
    global $cp_config, $cp_plugin_url;

    echo '<div style="background: transparent url('.$cp_plugin_url.'/plugin-img/wplogo.png) no-repeat top right;">';
    if(!defined('CP_DISABLE_FORUM_TOPICS')):
        echo '<h3 style="background: none!important;"><img width="16" height="16" alt="" src="'.$cp_plugin_url.'/plugin-img/wordpress.ico" />&nbsp;Fórum - Nejnovější témata</h3>';
        CP_ViewForumTopics();
        echo '<p style="clear:both;">&nbsp;</p>';
    endif;

    if(!defined('CP_DISABLE_FORUM_POSTS')):
        echo '<h3 style="background: none!important;"><img width="16" height="16" alt="" src="'.$cp_plugin_url.'/plugin-img/wordpress.ico" />&nbsp;Fórum - Nejnovější příspěvky</h3>';
        CP_ViewForumPosts();
        echo '<p style="clear:both;">&nbsp;</p>';
    endif;

    if(!defined('CP_DISABLE_WEB_POSTS')):
        echo '<h3 style="background: none!important;"><img width="16" height="16" alt="" src="'.$cp_plugin_url.'/plugin-img/separatista.ico" />&nbsp;Separatista.net - Nejnovější články</h3>';
        CP_ViewWebPosts();
        echo '<p style="clear:both;">&nbsp;</p>';
    endif;

        echo '<span style="font-size: 80%!important;background-color: #E1E1E1;border-radius: 5px;-moz-border-radius:5px;-webkit-border-radius:5px;padding:2px 10px 2px 10px;display:block;">Nevíte si s něčím rady?&nbsp;&nbsp;<a href="'.$cp_config['url_forum_new_topic'].'" target="_blank" title="Požádejte o pomoc, rádi vám poradíme...">Požádat o pomoc s WordPressem</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="'.$cp_config['url_forum'].'" target="_blank" title="Navštívit fórum České podpory pro WordPress">Navštívit fórum České podpory</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="index.php?cp_update=ok" title="Aktualizovat widget" style="color:gray;">Aktualizovat</a></span>';
    echo '</div>';
}

function CP_CreateWidget(){
    global $cp_plugin_url;

    wp_add_dashboard_widget('widget_ceske_podpory', '<img src="'.$cp_plugin_url.'/plugin-img/czech.png" width="24" height="14" border="0" alt="czech" /> Česká podpora WordPressu', 'CP_ViewWidget');

}

function CP_RunPlugin(){
    add_action('wp_dashboard_setup', 'CP_CreateWidget');
}