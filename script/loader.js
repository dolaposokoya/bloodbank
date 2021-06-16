document.onreadystatechange = function () {
    if (document.readyState !== "complete") {
        $(".spinnerdiv").show();
    } else {
        $(".spinnerdiv").fadeOut();
    }
};