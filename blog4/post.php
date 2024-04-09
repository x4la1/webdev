<?php
  include 'posts.php';
  $postId = (int) $_GET['id'];
  echo $postId;  
  $index = array_search($postId, array_column($POSTS, 'id'));
  if ($index === false){
    header("HTTP/1.1 404 Not Found");
    die();
  }
  $CURRENT_POST = $POSTS[$index];
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="/static/css/style.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Oxygen:wght@300;400;700&display=swap" rel="stylesheet">
        <style>
            @import url('https://fonts.cdnfonts.com/css/lora');
        </style>
    </head>
    <body>
        <div class="all"> 
            <header class="base">
                <div class="escape">
                    <a>Escape.</a>
                </div>
                <div class="buttons">
                    <a>HOME</a>
                    <a>CATEGORIES</a>
                    <a>ABOUT</a>
                    <a>CONTACT</a>
                </div>
            </header>
            <div class = "head">
                <div class="title">
                    <?= $CURRENT_POST['title'] ?>
                </div>
                <div class="comment">
                    <?= $CURRENT_POST['subtitle'] ?>
                </div>
            </div>
            <div>
                <img src="<?= $CURRENT_POST['img_url'] ?>" class="image"> 
            </div>
            <div class="text">
                <?php if (count($CURRENT_POST['text']) != 0)
                    {
                        $CURRENT_POST['text'][0];
                    }
                    for ($i = 1; $i < count($CURRENT_POST['text']); $i++)
                    {
                        echo '<br>';
                        echo '<br>';
                        echo $CURRENT_POST['text'][$i];
                    }
                ?>
            </div>
            <div class="footer">
                <footer>
                    <div class="escape">
                        <a id="escape">Escape.</a>
                    </div>
                    <div class="buttons opacity">
                        <a class="opacity">HOME</a>
                        <a class="opacity">CATEGORIES</a>
                        <a class="opacity">ABOUT</a>
                        <a class="opacity">CONTACT</a>
                    </div>
                </footer>
            </div>
        </div>
    </body>
</html>