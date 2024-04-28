<?php
require_once __DIR__ . '/vendor/components/header.php';
session_start();

if (!$_SESSION['user']) {
    header('Location: /login.php');
    exit;
}
?>

    <section class="login">
        <div class="container">
            <div class="login__inner">
                <h1 class="tac">аккаунт</h1>

                <div class="login__wrapper">
                    <div class="login__sidebar">
                        <ul>
                            <li class="active">
                                <a href="/profile.php">Контактные данные</a>
                            </li>
                            <li>
                                <a href="#">Избранное</a>
                            </li>
                            <li>
                                <a href="/vendor/auth/logout.php">Выйти</a>
                            </li>
                        </ul>
                    </div>

                    <form id="account" class="account" enctype="multipart/form-data">

                        <div class="alert-danger--wrapper"></div>

                        <label for="username">Имя</label>
                        <input type="text" placeholder="Имя" value="<?= $_SESSION['user']['username']; ?>" id="username" name="username">
                        <div class="error-message"></div>

                        <label for="email">E-mail</label>
                        <input type="email" placeholder="E-mail" value="<?= $_SESSION['user']['email']; ?>" id="email" name="email">
                        <div class="error-message"></div>

                        <label for="avatar">Изображение профиля</label>
                        <?php
                        $avatar = get_user_avatar($_SESSION['user']);
                        ?>
                        <div class="file-input">
                            <input class="choose" type="file" name="avatar" accept="image/*">
                            <span class="button">Выбрать изображение</span>
                            <span class="label">
<!--                                файл не выбран-->
                            </span>
                        </div>

                        <?php
                        if (!empty($avatar) && $avatar !== null) : ?>
                            <img class="imagess-preview" id="preview" src="<?= $avatar; ?>">
                        <?php else : ?>
                            <img class="imagess-preview" id="preview" src="">
                        <?php endif; ?>

                        <label for="password">Действующий пароль</label>
                        <input type="password" placeholder="Действующий пароль" id="password" name="password">
                        <div class="error-message"></div>

                        <label for="password_new">Новый пароль</label>
                        <input type="password" placeholder="Новый пароль" id="password_new" name="password_new">
                        <div class="error-message"></div>

                        <label for="password_confirm">Повторите новый пароль</label>
                        <input type="password" placeholder="Повторите новый пароль" id="password_confirm" name="password_confirm">
                        <div class="error-message"></div>

                        <div class="account__btn">
                            <button id="account-login" class="btn" type="submit">
                                Сохранить изменения
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </section>

    <?php if ($_SESSION['user']['register'] == 'success') : ?>
        <div class="modal-order show-modal-order">
            <div class="modal-order-content">
                <span class="close-button-order">×</span>
                <div class="modal_product_title">Пользователь успешно зарегистрирован</div>
            </div>
        </div>
    <?php endif; ?>

    <?php
    unset($_SESSION['user']['register']);
    unset($_SESSION['error_message']);
    ?>

    <script src="/assets/js/ajax/profile.js"></script>

<?php require_once __DIR__ . '/vendor/components/footer.php'; ?>