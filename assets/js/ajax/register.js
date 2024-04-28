/*
* Регистрация
*/

$(document).ready(function() {
    $('#form-register #username').on('input', function() {
        validateUsername();
    });

    $('#form-register #email').on('input', function() {
        validateEmailField();
    });

    $('#form-register #password').on('input', function() {
        validatePasswordField();
    });

    $('#form-register #password_confirm').on('input', function() {
        validatePasswordConfirmField();
    });

    $('#form-register').submit(function(e) {
        e.preventDefault();

        $('.error-message').empty();
        $('input').removeClass('_is-error');

        let hasError = false;

        validateUsername();
        validateEmailField();
        validatePasswordField();
        validatePasswordConfirmField();

        if (!hasError) {
            let username = $('input[name="username"]').val();
            let email = $('input[name="email"]').val();
            let password = $('input[name="password"]').val();
            let password_confirm = $('input[name="password_confirm"]').val();

            let formData = new FormData();

            formData.append('username', username);
            formData.append('email', email);
            formData.append('password', password);
            formData.append('password_new', password);
            formData.append('password_confirm', password_confirm);

            $.ajax({
                url: 'vendor/auth/register.php',
                type: 'POST',
                dataType: 'json',
                processData: false,
                contentType: false,
                cache: false,
                data: formData,
                success: function(data) {
                    if (data.status) {
                        document.location.href = '/profile.php';
                    } else {
                        if (data.type === 1) {
                            data.fields.forEach(function(field) {
                                $(`input[name="${field}"]`).addClass('_is-error');
                                $(`input[name="${field}"]`).next('.error-message').text(data.message[field]);
                            });
                        }
                    }
                }
            });
        }
    });

    function validateUsername() {
        let username = $('#form-register #username').val();
        if (username.length < 4) {
            $('#form-register #username').addClass('_is-error');
            $('#form-register #username').next('.error-message').text('Имя пользователя должно быть не менее 4 символов');
            hasError = true;
        } else {
            $('#form-register #username').removeClass('_is-error');
            $('#form-register #username').next('.error-message').empty();
        }
    }

    function validateEmailField() {
        let email = $('#form-register #email').val();
        if (!validateEmail(email)) {
            $('#form-register #email').addClass('_is-error');
            $('#form-register #email').next('.error-message').text('Введите корректный email');
            hasError = true;
        } else {
            $('#form-register #email').removeClass('_is-error');
            $('#form-register #email').next('.error-message').empty();
        }
    }

    function validatePasswordField() {
        let password = $('#form-register #password').val();
        if (password.length < 9) {
            $('#form-register #password').addClass('_is-error');
            $('#form-register #password').next('.error-message').text('Пароль должен быть не менее 9 символов');
            hasError = true;
        } else {
            $('#form-register #password').removeClass('_is-error');
            $('#form-register #password').next('.error-message').empty();
        }
    }

    function validatePasswordConfirmField() {
        let password = $('#form-register #password').val();
        let password_confirm = $('#form-register #password_confirm').val();
        if (password !== password_confirm) {
            $('#form-register #password_confirm').addClass('_is-error');
            $('#form-register #password_confirm').next('.error-message').text('Пароли не совпадают');
            hasError = true;
        } else {
            $('#form-register #password_confirm').removeClass('_is-error');
            $('#form-register #password_confirm').next('.error-message').empty();
        }
    }

    function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }
});