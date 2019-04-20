<?php

date_default_timezone_set('Europe/Moscow');

require_once 'helpers.php';
require_once 'functions.php';

$is_auth = rand(0, 1);

$username = 'Борис'; // укажите здесь ваше имя

$popular_posts = [
    [
        'subject' => 'Цитата',
        'type' => 'post-quote',
        'content' => 'Мы в жизни любим только раз, а после ищем лишь похожих',
        'author' => 'Лариса',
        'avatar' => 'userpic-larisa-small.jpg',
        'datetime' => generate_random_date(mt_rand(0,4))
    ],
    [
        'subject' => 'Игра пристолов',
        'type' => 'post-text',
        'content' => 'Не могу дождаться начала финального сезона своего любимого сериала!',
        'author' => 'Владик',
        'avatar' => 'userpic.jpg',
        'datetime' => generate_random_date(mt_rand(0,4))
    ],
    [
        'subject' => 'Наконец, обработал фотки!',
        'type' => 'post-photo',
        'content' => 'rock-medium.jpg',
        'author' => 'Виктор',
        'avatar' => 'userpic-mark.jpg',
        'datetime' => generate_random_date(mt_rand(0,4))
    ],
    [
        'subject' => 'Моя мечта',
        'type' => 'post-photo',
        'content' => 'coast-medium.jpg',
        'author' => 'Лариса',
        'avatar' => 'userpic-larisa-small.jpg',
        'datetime' => generate_random_date(mt_rand(0,4))
    ],
    [
        'subject' => 'Лучшие курсы',
        'type' => 'post-link',
        'content' => 'www.htmlacademy.ru',
        'author' => 'Владик',
        'avatar' => 'userpic.jpg',
        'datetime' => generate_random_date(mt_rand(0,4))
    ],
    [
        'subject' => 'Полезный пост про Байкал',
        'type' => 'post-text',
        'content' => 'Озеро Байкал – огромное древнее озеро в горах Сибири к северу от монгольской границы. Байкал считается самым глубоким озером в мире. Он окружен сетью пешеходных маршрутов, называемых Большой байкальской тропой. Деревня Листвянка, расположенная на западном берегу озера, – популярная отправная точка для летних экскурсий. Зимой здесь можно кататься на коньках и собачьих упряжках.',
        'author' => 'Лариса',
        'avatar' => 'userpic-larisa-small.jpg',
        'datetime' => generate_random_date(mt_rand(0,4))
    ],
];

$page_content = include_template('index.php', ['popular_posts' => $popular_posts]);
$layout = include_template('layout.php', [
        'content' => $page_content,
        'title' => 'readme: популярное',
        'is_auth' => $is_auth,
        'username' => $username
    ]
);

print $layout;
