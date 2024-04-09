<div class="most-recent__elem1">
    <img src="<?= $post['image_url'] ?>">
    <div class="most-recent__elements-text">
        <h2 class="most-recent__elements-text__lora"><?= $post['title'] ?></h2>
        <h3 class="most-recent__elements-text__oxygen"><?= $post['subtitle'] ?></h3>
    </div>
    <div class="most-recent__line"></div>
    <div class="most-recent__elements-footer">
        <img src="<?= $post['author_avatar'] ?>" class="elements-footer__avatar">
        <h2 class="elements-footer__author"><?= $post['author'] ?></h2>
        <h3 class="elements-footer__date"><?= $post['date'] ?></h3>
    </div>
</div>

