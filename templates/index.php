<div class="container">
    <h1 class="page__title page__title--popular">Популярное</h1>
</div>
<div class="popular container">
    <div class="popular__filters-wrapper">
        <div class="popular__sorting sorting">
            <b class="popular__sorting-caption sorting__caption">Сортировка:</b>
            <ul class="popular__sorting-list sorting__list">
                <li class="sorting__item sorting__item--popular">
                    <a class="sorting__link sorting__link--active" href="#">
                        <span>Популярность</span>
                        <svg class="sorting__icon" width="10" height="12">
                            <use xlink:href="#icon-sort"></use>
                        </svg>
                    </a>
                </li>
                <li class="sorting__item">
                    <a class="sorting__link" href="#">
                        <span>Лайки</span>
                        <svg class="sorting__icon" width="10" height="12">
                            <use xlink:href="#icon-sort"></use>
                        </svg>
                    </a>
                </li>
                <li class="sorting__item">
                    <a class="sorting__link" href="#">
                        <span>Дата</span>
                        <svg class="sorting__icon" width="10" height="12">
                            <use xlink:href="#icon-sort"></use>
                        </svg>
                    </a>
                </li>
            </ul>
        </div>
        <div class="popular__filters filters">
            <b class="popular__filters-caption filters__caption">Тип контента:</b>
            <ul class="popular__filters-list filters__list">
                <li class="popular__filters-item popular__filters-item--all filters__item filters__item--all">
                    <a class="filters__button filters__button--ellipse filters__button--all filters__button--active" href="#">
                        <span>Все</span>
                    </a>
                </li>
                <li class="popular__filters-item filters__item">
                    <a class="filters__button filters__button--photo button" href="#">
                        <span class="visually-hidden">Фото</span>
                        <svg class="filters__icon" width="22" height="18">
                            <use xlink:href="#icon-filter-photo"></use>
                        </svg>
                    </a>
                </li>
                <li class="popular__filters-item filters__item">
                    <a class="filters__button filters__button--video button" href="#">
                        <span class="visually-hidden">Видео</span>
                        <svg class="filters__icon" width="24" height="16">
                            <use xlink:href="#icon-filter-video"></use>
                        </svg>
                    </a>
                </li>
                <li class="popular__filters-item filters__item">
                    <a class="filters__button filters__button--text button" href="#">
                        <span class="visually-hidden">Текст</span>
                        <svg class="filters__icon" width="20" height="21">
                            <use xlink:href="#icon-filter-text"></use>
                        </svg>
                    </a>
                </li>
                <li class="popular__filters-item filters__item">
                    <a class="filters__button filters__button--quote button" href="#">
                        <span class="visually-hidden">Цитата</span>
                        <svg class="filters__icon" width="21" height="20">
                            <use xlink:href="#icon-filter-quote"></use>
                        </svg>
                    </a>
                </li>
                <li class="popular__filters-item filters__item">
                    <a class="filters__button filters__button--link button" href="#">
                        <span class="visually-hidden">Ссылка</span>
                        <svg class="filters__icon" width="21" height="18">
                            <use xlink:href="#icon-filter-link"></use>
                        </svg>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="popular__posts">
        <?php foreach ($popular_posts as $post): ?>
        <article class="popular__post post <?= $post['type']; ?>">
            <header class="post__header">
                <h2><a href="#"><?= esc($post['subject']); ?></a></h2>
            </header>
            <div class="post__main">
            <?php if ($post['type'] == 'post-quote'): ?>
                <blockquote>
                    <p>
                        <?= esc($post['content']); ?>
                    </p>
                    <cite>Автор</cite>
                </blockquote>
            <?php elseif ($post['type'] == 'post-video'): ?>
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
            <?php elseif ($post['type'] == 'post-link'): ?>
                <div class="post-link__wrapper">
                    <a class="post-link__external" href="http://<?= esc($post['content']); ?>" title="Перейти по ссылке">
                        <div class="post-link__info-wrapper">
                            <div class="post-link__icon-wrapper">
                                <img src="img/logo-vita.jpg" alt="Иконка">
                            </div>
                            <div class="post-link__info">
                                <h3><?= esc($post['subject']); ?></h3>
                                <p><?= esc($post['content']); ?></p>
                            </div>
                        </div>
                        <span><?= $post['content']; ?></span>
                    </a>
                </div>
            <?php elseif ($post['type'] == 'post-photo'): ?>
                <div class="post-photo__image-wrapper">
                    <img src="img/<?= esc($post['content']); ?>" alt="Фото от пользователя" width="360" height="240">
                </div>
            <?php elseif ($post['type'] == 'post-text'): ?>
                <?= truncate_text($post['content']); ?>
            <?php endif; ?>
            </div>
            <footer class="post__footer">
                <div class="post__author">
                    <a class="post__author-link" href="#" title="Автор">
                        <div class="post__avatar-wrapper">
                            <img class="post__author-avatar" src="img/userpic-larisa-small.jpg" alt="Аватар пользователя">
                        </div>
                        <div class="post__info">
                            <b class="post__author-name">Лариса Роговая</b>
                            <time class="post__time" datetime="<?= $post['datetime']; ?>" title="<?= date("d.m.Y H:i", strtotime($post['datetime'])); ?>"><?= dateDifference(strtotime($post['datetime']), time()); ?></time>
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
                            <span>250</span>
                            <span class="visually-hidden">количество лайков</span>
                        </a>
                        <a class="post__indicator post__indicator--comments button" href="#" title="Комментарии">
                            <svg class="post__indicator-icon" width="19" height="17">
                                <use xlink:href="#icon-comment"></use>
                            </svg>
                            <span>25</span>
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
