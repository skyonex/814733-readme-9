<div class="post-details__user user">
    <div class="post-details__user-info user__info">
        <div class="post-details__avatar user__avatar">
            <a class="post-details__avatar-link user__avatar-link" href="#">
                <img class="post-details__picture user__picture" src="img/<?= esc($author['avatar_url']); ?>" alt="Аватар пользователя">
            </a>
        </div>
        <div class="post-details__name-wrapper user__name-wrapper">
            <a class="post-details__name user__name" href="#">
                <span><?= esc($author['username']); ?></span>
            </a>
            <time class="post-details__time user__time" datetime="<?= $author['reg_ts']; ?>"><?= date_difference(strtotime($author['reg_ts']), time()); ?> на сайте</time>
        </div>
    </div>
    <div class="post-details__rating user__rating">
        <p class="post-details__rating-item user__rating-item user__rating-item--subscribers">
            <span class="post-details__rating-amount user__rating-amount"><?= $author['total_subscribers']; ?></span>
            <span class="post-details__rating-text user__rating-text"><?= get_noun_plural_form($author['total_subscribers'], 'подписчик', 'подписчика', 'подписчиков'); ?></span>
        </p>
        <p class="post-details__rating-item user__rating-item user__rating-item--publications">
            <span class="post-details__rating-amount user__rating-amount"><?= $author['total_posts']; ?></span>
            <span class="post-details__rating-text user__rating-text"><?= get_noun_plural_form($author['total_posts'], 'публикация', 'публикации', 'публикаций'); ?></span>
        </p>
    </div>
    <div class="post-details__user-buttons user__buttons">
        <button class="user__button user__button--subscription button button--main" type="button">Подписаться</button>
        <a class="user__button user__button--writing button button--green" href="#">Сообщение</a>
    </div>
</div>
