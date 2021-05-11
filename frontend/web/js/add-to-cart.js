jQuery(".add-cart").on('click', function (event) {
    const sPageURL = window.location.search.substring(1);
    const sURLVariables = sPageURL.split('&');
    let productId = '';
    for (var i = 0; i < sURLVariables.length; i++) {
        var sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] == 'id')
            productId = sParameterName[1];
    }
    const count = jQuery('.cart-plus-minus-box').val();
    const color = jQuery(".nice-select option:selected").val();

    if (jQuery(".nice-select option:first").prop("selected", "selected").val() !== 'selected') {
        showMessageBlock('Что то пошло не так, пожалуйста, перезагрузите страницу');
        return;
    } else {
        if (color === 'selected') {
            showMessageBlock('Пожалуйста, выберите цвет продукта.');
            return;
        }
    }

    //add to cart
    jQuery.ajax({
        type: "GET",
        url: "/ajax/cart",
        data: {'id': productId, 'count': count, 'color': color},
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        success: function (data) {
            if (data.success === false) {
                showMessageBlock(data.message);
            }

            if (data.success === true) {
                showMessageBlock(data.message);
                jQuery('.header-action-num').text(data.cartCount);
                setTimeout(function () {
                    jQuery('#site-block-message').fadeOut('fast');
                    window.location.replace(document.location.origin + "/site/cart");
                }, 4000);
            }
        },
        error: function (errormessage) {
            jQuery('.info-site-block-message').text('Произошла ошибка при добавлении продукта в корзину.');
            jQuery('#site-block-message').fadeIn();
        }
    });

    function showMessageBlock(message) {
        jQuery('.info-site-block-message').text(message);
        jQuery('#site-block-message').fadeIn();
    }
});