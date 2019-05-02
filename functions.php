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

function date_difference($timestamp1, $timestamp2) {
    $minuteSec = 60;
    $hourSec = 3600;
    $daySec = 3600 * 24;
    $weekSec = 3600 * 24 * 7;
    $monthsSec = $weekSec * 4;

    if ($timestamp2 >= $timestamp1) {
        $diff_seconds = $timestamp2 - $timestamp1;
    } else {
        $diff_seconds = $timestamp1 - $timestamp2;
    }

    if ($diff_seconds < $hourSec) {
        $minutes = floor($diff_seconds / $minuteSec);

        return $minutes . ' ' . get_noun_plural_form ($minutes, 'минута', 'минуты', 'минут') . ' назад';
    } elseif ($diff_seconds >= $hourSec && $diff_seconds < $daySec) {
        $hours = floor($diff_seconds / $hourSec);

        return $hours . ' ' . get_noun_plural_form ($hours, 'час', 'часа', 'часов') . ' назад';
    } elseif ($diff_seconds >= $daySec && $diff_seconds < $weekSec) {
        $days = floor($diff_seconds / $daySec);

        return $days . ' ' . get_noun_plural_form ($days, 'день', 'дня', 'дней') . ' назад';
    } elseif ($diff_seconds >= $weekSec && $diff_seconds < $weekSec * 5) {
        $weeks = floor($diff_seconds / $weekSec);

        return $weeks . ' ' . get_noun_plural_form ($weeks, 'неделя', 'недели', 'недель') . ' назад';
    } elseif ($diff_seconds >= $weekSec * 5) {
        $months = floor($diff_seconds / $monthsSec);

        return $months . ' ' . get_noun_plural_form ($months, 'месяц', 'месяца', 'месяцев') . ' назад';
    }
}

function get_content_types($db) {
    $content_types = [];

    $sql = 'SELECT * FROM content_types ORDER BY id';
    $result = $db->query($sql);

    while ($row = $result->fetch_assoc()) {
        $content_types[$row['id']] = $row;
    }

    return $content_types;
}

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
