$(document).ready(function () {
    $("#products-category_id").change(function () {
        const categoryId = $('#products-category_id').val();

        $(document).ajaxSend(function () {
            $("#overlay").show();
        });

        $.ajax({
            type: "GET",
            url: "/admin/ajax/category",
            data: {'category_id': categoryId},
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            success: function (data) {
                //TODO добавить подкатегории
                if (data !== null) {
                    $('.field-products-subcategory_id').show();
                    $('.alert').hide();
                    $('#products-subcategory_id').show();

                    //remove all options from select
                    $('#products-subcategory_id').find('option').remove(); //удаление старых данных\

                    //add new options
                    for (let i = 0; i < data.length; i++) {
                        $('#products-subcategory_id').append($('<option/>', {
                            value: data[i].id,
                            text: data[i].name
                        }));
                    }
                } else {
                    $('.field-products-subcategory_id').append("<span class='alert alert-warning'>Подкатегории для выбраной категории не существует. Вы можете добавить подкатегорию либо продолжить добавление продукта.</span>");
                    $('#products-subcategory_id').hide();
                }

                $("#overlay").hide();
            },
            error: function (errormessage) {
                $("#overlay").hide();
                console.log("/admin/ajax/category error.");
            }
        });
    });
});