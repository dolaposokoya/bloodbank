
$("#alert_box").hide();
$("#logout").click(function () {
    const apiURl = `../controller/logout.controller.php`
    $.ajax({
        method: "post",
        url: apiURl,
        dataType: 'json',
        beforeSend: function (data) {
            $("#logout").html("Loging out...");
        },
        success: (data) => {
            console.log('data', data)
            if (data.success === true && data.message === "Logout successful") {
                $('#warning_alert').text(data.message)
                $("#alert_box").show();
                setTimeout(function () { $('#alert_box').fadeOut('slow'); }, 3000);
                $("#logout").html("Log Out");
                setTimeout(function () { window.location.assign('../index.php') }, 2000);
            } else {
                $('#warning_alert').text(data.message);
                $("#alert_box").show();
                setTimeout(function () { $('#alert_box').fadeOut('slow'); }, 3000);
                $("#logout").html("Log Out");
            }
        }
    })
});