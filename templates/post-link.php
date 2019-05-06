<div class="post__main">
    <div class="post-link__wrapper">
        <a class="post-link__external" href="http://<?= esc($post['link_url']); ?>" title="Перейти по ссылке">
            <div class="post-link__info-wrapper">
                <div class="post-link__icon-wrapper">
                    <img src="img/logo-vita.jpg" alt="Иконка">
                </div>
                <div class="post-link__info">
                    <h3><?= esc($post['subject']); ?></h3>
                    <p><?= esc($post['subject']); ?></p>
                </div>
            </div>
            <span><?= esc($post['link_url']); ?></span>
        </a>
    </div>
</div>
