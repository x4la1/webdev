<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="/static/css/login_form.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oxygen:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        @import url('https://fonts.cdnfonts.com/css/lora');
    </style>
</head>

<body>
    <main class="content">
        <div class="icon">
            <img src="/Static/Images/login_icon.svg" alt="" class="icon__image">
            <p class="icon__text">Log in to start creating</p>
        </div>
        <div class="login">
            <h1 class="login__title">Log In</h1>
            <div class="login__error" style="display: none;" id="not-found">
                <img src="/Static/Images/error_img.svg" alt="" class="login-error-image">
                <p class="login-error-text">Email or password is incorrect.</p>
            </div>
            <div class="login__error" style="display: none;" id="fields-error">
                <img src="/Static/Images/error_img.svg" alt="" class="login-error-image">
                <p class="login-error-text">A-Ah! Check all field.</p>
            </div>
            <form action="" class="login__form" id="login" method="post">
                <div class="default-input login-form__email-input">
                    <label for="email" class="default-label-text">Email</label>
                    <input type="text" name="email" class="default-input-field email-input-field" id="email" placeholder=" ">
                    <p class="email-input-error" id="empty-email-error" style="display: none;">Email is required</p>
                    <p class="email-input-error" id="email-format-error" style="display: none;">Incorrect email format. Correct format is ****@**.***</p>
                </div>
                <div class="default-input login-form__password-input">
                    <label for="password" class="default-label-text">Password</label>
                    <input type="password" class="default-input-field password-input-field" name="password" id="password" placeholder=" ">
                    <button class="view-password" id="view-password"></button>
                    <p class="password-input-error" id="empty-password-error" style="display: none;">Password is required.</p>
                </div>
                <button type="submit" class="login-form__button" name="publish" form="login" title="Log In" id="login-button">
                    Log In
                </button>
            </form>
        </div>
    </main>
    <script src="login.js"></script>
</body>

</html>