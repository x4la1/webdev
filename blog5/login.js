document.addEventListener("DOMContentLoaded", () => {

    const showPasswordButton = document.querySelector(".view-password");
    const inputPassword = document.getElementById("password");


    showPasswordButton.addEventListener('click', function (event) {
        event.preventDefault();
        if (inputPassword.getAttribute('type') === 'password') {
            inputPassword.setAttribute('type', 'text')
            showPasswordButton.classList.add('view');
        } else {
            showPasswordButton.classList.remove('view')
            inputPassword.setAttribute('type', 'password')
        }
    })


    document.getElementById("login").addEventListener('submit', function (event) {
        event.preventDefault();
        let emptyError = false
        let formatError = false
        const emailInput = document.getElementById("email")
        const emailEmptyError = document.getElementById("empty-email-error")
        const emailFormatError = document.getElementById("email-format-error")

        const passwordEmptyError = document.getElementById("empty-password-error")


        const userNotFoundError = document.getElementById("not-found")
        const inputFieldsError = document.getElementById("fields-error")
        //не пустые
        //иначе формат
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
        if (emailInput.value === "") {
            emptyError = true
            emailEmptyError.style.display = "flex"
        } else {
            emailEmptyError.style.display = "none"
            if (emailPattern.test(emailInput.value)) {
                formatError = false
            } else {
                formatError = true
            }
        }

        if (inputPassword.value === "") {
            emptyError = true
            passwordEmptyError.style.display = "flex"
        } else {
            passwordEmptyError.style.display = "none"
        }




        if (emptyError == true) {
            inputFieldsError.style.display = "flex"
            userNotFoundError.style.display = "none"
            emailFormatError.style.display = "none"
        } else {
            inputFieldsError.style.display = "none"
            if (formatError == true) {
                userNotFoundError.style.display = "none"
                emailEmptyError.style.display = "none"
                emailFormatError.style.display = "flex"
                inputFieldsError.style.display = "flex"

            } else {
                emailFormatError.style.display = "none"
                inputFieldsError.style.display = "none"
            }
        }


        if (emptyError == false && formatError == false) {
            const data = { login: emailInput.value, password: inputPassword.value }
            fetch('http://localhost:8001/api/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => {
                if(response.ok){
                    userNotFoundError.style.display = "none"
                    window.location.href = 'http://localhost:8001/admin'
                }else{
                    userNotFoundError.style.display = "flex"
                }
            })
        }
    })


})