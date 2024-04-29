<script>
    $(document).ready(function () {

        let selectedOptionsCard = {
            'cart_add': '',
            'cart_remove': '',
            'cart_count': '',
            'cart_count_header': <?= isset($_SESSION['user']['cart_count_header']) ? json_encode(array_values(array_map('intval', $_SESSION['user']['cart_count_header']))) : '[]' ?>,
        };

        $(document).on('click', '.product .card', function () {
            const product_id = $(this).parents('.product__shop').data('id');
            const user_id = $(this).parents('.product__shop').data('user_id');
            const isActive = $(this).hasClass("_is-active");

            if (user_id){
                const basketCount = parseInt($('.basket-count').text());

                if (isActive) {
                    $(this).removeClass("_is-active");

                    const index = selectedOptionsCard['cart_count_header'] ? selectedOptionsCard['cart_count_header'].indexOf(product_id) : -1;

                    if (index !== -1) {
                        selectedOptionsCard['cart_count_header'].splice(index, 1);
                    }

                    selectedOptionsCard['cart_remove'] = product_id;
                    selectedOptionsCard['cart_add'] = '';

                    updateDataCart(selectedOptionsCard);

                    $('.basket-count').text(basketCount - 1); // отнимаем -1 в шапке для лайков
                    if (basketCount - 1 === 0) {
                        $('.basket-btn').removeClass('_is-active');
                    }

                } else {
                    $(this).addClass('_is-active');

                    if (!selectedOptionsCard['cart_count_header']) {
                        selectedOptionsCard['cart_count_header'] = [];
                    }

                    const index = selectedOptionsCard['cart_count_header'].indexOf(product_id);

                    if (index === -1) {
                        selectedOptionsCard['cart_count_header'].push(product_id);
                    }

                    if (!$('#errorAlert').hasClass('_is-active')) {
                        alertAddCart();
                    }

                    // if (!selectedOptionsCard['cart_count_header'].includes(product_id)) {
                    //     $('.basket-count').text(basketCount + 1);
                    //     selectedOptionsCard['cart_count_header'].push(product_id);
                    // }

                    selectedOptionsCard['cart_add'] = product_id;
                    selectedOptionsCard['cart_remove'] = '';

                    updateDataCart(selectedOptionsCard);

                    $('.basket-count').text(basketCount + 1);
                    $('.basket-btn').addClass('_is-active');
                }
            } else {
                $(".modal-order").addClass("show-modal-order");
            }

        });

        function alertAddCart() {
            let errorAlert = $(`
            <div class="error-alert" id="errorAlert">
                <div class="error-alert__icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" viewBox="0 0 24 24" height="24" fill="none">
                        <path fill="#393a37" d="m13 13h-2v-6h2zm0 4h-2v-2h2zm-1-15c-1.3132 0-2.61358.25866-3.82683.7612-1.21326.50255-2.31565 1.23915-3.24424 2.16773-1.87536 1.87537-2.92893 4.41891-2.92893 7.07107 0 2.6522 1.05357 5.1957 2.92893 7.0711.92859.9286 2.03098 1.6651 3.24424 2.1677 1.21325.5025 2.51363.7612 3.82683.7612 2.6522 0 5.1957-1.0536 7.0711-2.9289 1.8753-1.8754 2.9289-4.4189 2.9289-7.0711 0-1.3132-.2587-2.61358-.7612-3.82683-.5026-1.21326-1.2391-2.31565-2.1677-3.24424-.9286-.92858-2.031-1.66518-3.2443-2.16773-1.2132-.50254-2.5136-.7612-3.8268-.7612z"></path>
                    </svg>
                </div>
                <div class="error-alert__title">Товар успешно добавлен</div>
                <div class="error-alert__close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 20 20" height="20">
                        <path fill="#393a37" d="m15.8333 5.34166-1.175-1.175-4.6583 4.65834-4.65833-4.65834-1.175 1.175 4.65833 4.65834-4.65833 4.6583 1.175 1.175 4.65833-4.6583 4.6583 4.6583 1.175-1.175-4.6583-4.6583z"></path>
                    </svg>
                </div>
            </div>
        `);

            $('body').append(errorAlert);
            errorAlert.addClass('_is-active');

            setTimeout(function() {
                errorAlert.removeClass('_is-active');
                setTimeout(function() {
                    errorAlert.remove();
                }, 300);
            }, 1200);
        }

        function updateTotalPrice() {
            let totalFullPrice = 0;

            $('.quantity_inner').each(function () {
                let $input = $(this).find('.quantity');
                let quantity = parseInt($input.val());
                let price = parseFloat($input.closest('.quantity_inner').data('start-pice'));
                let totalPrice = quantity * price;
                $(this).closest('.basket__item').find('.card__price').text(totalPrice.toFixed(2) + ' руб');

                totalFullPrice += totalPrice;
            });

            $('.basket__full-price span').text(totalFullPrice.toFixed(2) + ' руб');
        }

        function minusButtonClick() {
            let $input = $(this).parent().find('.quantity');
            let count = parseInt($input.val()) - 1;
            count = count < 1 ? 1 : count;
            $input.val(count);

            let $card = $(this).closest('.card');
            let productId = $card.find('.quantity_inner').data('id');

            selectedOptionsCard.cart_add = productId;
            selectedOptionsCard.cart_count = count;

            updateTotalPrice();
            updateDataCart(selectedOptionsCard);
        }

        function plusButtonClick() {
            let $input = $(this).parent().find('.quantity');
            let count = parseInt($input.val()) + 1;
            count = count > parseInt($input.data('max-count')) ? parseInt($input.data('max-count')) : count;
            $input.val(count);

            let $card = $(this).closest('.card');
            let productId = $card.find('.quantity_inner').data('id');

            selectedOptionsCard.cart_add = productId;
            selectedOptionsCard.cart_count = count;

            updateTotalPrice();
            updateDataCart(selectedOptionsCard);
        }

        function quantityChange() {
            if (this.value.match(/[^0-9]/g)) {
                this.value = this.value.replace(/[^0-9]/g, '');
            }
            if (this.value == "") {
                this.value = 1;
            }
            if (this.value > parseInt($(this).data('max-count'))) {
                this.value = parseInt($(this).data('max-count'));
            }

            let $card = $(this).closest('.card');
            let productId = $card.find('.quantity_inner').data('id');
            let count = parseInt($(this).val());

            selectedOptionsCard.cart_add = productId;
            selectedOptionsCard.cart_count = count;

            updateTotalPrice();
            updateDataCart(selectedOptionsCard);
        }

        function removeButtonClick() {
            let totalFullPrice = 0;
            let $card = $(this).closest('.card');
            let price = parseFloat($card.find('.card__price').data('price'));
            let quantity = parseInt($card.find('.quantity').val());
            let totalPrice = price * quantity;
            totalFullPrice -= totalPrice;
            $card.remove();

            updateTotalPrice();

            const basketCount = parseInt($('.basket-count').text());
            $('.basket-count').text(basketCount - 1); // отнимаем -1 в шапке для лайков
            if (basketCount - 1 === 0) {
                $('.basket-btn').removeClass('_is-active');
            }

            let productId = $card.find('.quantity_inner').data('id');

            selectedOptionsCard.cart_remove = productId;
            selectedOptionsCard.cart_count = quantity;

            updateDataCart(selectedOptionsCard);

            let $cartItems = $('.basket__inner .card');
            if ($cartItems.length === 0) {
                let $cartEmpty = $('<div class="sidebar__top tac">Нет товаров</div>');

                $('.basket__wrapper').append($cartEmpty).addClass('_is-active');
            }
        }


        $('.quantity_inner .bt_minus').click(minusButtonClick);
        $('.quantity_inner .bt_plus').click(plusButtonClick);
        $('.quantity_inner .quantity').bind("change keyup input", quantityChange);
        $('.basket__del').click(removeButtonClick);


        function updateDataCart(dataObject) {
            console.log(dataObject);

            $.ajax({
                url: '/vendor/cart/cart-ajax.php',
                method: 'POST',
                data: {
                    cart_add: dataObject.cart_add,
                    cart_remove: dataObject.cart_remove,
                    cart_count: dataObject.cart_count,
                    cart_count_header: dataObject.cart_count_header,
                },
            });
        }

        updateTotalPrice();


    });
</script>