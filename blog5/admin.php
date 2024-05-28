<?php
const HOST = 'localhost';
const USERNAME = 'x4la';
const PASSWORD = 's1230400102s';
const DATABASE = 'blog';

function authBySession()
{
    session_name('auth');
    session_start();
    if (!(array_key_exists('user_id', $_SESSION))) {
        header('HTTP/1.1 401 Unauthorized');
        die();
    }
}
authBySession();

function createDBConnection(): mysqli
{
    $conn = new mysqli(HOST, USERNAME, PASSWORD, DATABASE);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

function closeDBConnection(mysqli $conn): void
{
    $conn->close();
}

function getUserEmailById(mysqli $conn, int $id): string
{
    $query = "SELECT email FROM user WHERE user_id = '$id'";
    $result = $conn->query($query);
    $result->num_rows;
    $row = $result->fetch_assoc();
    $email = $row['email'];
    return $email;
}
$conn = createDBConnection();
$email = getUserEmailById($conn, $_SESSION['user_id']);
closeDBConnection($conn);
?>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <link rel="stylesheet" href="/static/css/admin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oxygen:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        @import url('https://fonts.cdnfonts.com/css/lora');
    </style>


</head>

<body>
    <header class="main-header">
        <div class="main-header__leftside">
            <img src="/Static/Images/escape_author.svg" id="asddsa" />
        </div>
        <div class="main-header__rightside">
            <div class="main-header__avatar">
                <p class="avatar__letter"><?= strtoupper($email[0]) ?></p>
            </div>
            <button type="submit" id="logout-button" class="main-header__logout-button">
                <img src="/Static/Images/log-out.svg" class="" alt="">
            </button>
        </div>
    </header>

    <div class="title">
        <div class="title__leftside">
            <h1 class="title__text_lora">New Post</h1>
            <h2 class="title__text_oxygen">Fill out the form bellow and publish your article</h2>
        </div>
        <div class="title__rightside">
            <button type="submit" class="title__button" name="publish" form="post" title="Submit">
                Publish
            </button>
        </div>
    </div>
    <div class="publish-complete" style="display: none;">
        <img src="Static/Images/success.svg" alt="" class="publish-complete__img" />
        <p class="publish-complete__text">Publish Complete!</p>
    </div>
    <div class="global-fields-error" style="display: none;">
        <img src="Static/Images/error.svg" alt="" class="global-fields-error__img" />
        <p class="global-fields-error__text">Whoops! Some fields need your attention :o</p>
    </div>
    <main class="main-info">
        <form id="post" class="postform" method="post" enctype="multipart/form-data">
            <div class="postform__title">
                <h2 class="postform__title_lora">Main Information</h2>
            </div>
            <div class="default-input postform__title-input">
                <label for="title" class="input-text-oxygen">Title</label>
                <input type="text" id="title" class="default-input-field" value="New Post" placeholder=" " />
                <div class="default-field-error  title-input__field-error" style="display: none;">
                    <p class="default-field-error__text"> Title is required</p>
                </div>
            </div>
            <div class="default-input postform__description-input">
                <label for="description" class="input-text-oxygen">Short description</label>
                <input type="text" id="description" class="default-input-field" value="Please, enter any description" placeholder=" " />
                <div class="default-field-error  subtitle-input__field-error" style="display: none;">
                    <p class="default-field-error__text">Short description is required</p>
                </div>
            </div>
            <div class="default-input postform__author-name-input">
                <label for="author-name" class="input-text-oxygen">Author name</label>
                <input type="text" id="author-name" class="default-input-field" placeholder=" ">
                <div class="default-field-error  author-name-input__field-error" style="display: none;">
                    <p class="default-field-error__text">Author name is required</p>
                </div>
            </div>
            <div class="default-input postform__avatar-input">
                <label for="author-photo" class="input-text-oxygen">Author Photo</label>
                <label for="author-photo" class="author-photo__input">
                    <input type="file" id="author-photo" class="author-photo__input-field" accept="image/jpeg, image/png, image/gif" />
                    <div class="author-photo__buttons">
                        <img src="" alt="" class="author-photo__upload-image">
                        <h2 class="author-photo__text">Upload</h2>
                    </div>
                </label>
                <div class="default-field-error author-photo-input__field-error" style="display: none;">
                    <p class="default-field-error__text">Author Photo is required</p>
                </div>
            </div>
            <div class="default-input postform__date-input">
                <label for="title" class="input-text-oxygen">Publish Date</label>
                <input type="date" id="date" class="default-input-field" placeholder="дд-мм-гггг" />
                <div class="default-field-error  date-input__field-error" style="display: none;">
                    <p class="default-field-error__text">Publish date is required</p>
                </div>
            </div>
            <div class="default-input postform__big-hero-image-input">
                <label for="big-hero-image" class="input-text-oxygen">Hero Image</label>
                <div class="big-hero-image">
                    <label for="big-hero-image" class="big-hero-image__input">
                        <input type="file" id="big-hero-image" class="big-hero-image__input-field" accept="image/jpeg, image/png, image/gif">
                        <h2 class="big-hero-image__text">Upload</h2>
                    </label>
                </div>
                <label for="big-hero-image" class="big-hero-image__buttons" style="display: none;">
                    <div class="big-hero-image__upload-buttons">
                        <img src="/Static/Images/camerasmall.svg" alt="">
                        <p class="big-hero-image-upload-buttons__text">Upload New</p>
                    </div>
                </label>
                <div class="default-field-error  big-hero-image-input__field-error" style="display: none;">
                    <p class="default-field-error__text">Hero Image is required</p>
                </div>
                <h3 class="big-hero-image-comment">Size up to 10mb. Format: png, jpeg, gif.</h3>
            </div>
            <div class="default-input postform__small-hero-image-input">
                <label for="small-hero-image" class="input-text-oxygen">Hero image</label>
                <div class="small-hero-image">
                    <label for="small-hero-image" class="small-hero-image__input">
                        <input type="file" id="small-hero-image" class="small-hero-image__input-field" accept="image/jpeg, image/png, image/gif" />
                        <h2 class="small-hero-image__text">Upload</h2>
                    </label>
                </div>
                <label for="small-hero-image" class="small-hero-image__buttons" style="display: none;">
                    <div class="small-hero-image__upload-buttons">
                        <img src="/Static/Images/camerasmall.svg" alt="">
                        <p class="small-hero-image-upload-buttons__text">Upload New</p>
                    </div>
                </label>
                <div class="default-field-error  small-hero-image-input__field-error" style="display: none;">
                    <p class="default-field-error__text">Hero Image is required</p>
                </div>
                <h3 class="small-hero-image-comment">Size up to 5mb. Format: png, jpeg, gif.</h3>
            </div>
        </form>
        <div class="preview">
            <div class="article-preview">
                <p class="article-preview__label">Article preview</p>
                <div class="preview-border">
                    <div class="article-preview__main">
                        <div class="article-preview-main__header"></div>
                        <div class="article-preview-main__title">
                            <h2 class="article-preview-main__title_lora" id="article-preview-title">New Post</h2>
                            <h3 class="article-preview-main__title_oxygen" id="article-preview-subtitle">Please, enter any description</h3>
                        </div>
                        <div class="article-preview-main__picture">

                        </div>
                    </div>
                </div>
            </div>
            <div class="preview-post-card">
                <p class="preview-post-card__label">Post card preview</p>
                <div class="preview-post-card__border">
                    <div class="preview-post-card__main">
                        <div class="preview-post-card__picture">

                        </div>
                        <div class="preview-post-card__text">
                            <h2 class="preview-post-card__text_lora" id="post-card-title">New Post</h2>
                            <h3 class="preview-post-card__text_oxygen" id="post-card-subtitle">Please, enter any description</h3>
                        </div>
                        <div class="preview-post-card__footer">
                            <div class="post-card__author">
                                <div class="post-card-author__avatar" id="author-avatar">

                                </div>
                                <div class="post-card-author__name" id="author__name">

                                </div>
                            </div>
                            <div class="post-card__date" id="post-card-date">
                                <p class="post-card-date__text" id="post-card-date"> 12/12/2005</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <div class="content">
        <div class="content__title">
            <h2 class="content__title_lora">Content</h2>
        </div>
        <div class="content__input">
            <div class="content-input__title">
                <p class="content-input__title_oxygen">Post content (plain text)</p>
            </div>
            <textarea name="" id="content" class="content-input__input-field" placeholder="Type anything you want ..."></textarea>
            <div class="default-field-error  content-input__field-error" style="display: none;">
                <p class="default-field-error__text">Content is required</p>
            </div>
        </div>
    </div>
    <script src="admin_panel.js" defer></script>
</body>

</html>