$(document).ready(function () {
    let timeoutId;

    let selectedOptionsCard = {
        'order_tel': '',
        'order_data': '',
        'order_time': '',
        'comment': '',
    };

    $('#checkout #order_tel').on('input focus', function() {
        clearTimeout(timeoutId);
        timeoutId = setTimeout(validatePhone, 100);
    });

    $('#checkout #data').on('input', function() {
        validateData();
    });

    $('#checkout').submit(function(e) {
        e.preventDefault();

        $('.error-message').empty();
        $('input').removeClass('_is-error');

        let hasError = false;

        validateData();
        validatePhone();

        if (!hasError) {
            let tel = $('input[name="order_tel"]').val();
            let data = $('input[name="order_data"]').val();
            let time = $('input[name="order_time"]').val();
            let comment = $('textarea[name="comment"]').val();

            selectedOptionsCard['order_tel'] = tel;
            selectedOptionsCard['order_data'] = data;
            selectedOptionsCard['order_time'] = time;
            selectedOptionsCard['comment'] = comment;

            updateDataCart(selectedOptionsCard);
        }
    });

    function updateDataCart(dataObject) {
        console.log(dataObject);

        $.ajax({
            url: '/vendor/cart/checkout.php',
            method: 'POST',
            data: {
                order_tel: dataObject.order_tel,
                order_data: dataObject.order_data,
                order_time: dataObject.order_time,
                comment: dataObject.comment,
            },
            success: function(data) {
                console.log(data);
                if (data.status){
                    document.location.href = '/order-success.php';
                } else {
                    // Удаление предыдущих ошибок
                    $('.error-message').empty();
                    $('input').removeClass('_is-error');

                    $('#checkout')[0].reset();

                    // Добавление класса `_is-error` к элементу с классом `account--success`
                    $('.account--success').addClass('_is-error');
                }
            }
        });
    }

    function validateData() {
        let inputDate = new Date($('#checkout #data').val());
        let currentDate = new Date();

        if (inputDate < currentDate) {
            $('#checkout #data').addClass('_is-error');
            $('#checkout #data').next('.error-message').text('Дата не может быть меньше текущей');
            hasError = true;
        } else {
            $('#checkout #data').removeClass('_is-error');
            $('#checkout #data').next('.error-message').empty();
        }
    }

    function validatePhone() {
        let phoneNumber = $('#checkout #order_tel').val();
        console.log(phoneNumber);
        if (phoneNumber.length === 19) {
            $('#checkout #order_tel').removeClass('_is-error');
            $('#checkout #order_tel').next('.error-message').empty();
        } else {
            $('#checkout #order_tel').addClass('_is-error');
            $('#checkout #order_tel').next('.error-message').text('Номер телефона должен быть 9 символов');
            hasError = true;
        }
    }

    $('[data-phone-pattern]').on('input blur focus', (e) => {
        var el = e.target,
            clearVal = $(el).data('phoneClear'),
            matrix = $(el).data('phonePattern'),

            i = 0,
            def = matrix.replace(/\D/g, ""),
            val = $(el).val().replace(/\D/g, "");
        if (clearVal !== 'false' && e.type === 'blur') {
            if (val.length < matrix.match(/([\_\d])/g).length) {
                $(el).val('');
                return;
            }
        }
        if (def.length >= val.length) val = def;
        $(el).val(matrix.replace(/./g, function (a) {
            return /[_\d]/.test(a) && i < val.length ? val.charAt(i++) : i >= val.length ? "" : a;
        }));
    });

});
