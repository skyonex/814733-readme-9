<main class="page__main page__main--publication">
    <div class="container">
        <h1 class="page__title page__title--publication"><?= esc($post_subject); ?></h1>
        <section class="post-details">
            <h2 class="visually-hidden">Публикация</h2>
            <div class="post-details__wrapper post-photo">
                <div class="post-details__main-block post post--details">

                    <?= $post_content; ?>

                    <?= $post_indicators; ?>

                    <?= $post_comments; ?>
                </div>

                <?= $post_author; ?>
            </div>
        </section>
    </div>
</main>
