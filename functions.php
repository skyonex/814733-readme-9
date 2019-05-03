<?php

/**
 * Функция обрезает текстовое содержимое,
 * если оно превышает заданное число символов
 *
 * @param string $text
 * @param int $length
 * @return string
 */
function truncate_text($text, $length = 300) {
    $text = esc($text);

    if (mb_strlen($text) > $length) {
        $max_position = 0;
        $words = [];

        foreach (explode(" ", $text) as $word) {
            if (mb_strlen($word) + $max_position > $length) {
                break;
            }

            $words[] = $word;
            $max_position += mb_strlen($word) + 1;
        }

        return '<p>' . implode(" ", $words) . '...</p>
        <div class="post-text__more-link-wrapper"><a class="post-text__more-link" href="#">Читать далее</a></div>';
    }

    return '<p>' . $text . '</p>';
}

/**
 * Преобразует или удаляет HTML-сущности
 *
 * @param string $text
 * @param bool $remove_tags
 * @return string
 */
function esc($text, $remove_tags = false) {
    if ($remove_tags) {
        return strip_tags($text);
    }

    return htmlspecialchars($text);
}

/**
 * Получить разницу во времени
 * @param int $timestamp1
 * @param int $timestamp2
 * @return string
 */
function date_difference($timestamp1, $timestamp2) {
    $minuteSec = 60;
    $hourSec = 3600;
    $daySec = 3600 * 24;
    $weekSec = 3600 * 24 * 7;
    $monthsSec = $weekSec * 4;
    $yearsSec = $daySec * 365;

    if ($timestamp2 >= $timestamp1) {
        $diff_seconds = $timestamp2 - $timestamp1;
    } else {
        $diff_seconds = $timestamp1 - $timestamp2;
    }

    if ($diff_seconds < $hourSec) {
        $minutes = floor($diff_seconds / $minuteSec);

        return $minutes . ' ' . get_noun_plural_form ($minutes, 'минута', 'минуты', 'минут');
    } elseif ($diff_seconds >= $hourSec && $diff_seconds < $daySec) {
        $hours = floor($diff_seconds / $hourSec);

        return $hours . ' ' . get_noun_plural_form ($hours, 'час', 'часа', 'часов');
    } elseif ($diff_seconds >= $daySec && $diff_seconds < $weekSec) {
        $days = floor($diff_seconds / $daySec);

        return $days . ' ' . get_noun_plural_form ($days, 'день', 'дня', 'дней');
    } elseif ($diff_seconds >= $weekSec && $diff_seconds < $weekSec * 5) {
        $weeks = floor($diff_seconds / $weekSec);

        return $weeks . ' ' . get_noun_plural_form ($weeks, 'неделя', 'недели', 'недель');
    } elseif ($diff_seconds >= $weekSec * 5) {
        $months = floor($diff_seconds / $monthsSec);

        return $months . ' ' . get_noun_plural_form ($months, 'месяц', 'месяца', 'месяцев');
    } elseif ($diff_seconds >= $monthsSec * 13) {
        $years = floor($diff_seconds / $yearsSec);

        return $years . ' ' . get_noun_plural_form ($years, 'год', 'года', 'лет');
    }
}

/**
 * Получить список типов контента
 *
 * @param $db
 * @return array
 */
function get_content_types($db) {
    $content_types = [];

    $sql = 'SELECT * FROM content_types ORDER BY id';
    $result = $db->query($sql);

    while ($row = $result->fetch_assoc()) {
        $content_types[$row['id']] = $row;
    }

    return $content_types;
}

/**
 * Получить список популярных постов
 *
 * @param $db
 * @param int $content_type
 * @param string $sort_by
 * @param string $sort_order
 * @return array
 */
function get_popular_posts_list($db, $content_type = 0, $sort_by = 'popular', $sort_order = 'desc') {
    $sql = 'SELECT t1.id as pid, subject, content, username, quote_author, class_name, count(t2.from_id) as total_likes, avatar_url, link_url, img_url, video_url, created_ts 
FROM posts as t1 
LEFT join likes as t2 on t1.id=t2.post_id 
join users as t3 on t1.author_id=t3.id 
join content_types as t4 on t1.content_type=t4.id ';

    if ($content_type > 0) {
        $sql .= 'where t1.content_type=' . $content_type;
    }

    $sql .= ' group by t1.id ORDER BY ';

    switch ($sort_by) {
        case 'likes':
            $sql .= 'total_likes ';
            break;

        case 'date':
            $sql .= 'created_ts ';
            break;

        default:
            $sql .= 'total_views ';
            break;
    }

    $sql .= ' ' . $sort_order;
    $result = $db->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    return [];
}

/**
 * Получить содержимое поста
 *
 * @param $db
 * @param $post_id
 * @return array|null
 */
function get_post_details($db, $post_id) {
    $sql = 'SELECT t1.id as pid, subject, content, t1.author_id as author_id, username, quote_author, class_name, count(t2.from_id) as total_likes, total_views, avatar_url, link_url, img_url, video_url, created_ts 
FROM posts as t1 
LEFT join likes as t2 on t1.id=t2.post_id 
join users as t3 on t1.author_id=t3.id 
join content_types as t4 on t1.content_type=t4.id
where t1.id = ?
group by t1.id';

    $stmt = db_get_prepare_stmt($db, $sql, [$post_id]);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    return $result->fetch_assoc();
}

/**
 * Получить данные по автору
 *
 * @param $db
 * @param $author_id
 * @return mixed
 */
function get_post_author_details($db, $author_id) {
    $sql = 'select t1.id, username, avatar_url, reg_ts, count(t2.subscriber_id) as total_subscribers,
    (select count(*) from posts where author_id = ' . $author_id . ') as total_posts
    from users as t1 
    left join subscriptions as t2 on t1.id = t2.author_id 
    where t1.id = ' . $author_id . '
    group by t2.author_id';
    $result = $db->query($sql);

    return $result->fetch_assoc();
}
