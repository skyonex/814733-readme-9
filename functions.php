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
