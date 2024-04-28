$(document).ready(function () {
    let isFormModified = false;

    $('#account #username').on('input', function () {
        isFormModified = true;

        validateUsername();
    });

    $('#account input[type="file"]').on('change', function() {
        isFormModified = true;
    });

    $('#account #email').on('input', function () {
        isFormModified = true;

        validateEmailField();
    });

    $('#account #password').on('input', function () {
        isFormModified = true;

        validatePasswordField();
    });
    $('#account #password_new').on('input', function () {
        validatePasswordField();
    });
    $('#account #password_confirm').on('input', function () {
        validatePasswordField();
    });

    $('#account').submit(function (e) {
        e.preventDefault();

        if (!isFormModified) {
            return false;
        }

        $('.error-message').empty();
        $('input').removeClass('_is-error');

        let hasError = false;

        validateUsername();
        validateEmailField();
        validatePasswordField();

        if (!hasError) {
            let username = $('input[name="username"]').val();
            let email = $('input[name="email"]').val();
            let password = $('input[name="password"]').val();
            let password_new = $('input[name="password_new"]').val();
            let password_confirm = $('input[name="password_confirm"]').val();
            let avatar = $('input[name="avatar"]')[0].files[0];

            let formData = new FormData();

            formData.append('username', username);
            formData.append('email', email);
            formData.append('password', password);
            formData.append('password_new', password_new);
            formData.append('password_confirm', password_confirm);
            formData.append('avatar', avatar);


            $('.error-message').empty();
            $('input').removeClass('_is-error');

            $.ajax({
                url: 'vendor/auth/account.php',
                type: 'POST',
                dataType: 'json',
                processData: false,
                contentType: false,
                cache: false,
                data: formData,

                success: function(response) {
                    $('.error-message').empty();
                    $('input').removeClass('_is-error');

                    if (response.success) {
                        $('.alert-danger--wrapper').empty();
                        $('.alert-danger--wrapper').append('<div class="alert-danger _is-error account--success">' + response.message + '</div>');

                        // в шапке просто заменяемм путь к фотке
                        if (response.avatar) {
                            $('.header__users-img').attr('src', response.avatar);
                        }

                        $('input[name="password"]').val('');
                        $('input[name="password_new"]').val('');
                        $('input[name="password_confirm"]').val('');

                    } else {

                        $('.alert-danger--wrapper').empty();

                        for (var key in response.errors) {
                            $('.alert-danger--wrapper').append('<div class="alert-danger _is-error account--error">' + response.errors[key] + '</div>');

                            $(`input[name="${key}"]`).addClass('_is-error');
                            $(`input[name="${key}"]`).next('.error-message').text(response.errors[key]);
                        }

                    }
                },
                error: function(xhr, status, error) {
                    $('.alert-danger--wrapper').empty();
                    $('.alert-danger--wrapper').append('<div class="alert-danger _is-error account--error">Ошибка обновления информации о пользователи.</div>');
                }

            });
        }
    });

    function validateUsername() {
        let username = $('#account #username').val();
        if (username.length < 4) {
            $('#account #username').addClass('_is-error');
            $('#account #username').next('.error-message').text('Имя пользователя должно быть не менее 4 символов');
            hasError = true;
        } else {
            $('#account #username').removeClass('_is-error');
            $('#account #username').next('.error-message').empty();
            hasError = false;
        }

        return hasError;
    }

    function validateEmailField() {
        let email = $('#account #email').val();
        if (!validateEmail(email)) {
            $('#account #email').addClass('_is-error');
            $('#account #email').next('.error-message').text('Введите корректный email');
            hasError = true;
        } else {
            $('#account #email').removeClass('_is-error');
            $('#account #email').next('.error-message').empty();
            hasError = false;
        }

        return hasError;
    }

    function validatePasswordField() {
        let currentPassword = $('#account #password').val();
        let newPassword = $('#account #password_new').val();
        let confirmPassword = $('#account #password_confirm').val();
        let hasError = false;

        if (currentPassword == '') {
            $('#account #password').addClass('_is-error');
            $('#account #password').next('.error-message').text('Введите действующий пароль');
            hasError = true;
        }
        else {
            $('#account #password').removeClass('_is-error');
            $('#account #password').next('.error-message').empty();

            if (currentPassword.length < 8) {
                $('#account #password').addClass('_is-error');
                $('#account #password').next('.error-message').text('Пароль должен содержать минимум 8 символов');
                hasError = true;
            } else {
                $('#account #password').removeClass('_is-error');
                $('#account #password').next('.error-message').empty();
            }

            if (newPassword.length < 8) {
                $('#account #password_new').addClass('_is-error');
                $('#account #password_new').next('.error-message').text('Пароль должен содержать минимум 8 символов');
                hasError = true;
            } else {
                $('#account #password_new').removeClass('_is-error');
                $('#account #password_new').next('.error-message').empty();
            }

            if (confirmPassword.length < 8) {
                $('#account #password_confirm').addClass('_is-error');
                $('#account #password_confirm').next('.error-message').text('Пароль должен содержать минимум 8 символов');
                hasError = true;
            } else {
                $('#account #password_confirm').removeClass('_is-error');
                $('#account #password_confirm').next('.error-message').empty();
            }

            if (newPassword !== confirmPassword) {
                $('#account #password_confirm').addClass('_is-error');
                $('#account #password_confirm').next('.error-message').text('Пароли не совпадают');
                hasError = true;
            } else {
                $('#account #password_confirm').removeClass('_is-error');
                $('#account #password_confirm').next('.error-message').empty();
            }

        }
    }

    function setSubmitButtonState(hasError) {
        let submitButton = $('#account .account__btn');

        console.log(submitButton);
        console.log(hasError);

        if (hasError) {
            submitButton.attr('disabled', 'disabled'); // Запрещаем нажатие кнопки
        } else {
            submitButton.removeAttr('disabled'); // Удаляем атрибут disabled
        }
    }

    function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }

    const readURL = (input) => {
        if (input.files && input.files[0]) {
            const reader = new FileReader()
            reader.onload = (e) => {
                $('#preview').attr('src', e.target.result)
            }
            reader.readAsDataURL(input.files[0])
        }
    }
    $('.choose').on('change', function() {
        readURL(this)
        let i
        if ($(this).val().lastIndexOf('\\')) {
            i = $(this).val().lastIndexOf('\\') + 1
        } else {
            i = $(this).val().lastIndexOf('/') + 1
        }
        const fileName = $(this).val().slice(i)
        $('.label').text(fileName)
    })

});
