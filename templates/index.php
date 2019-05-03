<section class="page__main page__main--popular">
    <div class="container">
        <h1 class="page__title page__title--popular">Популярное</h1>
    </div>
    <div class="popular container">
        <div class="popular__filters-wrapper">
            <div class="popular__sorting sorting">
                <b class="popular__sorting-caption sorting__caption">Сортировка:</b>
                <ul class="popular__sorting-list sorting__list">
                    <?php foreach ($sorting_items as $sorting_key => $sorting_title): ?>
                        <li class="sorting__item<?php if ($sorting_key == 'popular'): ?> sorting__item--popular<?php endif; ?>">
                            <?php if ($sorting_key == $sort_by): ?>
                            <a class="sorting__link sorting__link--active<?php if($sort_order == 'asc'): ?> sorting__link--reverse<?php endif; ?>" href="/?sort=<?= $sorting_key; ?>&order=<?= ($sort_order == 'desc') ? 'asc' : 'desc';?>&ct=<?= $current_content_type; ?>">
                                <?php else: ?>
                                <a class="sorting__link" href="/?sort=<?= $sorting_key; ?>&ct=<?= $current_content_type; ?>">
                                    <?php endif; ?>
                                    <span><?= $sorting_title; ?></span>
                                    <svg class="sorting__icon" width="10" height="12">
                                        <use xlink:href="#icon-sort"></use>
                                    </svg>
                                </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="popular__filters filters">
                <b class="popular__filters-caption filters__caption">Тип контента:</b>
                <ul class="popular__filters-list filters__list">
                    <li class="popular__filters-item popular__filters-item--all filters__item filters__item--all">
                        <a class="filters__button filters__button--ellipse filters__button--all<?php if ($current_content_type == 0): ?> filters__button--active<?php endif; ?>" href="/">
                            <span>Все</span>
                        </a>
                    </li>
                    <?php foreach ($content_types as $content_type): ?>
                        <li class="popular__filters-item filters__item">
                            <a class="filters__button filters__button--<?= $content_type['class_name']; ?> button<?php if ($current_content_type == $content_type['id']): ?> filters__button--active<?php endif; ?>" href="/?ct=<?= $content_type['id']; ?>">
                                <span class="visually-hidden"><?= $content_type['title']; ?></span>
                                <svg class="filters__icon" width="22" height="18">
                                    <use xlink:href="#icon-filter-<?= $content_type['class_name']; ?>"></use>
                                </svg>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <div class="popular__posts">
            <?php foreach ($popular_posts as $post): ?>
                <article class="popular__post post post-<?= $post['class_name']; ?>">
                    <header class="post__header">
                        <h2><a href="/post.php?id=<?= $post['pid']; ?>"><?= esc($post['subject']); ?></a></h2>
                    </header>
                    <div class="post__main">
                        <?php if ($post['class_name'] == 'quote'): ?>
                            <blockquote>
                                <p>
                                    <?= esc($post['content']); ?>
                                </p>
                                <cite><?= esc($post['quote_author']); ?></cite>
                            </blockquote>
                        <?php elseif ($post['class_name'] == 'video'): ?>
                            <div class="post-video__block">
                                <div class="post-video__preview">
                                    <img src="img/coast-medium.jpg" alt="Превью к видео" width="360" height="188">
                                </div>
                                <div class="post-video__control">
                                    <button class="post-video__play post-video__play--paused button button--video" type="button"><span class="visually-hidden">Запустить видео</span></button>
                                    <div class="post-video__scale-wrapper">
                                        <div class="post-video__scale">
                                            <div class="post-video__bar">
                                                <div class="post-video__toggle"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="post-video__fullscreen post-video__fullscreen--inactive button button--video" type="button"><span class="visually-hidden">Полноэкранный режим</span></button>
                                </div>
                                <button class="post-video__play-big button" type="button">
                                    <svg class="post-video__play-big-icon" width="14" height="14">
                                        <use xlink:href="#icon-video-play-big"></use>
                                    </svg>
                                    <span class="visually-hidden">Запустить проигрыватель</span>
                                </button>
                            </div>
                        <?php elseif ($post['class_name'] == 'link'): ?>
                            <div class="post-link__wrapper">
                                <a class="post-link__external" href="http://<?= esc($post['link_url']); ?>" title="Перейти по ссылке">
                                    <div class="post-link__info-wrapper">
                                        <div class="post-link__icon-wrapper">
                                            <img src="img/logo-vita.jpg" alt="Иконка">
                                        </div>
                                        <div class="post-link__info">
                                            <h3><?= esc($post['subject']); ?></h3>
                                            <p><?= esc($post['link_url']); ?></p>
                                        </div>
                                    </div>
                                    <span><?= $post['link_url']; ?></span>
                                </a>
                            </div>
                        <?php elseif ($post['class_name'] == 'photo'): ?>
                            <div class="post-photo__image-wrapper">
                                <img src="img/<?= esc($post['img_url']); ?>" alt="Фото от пользователя" width="360" height="240">
                            </div>
                        <?php elseif ($post['class_name'] == 'text'): ?>
                            <?= truncate_text($post['content']); ?>
                        <?php endif; ?>
                    </div>
                    <footer class="post__footer">
                        <div class="post__author">
                            <a class="post__author-link" href="#" title="Автор">
                                <div class="post__avatar-wrapper">
                                    <img class="post__author-avatar" src="img/<?= $post['avatar_url']; ?>" alt="Аватар пользователя">
                                </div>
                                <div class="post__info">
                                    <b class="post__author-name"><?= esc($post['username']); ?></b>
                                    <time class="post__time" datetime="<?= $post['created_ts']; ?>" title="<?= date("d.m.Y H:i", strtotime($post['created_ts'])); ?>"><?= date_difference(strtotime($post['created_ts']), time()) . ' назад'; ?></time>
                                </div>
                            </a>
                        </div>
                        <div class="post__indicators">
                            <div class="post__buttons">
                                <a class="post__indicator post__indicator--likes button" href="#" title="Лайк">
                                    <svg class="post__indicator-icon" width="20" height="17">
                                        <use xlink:href="#icon-heart"></use>
                                    </svg>
                                    <svg class="post__indicator-icon post__indicator-icon--like-active" width="20" height="17">
                                        <use xlink:href="#icon-heart-active"></use>
                                    </svg>
                                    <span><?=  intval($post['total_likes']); ?></span>
                                    <span class="visually-hidden">количество лайков</span>
                                </a>
                                <a class="post__indicator post__indicator--comments button" href="#" title="Комментарии">
                                    <svg class="post__indicator-icon" width="19" height="17">
                                        <use xlink:href="#icon-comment"></use>
                                    </svg>
                                    <span>0</span>
                                    <span class="visually-hidden">количество комментариев</span>
                                </a>
                            </div>
                        </div>
                    </footer>
                </article>
            <?php endforeach; ?>
        </div>
        <!--
        <div class="popular__page-links">
            <a class="popular__page-link popular__page-link--prev button button--gray" href="#">Предыдущая страница</a>
            <a class="popular__page-link popular__page-link--next button button--gray" href="#">Следующая страница</a>
        </div>
        -->
    </div>
</section>