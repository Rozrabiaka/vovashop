$("#orders-delivery_type").change(function () {
    const delivery = $('#orders-delivery_type').val();

    $.ajax({
        type: "GET",
        url: "/ajax/payment",
        data: {'delivery': delivery},
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        success: function (data) {
            if (data.success === false) showMessageBlock('Произошла ошибка при выборе способа оплаты. Пожалуйста, попробуйте сново.');
            else {
                var $el = $("#orders-payment_type");
                $el.empty(); // remove old options
                $.each(data.message, function (key, value) {
                    $el.append($("<option></option>")
                        .attr("value", value).text(key));
                });
            }
        },
        error: function (errormessage) {
            showMessageBlock('Произошла ошибка при выборе способа оплаты. Пожалуйста, попробуйте сново.')
        }
    });
});

function showMessageBlock(message) {
    jQuery('.info-site-block-message').text(message);
    jQuery('#site-block-message').fadeIn();
}
