<?php
$posts =[
    [
        'id' => 1,
        'title' => 'The Road Ahead',
        'image_url' => '/static/images/featuredpostsleft.jpg',
        'subtitle' => 'The road ahead might be paved - it might not be.',
        'author_avatar' => './static/images/matvogels.jpg',
        'author' => 'Mat Vogels',
        'date' => 'September 25, 2015',
        'featured' => 1,

    ],
    [
        'id' => 2,
        'title' => 'From Top Down',
        'image_url' => '/static/images/fromtopdown.jpg',
        'subtitle' => 'Once a year, go someplace you’ve never been before.',
        'author_avatar' => './static/images/williamwong.jpg',
        'author' => 'William Wong',
        'date' => 'September 25, 2015',
        'featured' => 1,
    ],
    [
        'id' => 3,
        'image_url' => './static/images/stillstanding.jpg', 
        'title' => 'Still Standing Tall',
        'subtitle' => 'Life begins at the end of your comfort zone.',
        'author_avatar' => './static/images/williamwong.jpg',
        'author' => 'William Wong',
        'date' => '9/25/2015',
        'featured' => 0,
    ],
    [
        'id' => 4,
        'image_url' => './static/images/sunny sideup.jpg', 
        'title' => 'Sunny Side Up',
        'subtitle' => 'No place is ever as bad as they tell you its going to be.',
        'author_avatar' => './static/images/matvogels.jpg',
        'author' => 'Mat Vogels',
        'date' => '9/25/2015',
        'featured' => 0,
    ],
    [
        'id' => 5,
        'image_url' => './static/images/waterfalls.jpg', 
        'title' => 'Water Falls',
        'subtitle' => 'We travel not to escape life, but for life not to escape us.',
        'author_avatar' => './static/images/matvogels.jpg',
        'author' => 'Mat Vogels',
        'date' => '9/25/2015',
        'featured' => 0,
    ],
    [
        'id' => 6,
        'image_url' => './static/images/through the mist.jpg', 
        'title' => 'Through the Mist',
        'subtitle' => 'Travel makes you see what a tiny place you occupy in the world.',
        'author_avatar' => './static/images/williamwong.jpg',
        'author' => 'William Wong',
        'date' => '9/25/2015',
        'featured' => 0,
    ],
    [
        'id' => 7,
        'image_url' => './static/images/awaken early.jpg', 
        'title' => 'Awaken Early',
        'subtitle' => 'Not all those who wander are lost.',
        'author_avatar' => './static/images/matvogels.jpg',
        'author' => 'Mat Vogels',
        'date' => '9/25/2015',
        'featured' => 0,
    ],
    [
        'id' => 8,
        'image_url' => './static/images/try it always.jpg', 
        'title' => 'Try it Always',
        'subtitle' => 'The world is a book, and those who do not travel read only one page.',
        'author_avatar' => './static/images/matvogels.jpg',
        'author' => 'Mat Vogels',
        'date' => '9/25/2015',
        'featured' => 0,
    ],
];
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="/static/css/index.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Oxygen:wght@300;400;700&display=swap" rel="stylesheet">
        <style>
            @import url('https://fonts.cdnfonts.com/css/lora');
            h1, h2, h3{
                font-weight: normal;
            }
        </style>
    </head>
    <body>
        <div class="bighead">
            <header class="header">
                <div class="header__leftside">
                    <img src="/static/images/Escape.svg">
                </div>
                <div class="header__rightside">
                    <a>HOME</a>
                    <a>CATEGORIES</a>
                    <a>ABOUT</a>
                    <a>CONTACT</a>                    
                </div>
            </header>
            <div class="headtitle">
                <h1 class="headtitle__title">Let's do it together.</h1>
                <h2 class="headtitle__subtitle">We travel the world in search of stories. Come along for the ride.</h2>
                <div class="headtitle__button">
                    <a class="headtitile__button-text">View Latest Posts</a>
                </div>
            </div>
        </div>
        <div class="topics">
            <a class="topics_element">Nature</a>
            <a class="topics_element">Photography</a>
            <a class="topics_element">Relaxation</a>
            <a class="topics_element">Vacation</a>
            <a class="topics_element">Travel</a>
            <a class="topics_element">Adventure</a>
        </div>
        <div class="featured-posts">
            <div class="featured-posts__title">
                <a class="featured-posts__title-text">Featured Posts</a>
                <div class="featured-posts__title-line"></div>
            </div>
            <div class="featured-posts__elements">
                <?php 
                    foreach ($posts as $post) {
                        if ($post['featured'] == 1)
                        {
                            include 'featured_post_preview.php';
                        }
                    }
                ?> 
            </div>
        </div>
        <div class="most-recent">
            <div class="most-recent__title">
                <a class="most-recent__title-text">Most Recent</a>
                <div class="most-recent__titleline"></div> 
            </div>
            <div class="most-recent__elements">
                <?php 
                    foreach ($posts as $post) {
                        if ($post['featured'] == 0)
                        include 'most_recent_post_preview.php';
                    }
                ?>
            </div>
        </div>
        <footer class="final-footer">
            <div class="final-footer__leftside">
                <img src="/static/images/Escape.svg">
            </div>
            <div class="final-footer__rightside">
                <a>HOME</a>
                <a>CATEGORIES</a>
                <a>ABOUT</a>
                <a>CONTACT</a>                    
            </div>
        </footer>
    </body>
</html>