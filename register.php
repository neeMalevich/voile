<?php
session_start();

if (isset($_SESSION['user'])) {
    header('Location: /profile.php');
    exit;
}
?>

    <?php require_once __DIR__ . '/vendor/components/header.php'; ?>

    <section class="login">
        <div class="container">
            <div class="login__inner">
                <h1 class="tac">Зарегистрироваться</h1>

                <form id="form-register" class="account">
                    <label for="username">Имя</label>
                    <input type="text" placeholder="Имя" id="username" name="username" required="">
                    <div class="error-message"></div>

                    <label for="email">E-mail</label>
                    <input type="email" placeholder="E-mail" id="email" name="email" required="">
                    <div class="error-message"></div>

                    <label for="password">Пароль</label>
                    <input type="password" placeholder="Пароль" id="password" name="password" required="">
                    <div class="error-message"></div>

                    <label for="password_confirm">Повторите пароль</label>
                    <input type="password" placeholder="Повторите пароль" id="password_confirm" name="password_confirm"
                        required="">
                    <div class="error-message"></div>

                    <div class="account__btn">
                        <button id="account-register" class="btn" type="submit">
                            Регистрация
                        </button>
                    </div>

                    <a class="account__register" href="/login.php">У меня уже есть аккаунт</a>
                </form>

            </div>
        </div>
    </section>

    <script src="/assets/js/ajax/register.js"></script>

<?php require_once __DIR__ . '/vendor/components/footer.php'; ?>