<?php
if (!defined('ABSPATH')) die();

$cp_config = array(
'url_forum' => 'http://www.separatista.net/forum/',
'url_forum_new_topic' => 'http://www.separatista.net/forum/?new=1',
'url_forum_topics'=> 'http://www.separatista.net/forum/rss.php?topics=1',
'url_forum_posts' => 'http://www.separatista.net/forum/rss.php',
'url_web' => 'http://www.separatista.net/',
'url_web_posts' => 'http://www.separatista.net/feed',

'max_feed_items' => 5,
'view_excerpt' => true,
'excerpt_lenght' => 100,
'feed_timeout' => 10,
'cache_forum_items' => 7200,
'cache_web_items' => 86400,
);