<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: /login.php');
    exit;
}
?>

<?php require_once __DIR__ . '/vendor/components/header.php'; ?>

    <section class="s-collection chechout-wrapper login">
        <div class="container">
            <h1 class="section-title tac">
                Оформить заказ
            </h1>


            <form id="checkout" class="account">
                <div class="alert-danger account--success">
                    Заказ оформлен
                </div>
                <div class="alert-danger"></div>

                <label for="tel">Телефон</label>
                <input type="tel" data-phone-pattern = "+375 (__) ___-__-__" placeholder="Телефон" id="order_tel" name="order_tel" required>
                <div class="error-message"></div>

                <label for="data">Дата</label>
                <input type="date" id="data" name="order_data" required>
                <div class="error-message"></div>

                <label for="time">Время</label>
                <input type="time" id="time" name="order_time" required>

                <label for="comment">Комментарий</label>
                <textarea name="comment" placeholder="Комментарий" id="comment" rows="5"></textarea>

                <div class="account__btn login__btn">
                    <button id="form-checkout" class="btn mt-55" type="submit">
                        <span>
                            Подтвердить заказ
                        </span>
                    </button>
                </div>

                <a class="account__register" href="/cart.php">Вернуться в корзину</a>
            </form>


        </div>
    </section>

    <script src="/assets/js/ajax/checkout.js"></script>

<?php require_once __DIR__ . '/vendor/components/footer.php'; ?>