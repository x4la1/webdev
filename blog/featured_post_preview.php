<div class="featured-posts_element">
    <img src="<?= $featured_post['image_url'] ?>">
    <div class="featured-post__text">
        <h1 class="featured-post__text_lora"><?= $featured_post['title'] ?></h1>
        <h2 class="featured-post__text_oxygen"><?= $featured_post['subtitle'] ?></h2>
        <div class="featured-post__footer">
            <img class="featured-post__footer-avatar" src="<?= $featured_post['author_avatar'] ?>">
            <a class="featured-post__footer-author"><?= $featured_post['author'] ?></a>
            <p class="featured-post__footer-date"><?= $featured_post['date'] ?></p>
        </div>
    </div>
</div>
