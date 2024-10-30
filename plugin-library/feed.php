<?php
if (!defined('ABSPATH')) die();

if(file_exists(ABSPATH.WPINC.'/feed.php')){
    require_once ABSPATH.WPINC.'/feed.php';
}else{
    die('Doslo k chybe v pluginu <code>ceska-podpora-wordpressu</code>! Nebyl nalezen dulezity systemovy soubor.');
}

function CP_ViewForumPosts(){
    global $cp_config;

    $rss = fetch_feed($cp_config['url_forum_posts']);

    if (!is_wp_error($rss)){
        if(!defined('CP_MAX_FEED_ITEMS')){
            $maxitems = $rss->get_item_quantity($cp_config['max_feed_items']);
        }else{
            $maxitems = $rss->get_item_quantity(CP_MAX_FEED_ITEMS);
        }
        $rss->set_timeout($cp_config['feed_timeout']);
        if(isset($_GET['cp_update']) && $_GET['cp_update'] == 'ok'){
            $rss->set_cache_duration(0);
        }else{
            if(!defined('CP_CACHE_FORUM')){
                $rss->set_cache_duration($cp_config['cache_forum_items']);
            }else{
                $rss->set_cache_duration(CP_CACHE_FORUM);
            }
        }
        $rss->init();
        $rss->handle_content_type();
        $rss_items = $rss->get_items(0, $maxitems);


        echo '<ul style="margin-top: 5px;">';
        if($maxitems == 0){
            echo '<li style="margin-left: 15px;color: red;">Nebyly nalezeny žádné příspěvky.</li>';
        }else{
            foreach($rss_items as $item){
                echo '<li style="margin-left: 15px;">';

                $feed_title = trim($item->get_title());
                $feed_title = str_replace(' on ', ' v ', $feed_title);

                echo '<a href="'.$item->get_permalink().'" title="Přidáno '.$item->get_date('d.m Y v G:i').'" target="_blank">'.$feed_title.'</a>';

                if($cp_config['view_excerpt']){
                    if(!defined('CP_DISABLE_EXCERPT')):
                    $feed_content = strip_tags(trim($item->get_content()));

                    if(function_exists('mb_substr')){
                        $feed_content = mb_substr($feed_content, 0, $cp_config['excerpt_lenght'], 'UTF-8');
                    }else{
                        $feed_content = substr($feed_content, 0, $cp_config['excerpt_lenght']);
                    }
                    echo '<br /><span style="font-size: 90%; color: gray;padding-top: -10px;">'.$feed_content.'...</span>';
                    unset($feed_content);
                    endif;
                }
                unset($feed_title);
                unset($item);
                echo '</li>';
            }
        }
        echo '</ul>';
    }else{
        echo'<ul><li><p style="color:red;">Došlo k chybě při získávání dat z fóra!</p></li></ul>';
    }
    unset($rss);
    unset($maxitems);
    unset($rss_items);

}

function CP_ViewForumTopics(){
        global $cp_config;

        $rss = fetch_feed($cp_config['url_forum_topics']);

        if (!is_wp_error($rss)){
            if(!defined('CP_MAX_FEED_ITEMS')){
                $maxitems = $rss->get_item_quantity($cp_config['max_feed_items']);
            }else{
                $maxitems = $rss->get_item_quantity(CP_MAX_FEED_ITEMS);
            }
            $rss->set_timeout($cp_config['feed_timeout']);
            if(!defined('CP_CACHE_FORUM')){
                $rss->set_cache_duration($cp_config['cache_forum_items']);
            }else{
                $rss->set_cache_duration(CP_CACHE_FORUM);
            }
            $rss->init();
            $rss->handle_content_type();
            $rss_items = $rss->get_items(0, $maxitems);

            echo '<ul style="margin-top: 5px;">';
            if($maxitems == 0){
                echo '<li style="margin-left: 15px;color: red;">Na fóru nebyla nalezena žádná témata.</li>';
            }else{
                foreach($rss_items as $item){
                    echo '<li style="margin-left: 15px;">';
                    $feed_title = $item->get_title();
                    $feed_title = str_replace(' on ', ' v ', $feed_title);
                    $feed_title_arr = '';
                    $feed_title_arr = explode(' v ', $feed_title);
                    $feed_title = trim(str_replace('&quot;', '', $feed_title_arr[1]));
                    echo '<a href="'.$item->get_permalink().'" title="Přidáno '.$item->get_date('d.m Y v G:i').'" target="_blank">'.$feed_title.'</a>';
                    echo '</li>';
                    unset($item);
                    unset($feed_title);
                    unset($feed_title_arr);
                }
            }
            echo '</ul>';
        }else{
            echo'<ul><li><p style="color:red;">Došlo k chybě při získávání dat z fóra!</p></li></ul>';
        }
        unset($rss);
        unset($maxitems);
        unset($rss_items);

}

function CP_ViewWebPosts(){
    global $cp_config;

    $rss = fetch_feed($cp_config['url_web_posts']);

    if (!is_wp_error($rss)){
        if(!defined('CP_MAX_FEED_ITEMS')){
            $maxitems = $rss->get_item_quantity($cp_config['max_feed_items']);
        }else{
            $maxitems = $rss->get_item_quantity(CP_MAX_FEED_ITEMS);
        }
        $rss->set_timeout($cp_config['feed_timeout']);
        if(!defined('CP_CACHE_WEB')){
            $rss->set_cache_duration($cp_config['cache_web_items']);
        }else{
            $rss->set_cache_duration(CP_CACHE_WEB);
        }
        $rss->init();
        $rss->handle_content_type();
        $rss_items = $rss->get_items(0, $maxitems);

        echo '<ul style="margin-top: 5px;">';
        if($maxitems == 0){
            echo '<li style="margin-left: 15px;color: red;">Na webu nebyly nalezeny žádné články.</li>';
        }else{
            foreach($rss_items as $item){
                echo '<li style="margin-left: 15px;">';
                $feed_title = $item->get_title();
                $feed_title = strip_tags(trim($feed_title));
                echo '<a href="'.$item->get_permalink().'" title="Publikováno '.$item->get_date('d.m Y v G:i').'" target="_blank">'.$feed_title.'</a>';
                echo '</li>';
                unset($item);
                unset($feed_title);
            }
        }
        echo'</ul>';
    }else{
        echo'<ul><li><p style="color:red;">Došlo k chybě při získávání dat z webu!</p></li></ul>';
    }
    unset($rss);
    unset($maxitems);
    unset($rss_items);
}