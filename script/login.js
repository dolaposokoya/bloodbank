const signUpBtn = document.getElementById('submit');
const email = document.getElementById('email');
const password = document.getElementById('password');
const Erroremail = document.getElementById('emailError');
const inValidemail = document.getElementById('emailInvalidError');
const Errorpassword = document.getElementById('passwordError');
const invalidpassword = document.getElementById('passwordInvalidError');
const error = document.getElementsByClassName('error');


signUpBtn.addEventListener('click', registerUser)


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

async function registerUser(event) {
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
        const email_v = $("#email").val();
        const pwd_v = $("#password").val();
        const apiURl = `controller/signup.controller.php`
        const data = {
            email_v: email_v,
            pwd_v: pwd_v,
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
                if (data.success === true) {
                    $("#email").val("");
                    $("#password").val("");;
                    $(".btn-outline-primary").html("Login");
                } else {
                    console.log(data.message);
                    $(".btn-outline-primary").html("Login");
                }
            }
        });

    }

}
