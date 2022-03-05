$(function () {
    $("form").submit(function (e) {
        
        e.preventDefault();

        var form = $(this);
        var action = form.attr("action");
        var data = form.serialize();

        $.ajax({
            url: action,
            data: data,
            type: "post",
            dataType: "json",
            success: function (su) {

                if (su.message) {
                    var view = '<span class="border border-' + su.message.type + ' text-' + su.message.type + ' rounded p-2 mb-3">' + su.message.message + '</span>';
                    $(".form_callback").html(view);
                    return;
                }

                if (su.redirect) {
                    window.location.href = su.redirect.url;
                }
            }
        });
    });
});