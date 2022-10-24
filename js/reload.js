var reload = function (url, data) {
    $.post(url, data)
        .done(function (data) {
            // console.log(data);
        });
}