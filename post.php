<?php

date_default_timezone_set('Europe/Moscow');

require_once 'config.php';
require_once 'helpers.php';
require_once 'functions.php';

$db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$db->set_charset(DB_CHARSET);

$is_auth = rand(0, 1);

$username = 'Борис'; // укажите здесь ваше имя

$post_id = $_GET['id'] ?? 0;

$post = get_post_details($db, $post_id);

if (empty($post)) {
    http_response_code(404);
    exit();
}

$post_content = include_template('post-' . $post['class_name'] . '.php', ['post' => $post]);

$post_indicators = include_template('post-indicators.php', [
        'total_likes' => $post['total_likes'],
        'total_views' => $post['total_views'],
        'total_comments' => 0,
        'total_reposts' => 0
    ]
);

$post_comments = include_template('post-comments.php', []);

$post_author = include_template('post-author.php', [
        'author' => get_post_author_details($db, $post['author_id'])
    ]
);

$content = include_template('post-details.php', [
        'post_content' => $post_content,
        'post_subject' => $post['subject'],
        'post_indicators' => $post_indicators,
        'post_comments' => $post_comments,
        'post_author' => $post_author
    ]
);

$layout = include_template('layout.php', [
        'content' => $content,
        'title' => $post['subject'],
        'is_auth' => $is_auth,
        'username' => $username
    ]
);

print $layout;
