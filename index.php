<?php

date_default_timezone_set('Europe/Moscow');

require_once 'config.php';
require_once 'helpers.php';
require_once 'functions.php';

$db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$db->set_charset(DB_CHARSET);

$is_auth = rand(0, 1);

$username = 'Борис'; // укажите здесь ваше имя

$sql = 'SELECT * FROM content_types ORDER BY id';
$result = $db->query($sql);

$content_types = $result->fetch_all(MYSQLI_ASSOC);

$sql = 'SELECT t1.id as pid, subject, content, username, quote_author, class_name, count(t2.from_id) as total_likes, avatar_url, link_url, img_url, video_url, created_ts 
FROM posts as t1 
LEFT join likes as t2 on t1.id=t2.post_id 
join users as t3 on t1.author_id=t3.id 
join content_types as t4 on t1.content_type=t4.id
group by t1.id
ORDER BY total_likes DESC';
$result = $db->query($sql);

$popular_posts = $result->fetch_all(MYSQLI_ASSOC);

$page_content = include_template('index.php', [
        'popular_posts' => $popular_posts,
        'content_types' => $content_types
    ]
);
$layout = include_template('layout.php', [
        'content' => $page_content,
        'title' => 'readme: популярное',
        'is_auth' => $is_auth,
        'username' => $username
    ]
);

print $layout;
