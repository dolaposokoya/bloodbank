const signUpBtn = document.getElementById('register');
const first_name = document.getElementById('first_name');
const last_name = document.getElementById('last_name');
const email = document.getElementById('email');
const password = document.getElementById('password');
const gender = document.getElementById('gender');

const error = document.getElementsByClassName('error');
const alert_box = document.getElementById('alert_box');

signUpBtn.addEventListener('click', registerUser)
alert_box.style.display = 'none'

const validateInput = async () => {
    let isValid = true
    const first_nameError = {};
    const last_nameError = {};
    const emailError = {};
    const passwordError = {};
    const genderError = {};
    const formData = {
        first_name: first_name.value,
        last_name: last_name.value,
        email: email.value,
        password: password.value,
        gender: gender.value,
    }
    if (formData.first_name === '') {
        first_nameError.empty = 'First name is empty';
        isValid = false
    }
    else if (formData.first_name !== '') {
        first_nameError.empty = '';
    }
    if (formData.last_name === '') {
        last_nameError.empty = 'Last name is empty';
        isValid = false
    }
    else if (formData.last_name !== '') {
        last_nameError.empty = '';
    }
    if (formData.email === '') {
        emailError.empty = 'Email is empty';
        isValid = false
    }
    else if (formData.email !== '') {
        emailError.empty = '';
    }
    if (!formData.email.includes('@')) {
        emailError.valid = 'Email is invalid';
        isValid = false
    }
    else if (formData.email.includes('@')) {
        emailError.valid = '';
    }
    if (formData.password === '') {
        passwordError.empty = 'Password is empty';
        isValid = false
    }
    else if (formData.password !== '') {
        passwordError.empty = '';
    }
    if (formData.password.length < 8) {
        passwordError.valid = 'Password should be more than 8 characters long';
        isValid = false
    }
    else if (formData.password.length >= 8) {
        passwordError.valid = '';
    }
    if (formData.gender === '') {
        genderError.empty = 'Gender is empty';
        isValid = false
    }
    else if (formData.gender !== '') {
        genderError.empty = '';
    }

    return {
        isValid: isValid,
        first_nameError,
        last_nameError,
        emailError,
        passwordError,
        genderError,
    }
}

async function registerUser(event) {
    event.preventDefault();

    const { isValid, first_nameError, last_nameError, emailError, passwordError, genderError } = await validateInput();
    if (isValid === false) {
        Object.keys(first_nameError).map(item => {
            $("#first_nameError").text(first_nameError[item]);
        })
        Object.keys(last_nameError).map(item => {
            $("#last_nameError").text(last_nameError[item]);
        })
        Object.keys(emailError).map(item => {
            $("#emailError").text(emailError[item]);
        });


        $("#emailError").text(emailError.empty);
        $("#emailInvalidError").text(emailError.valid);
        $("#passwordError").text(passwordError.empty);
        $("#passwordInvalidError").text(passwordError.empty);
        Object.keys(genderError).map(item => {
            $("#genderError").text(genderError[item]);
        })
    }
    else {
        const fname_v = $("#first_name").val();
        const lname_v = $("#last_name").val();
        const email_v = $("#email").val();
        const pwd_v = $("#password").val();
        const gender_v = $("#gender").val();
        const apiURl = `../controller/signup.controller.php`
        const data = {
            fname_v: fname_v,
            lname_v: lname_v,
            email_v: email_v,
            pwd_v: pwd_v,
            gender_v: gender_v,
        };

        $.ajax({
            method: "post",
            url: apiURl,
            dataType: 'json',
            data: data,
            beforeSend: function (data) {
                $("#register").html("Registering...");
            },
            success: function (data) {
                if (data.success === true && data.message === "User created successfully") {
                    $("#first_name").val("");
                    $("#last_name").val("");
                    $("#email").val("");
                    $("#password").val("");
                    $("#gender").val("");
                    $('#warning_alert').text(data.message)
                    alert_box.style.display = 'block'
                    setTimeout(function () { $('#alert_box').fadeOut('slow'); }, 3000);
                    $("#register").html("Register");
                    // $('#warning_alert').text("");
                    setTimeout(function () { window.location.assign('../index.php') }, 2000);
                } else {
                    $('#warning_alert').text(data.message);
                    alert_box.style.display = 'block'
                    setTimeout(function () { $('#alert_box').fadeOut('slow'); }, 3000);
                    $("#register").html("Register");
                    // $('#warning_alert').text("")
                }
            }
        });

    }

}
