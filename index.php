<?php

date_default_timezone_set('Europe/Moscow');

require_once 'config.php';
require_once 'helpers.php';
require_once 'functions.php';

$db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$db->set_charset(DB_CHARSET);

$is_auth = rand(0, 1);

$username = 'Борис'; // укажите здесь ваше имя

$sorting_items = [
    'popular' => 'Популярность',
    'likes' => 'Лайки',
    'date' => 'Дата'
];

$sort_by = (isset($_GET['sort']) && array_key_exists($_GET['sort'], $sorting_items)) ? $_GET['sort'] : 'popular';

$sort_order = (isset($_GET['order']) && in_array($_GET['order'], ['asc', 'desc'])) ? $_GET['order'] : 'desc';

$content_types = get_content_types($db);
$current_content_type = (isset($_GET['ct']) && array_key_exists($_GET['ct'], $content_types)) ? $_GET['ct'] : 0;

$popular_posts = get_popular_posts_list($db, $current_content_type, $sort_by, $sort_order);

$page_content = include_template('index.php', [
        'popular_posts' => $popular_posts,
        'content_types' => $content_types,
        'current_content_type' => $current_content_type,
        'sorting_items' => $sorting_items,
        'sort_by' => $sort_by,
        'sort_order' => $sort_order
    ]
);

$layout = include_template('layout.php', [
        'content' => $page_content,
        'title' => 'популярное',
        'is_auth' => $is_auth,
        'username' => $username
    ]
);

print $layout;
