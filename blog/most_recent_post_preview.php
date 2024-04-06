<div class="most-recent__elem1">
    <img src="<?= $most_recent_post['image_url'] ?>">
    <div class="most-recent__elements-text">
        <h2 class="most-recent__elements-text__lora"><?= $most_recent_post['title'] ?></h2>
        <h3 class="most-recent__elements-text__oxygen"><?= $most_recent_post['subtitle'] ?></h3>
    </div>
    <div class="most-recent__line"></div>
    <div class="most-recent__elements-footer">
        <img src="<?= $most_recent_post['author_avatar'] ?>" class="elements-footer__avatar">
        <h2 class="elements-footer__author"><?= $most_recent_post['author'] ?></h2>
        <h3 class="elements-footer__date"><?= $most_recent_post['date'] ?></h3>
    </div>
</div>
