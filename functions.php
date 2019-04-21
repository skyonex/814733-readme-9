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

function dateDifference($timestamp1, $timestamp2) {
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
