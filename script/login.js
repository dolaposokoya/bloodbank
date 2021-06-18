const signUpBtn = document.getElementById('submit');
const email = document.getElementById('email');
const password = document.getElementById('password');
const Erroremail = document.getElementById('emailError');
const inValidemail = document.getElementById('emailInvalidError');
const Errorpassword = document.getElementById('passwordError');
const invalidpassword = document.getElementById('passwordInvalidError');
const error = document.getElementsByClassName('error');
const alert_box = document.getElementById('alert_box');

alert_box.style.display = 'none'

signUpBtn.addEventListener('click', loginUser)


const validateInput = async () => {
    let isValid = true
    const emailError = {};
    const passwordError = {};
    const formData = {
        email: email.value,
        password: password.value,
    }
    if (formData.email === '') {
        emailError.empty = 'Email is empty';
        isValid = false
    }
    if (!formData.email.includes('@')) {
        emailError.valid = 'Email is invalid';
        isValid = false
    }
    if (formData.password === '') {
        passwordError.empty = 'Password is empty';
        isValid = false
    }
    return {
        isValid: isValid,
        emailError,
        passwordError,
    }
}

async function loginUser(event) {
    event.preventDefault();

    const { isValid, emailError, passwordError } = await validateInput();
    if (isValid === false) {
        Erroremail.innerHTML = emailError.empty
        inValidemail.innerHTML = emailError.valid

        Errorpassword.innerHTML = passwordError.empty
        invalidpassword.innerHTML = passwordError.valid
    }
    else {
        ;
        const email = $("#email").val();
        const password = $("#password").val();
        const apiURl = `controller/login.controller.php`
        const data = {
            email: email,
            password: password,
        };

        $.ajax({
            method: "post",
            url: apiURl,
            dataType: 'json',
            data: data,
            beforeSend: function (data) {
                $(".btn-outline-primary").html("Sending...");
            },
            success: function (data) {
                if (data.success === true && data.message === 'Login Successful') {
                    $("#email").val("");
                    $("#password").val("");
                    $('#alert_warning').text(data.message)
                    alert_box.style.display = 'block'
                    setTimeout(function () { $('#alert_box').fadeOut('slow'); }, 3000);
                    $("#register").html("Register");
                    $(".btn-outline-primary").html("Login");
                    // $('#alert_warning').text("")
                } else {
                    $('#alert_warning').text(data.message)
                    alert_box.style.display = 'block'
                    setTimeout(function () { $('#alert_box').fadeOut('slow'); }, 3000);
                    $(".btn-outline-primary").html("Login");
                    // $('#alert_warning').text("")
                }
            }
        });

    }

}
