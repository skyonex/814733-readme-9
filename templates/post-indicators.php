<div class="post__indicators">
    <div class="post__buttons">
        <a class="post__indicator post__indicator--likes button" href="#" title="Лайк">
            <svg class="post__indicator-icon" width="20" height="17">
                <use xlink:href="#icon-heart"></use>
            </svg>
            <svg class="post__indicator-icon post__indicator-icon--like-active" width="20" height="17">
                <use xlink:href="#icon-heart-active"></use>
            </svg>
            <span><?= $total_likes; ?></span>
            <span class="visually-hidden">количество лайков</span>
        </a>
        <a class="post__indicator post__indicator--comments button" href="#" title="Комментарии">
            <svg class="post__indicator-icon" width="19" height="17">
                <use xlink:href="#icon-comment"></use>
            </svg>
            <span><?= $total_comments; ?></span>
            <span class="visually-hidden">количество комментариев</span>
        </a>
        <a class="post__indicator post__indicator--repost button" href="#" title="Репост">
            <svg class="post__indicator-icon" width="19" height="17">
                <use xlink:href="#icon-repost"></use>
            </svg>
            <span><?= $total_reposts; ?></span>
            <span class="visually-hidden">количество репостов</span>
        </a>
    </div>
    <span class="post__view"><?= $total_views; ?> <?= get_noun_plural_form($total_views, 'просмотр', 'просмотра', 'просмотров'); ?></span>
</div>
