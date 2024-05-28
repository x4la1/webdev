document.addEventListener("DOMContentLoaded", () => {
    const postData =
    {
        title: 'New Post',
        subtitle: 'Please enter any desription',
        authorName: '',
        authorAvatar: '',
        publishDate: '',
        bigImage: '',
        smallImage: '',
        content: ''
    }

    const titleInput = document.getElementById('title');
    const subtitleInput = document.getElementById('description');
    const authorNameInput = document.getElementById('author-name');
    const authorAvatarInput = document.getElementById('author-photo');
    const bigImageInput = document.getElementById('big-hero-image')
    const smallImageInput = document.getElementById('small-hero-image');
    const publishDateInput = document.getElementById('date');
    const contentInput = document.getElementById('content');

    function onTitleInputChange(event) {
        postData.title = event.target.value;
        invalidatePostPreview()
    }

    function onSubtitleInputChange(event) {
        postData.subtitle = event.target.value;
        invalidatePostPreview()
    }

    function onAuthorNameInputChange(event) {
        postData.authorName = event.target.value;
        invalidatePostPreview()
    }

    function onAuthorAvatarInputChange(event) {
        const file = event.target.files[0];
        readFileAsBase64(file, (result) => {
            postData.authorAvatar = result;
            invalidatePostPreview()
        });
    }

    function onBigImageInputChange(event) {
        const file = event.target.files[0];
        readFileAsBase64(file, (result) => {
            postData.bigImage = result;
            invalidatePostPreview()
        });
    }

    function onSmallImageInputChange(event) {
        const file = event.target.files[0];
        readFileAsBase64(file, (result) => {
            postData.smallImage = result;
            invalidatePostPreview()
        });
    }

    function onPublishDateInputChange(event) {
        postData.publishDate = event.target.value;
        invalidatePostPreview()
    }

    function onContentInputChange(event) {
        postData.content = event.target.value;
        invalidatePostPreview()
    }

    function initEventListener() {
        titleInput.addEventListener('input', onTitleInputChange);
        subtitleInput.addEventListener('input', onSubtitleInputChange);
        authorNameInput.addEventListener('input', onAuthorNameInputChange);
        authorAvatarInput.addEventListener('change', onAuthorAvatarInputChange);
        bigImageInput.addEventListener('change', onBigImageInputChange);
        smallImageInput.addEventListener('change', onSmallImageInputChange);
        publishDateInput.addEventListener('input', onPublishDateInputChange);
        contentInput.addEventListener('input', onContentInputChange);

    }

    function readFileAsBase64(file, onload) {
        const reader = new FileReader();
        reader.addEventListener("load", () => {
            onload(reader.result);
        }, false,);
        reader.readAsDataURL(file);
    }


    function invalidatePostPreview() {
        const postBigPreviewTitle = document.querySelector('.article-preview-main__title_lora');
        postBigPreviewTitle.innerText = postData.title;

        const postBigPreviewSubtitle = document.querySelector('.article-preview-main__title_oxygen');
        postBigPreviewSubtitle.innerText = postData.subtitle;


        if (postData.bigImage != '') {
            const postBigPreviewImage = document.querySelector('.article-preview-main__picture');
            postBigPreviewImage.style.backgroundImage = `url(${postData.bigImage})`;

            const previewBigImage = document.querySelector('.big-hero-image__input');
            previewBigImage.style.backgroundImage = `url(${postData.bigImage})`;

            const bigImageUploadText = document.querySelector('.big-hero-image__text');
            bigImageUploadText.innerText = '';

            const bigImageUploadButtons = document.querySelector('.big-hero-image__buttons');
            bigImageUploadButtons.style.display = 'flex';

            const bigImageComment = document.querySelector('.big-hero-image-comment');
            bigImageComment.innerText = '';
        }


        const postSmallPreviewTitle = document.querySelector('.preview-post-card__text_lora');
        postSmallPreviewTitle.innerText = postData.title;

        const postSmallPreviewSubtitle = document.querySelector('.preview-post-card__text_oxygen');
        postSmallPreviewSubtitle.innerText = postData.subtitle;


        if (postData.smallImage != '') {
            const postSmallPreviewImage = document.querySelector('.preview-post-card__picture')
            postSmallPreviewImage.style.backgroundImage = `url(${postData.smallImage})`;

            const previewSmallImage = document.querySelector('.small-hero-image__input');
            previewSmallImage.style.backgroundImage = `url(${postData.smallImage})`;

            const smallImageUploadText = document.querySelector('.small-hero-image__text');
            smallImageUploadText.innerText = ''

            const smallImageUploadButtons = document.querySelector('.small-hero-image__buttons');
            smallImageUploadButtons.style.display = 'flex';

            const smallImageComment = document.querySelector('.small-hero-image-comment');
            smallImageComment.innerText = '';
        }

        const postSmallPreviewAuthorAvatar = document.querySelector('.post-card-author__avatar');
        postSmallPreviewAuthorAvatar.style.backgroundImage = `url(${postData.authorAvatar})`;

        if (postData.authorAvatar != '') {
            const previewAvatar = document.querySelector('.author-photo__input');
            previewAvatar.style.backgroundImage = `url(${postData.authorAvatar})`;

            const previewAvatarText = document.querySelector('.author-photo__text');
            previewAvatarText.innerText = "Upload New";

            const previewAvatarUploadImage = document.querySelector('.author-photo__upload-image');
            previewAvatarUploadImage.src = "/Static/Images/camerasmall.svg"
        }

        const postSmallPreviewAuthorName = document.querySelector('.post-card-author__name');
        postSmallPreviewAuthorName.innerText = postData.authorName;

        const postSmallPreviewDate = document.querySelector('.post-card-date__text');
        postSmallPreviewDate.innerText = postData.publishDate;
    }


    initEventListener();


    document.getElementById('logout-button').addEventListener('click', function(event){
        event.preventDefault()
        fetch('http://localhost:8001/api/logout')
        .then(response => {
            if(response.ok){
                window.location.href = 'http://localhost:8001/home'
            }
        })
    })

    document.getElementById('post').addEventListener('submit', function (event) {
        event.preventDefault();
        let foundError = false;
        const globalError = document.querySelector('.global-fields-error')
        const globalSuccess = document.querySelector('.publish-complete')
        const titleError = document.querySelector('.title-input__field-error');
        const subtitleError = document.querySelector('.subtitle-input__field-error');
        const authorNameError = document.querySelector('.author-name-input__field-error');
        const authorAvatarError = document.querySelector('.author-photo-input__field-error');
        const publishDateError = document.querySelector('.date-input__field-error');
        const bigImageError = document.querySelector('.big-hero-image-input__field-error');
        const smallImageError = document.querySelector('.small-hero-image-input__field-error');
        const contentError = document.querySelector('.content-input__field-error');
        const contentTextArea = document.querySelector('.content-input__input-field')


        if (postData.title == '') {
            foundError = true;
            titleError.style.display = 'flex';
            titleInput.style.borderBottomColor = "#E86961";
        } else {
            titleError.style.display = 'none';
            titleInput.style.borderBottomColor = "#EAEAEA"
        }

        if (postData.subtitle == '') {
            foundError = true;
            subtitleError.style.display = 'flex';
            subtitleInput.style.borderBottomColor = "#E86961"
        } else {
            subtitleError.style.display = 'none';
            subtitleInput.style.borderBottomColor = "#EAEAEA"
        }

        if (postData.authorName == '') {
            foundError = true;
            authorNameError.style.display = 'flex';
            authorNameInput.style.borderBottomColor = "#E86961"
        } else {
            authorNameInput.style.borderBottomColor = "#EAEAEA"
            authorNameError.style.display = 'none';
        }

        if (postData.authorAvatar == '') {
            foundError = true;
            authorAvatarError.style.display = 'flex';
        } else {
            authorAvatarError.style.display = 'none';
        }

        if (postData.publishDate == '') {
            foundError = true;
            publishDateError.style.display = 'flex';
            publishDateInput.style.borderBottomColor = "#E86961"
        } else {
            publishDateError.style.display = 'none';
            publishDateInput.style.borderBottomColor = "#EAEAEA"
        }

        if (postData.bigImage == '') {
            foundError = true;
            bigImageError.style.display = 'flex';
        } else {
            bigImageError.style.display = 'none';
        }

        if (postData.smallImage == '') {
            foundError = true;
            smallImageError.style.display = 'flex';
        } else {
            smallImageError.style.display = 'none';
        }

        if (postData.content == '') {
            foundError = true;
            contentError.style.display = 'flex';
            contentTextArea.style.border = '1px solid #E86961'
        } else {
            contentError.style.display = 'none';
            contentTextArea.style.border = '1px solid #EAEAEA'
        }

        if (foundError == true) {
            globalError.style.display = 'flex';
            globalSuccess.style.display = 'none';
        } else {
            globalError.style.display = 'none';
            globalSuccess.style.display = 'flex';
            console.log(postData.authorAvatar);
            console.log(postData.authorName);
            console.log(postData.bigImage);
            console.log(postData.content);
            console.log(postData.publishDate);
            console.log(postData.smallImage);
            console.log(postData.subtitle);
            console.log(postData.title);
        }
    })



})

