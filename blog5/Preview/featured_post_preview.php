<div class="featured-posts_element">
    <a class="url" href='/post?id=<?= $post['id'] ?>'>
        <img src="<?= $post['image_url'] ?>" class="featured-post__image">
    </a>
    <div class="featured-post__text">
        <h2 class="featured-post__text_lora"><?= $post['title'] ?></h2>
        <h3 class="featured-post__text_oxygen"><?= $post['subtitle'] ?></h3>
        <div class="featured-post__footer">
            <img class="featured-post__footer-avatar" src="<?= $post['author_url'] ?>">
            <a class="featured-post__footer-author"><?= $post['author'] ?></a>
            <p class="featured-post__footer-date"><?= $post['publishdate'] ?></p>
        </div>
    </div>
</div>