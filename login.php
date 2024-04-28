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
                <h1 class="tac">Войти</h1>

                <form class="account">
                    <div class="alert-danger"></div>

                    <label for="email">E-mail</label>
                    <input type="email" placeholder="E-mail" id="email" name="email" required="">
                    <div class="error-message"></div>

                    <label for="password">Пароль</label>
                    <input type="password" placeholder="Пароль" id="password" name="password" required="">
                    <div class="error-message"></div>

                    <div class="account__btn login__btn">
                        <button id="account-login" class="btn" type="submit">
                            Войти
                        </button>
                    </div>

                    <a class="account__register" href="/register.php">Нет аккаунта? зарегистрируйтесь</a>
                </form>

            </div>
        </div>
    </section>

    <script src="/assets/js/ajax/authorization.js"></script>

<?php require_once __DIR__ . '/vendor/components/footer.php'; ?>