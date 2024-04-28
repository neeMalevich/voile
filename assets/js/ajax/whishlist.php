<script>

    $(document).ready(function () {
        let selectedOptions = {
            'whishlist_add': '',
            'whishlist_remove': '',
            'whishlist': <?= isset($_SESSION['user']['whishlist']) ? json_encode(array_values(array_map('intval', $_SESSION['user']['whishlist']))) : '[]' ?>,
        };

        $(document).on('click', ".product__item .whishlist, .product .product__shop-favorite", function () {
            console.log('dsss');
            const product_id = $(this).data("id");
            const isActive = $(this).hasClass("_is-active");

            if (<?= isset($_SESSION['user']) ? 'true' : 'false'; ?>) {
                const whishlistCount = parseInt($('.whishlist-count').text());

                if (isActive) {
                    $(this).removeClass("_is-active");

                    const index = selectedOptions['whishlist'] ? selectedOptions['whishlist'].indexOf(product_id) : -1;

                    if (index !== -1) {
                        selectedOptions['whishlist'].splice(index, 1);
                    }

                    selectedOptions['whishlist_remove'] = product_id;
                    selectedOptions['whishlist_add'] = '';

                    updateData(selectedOptions);

                    $('.whishlist-count').text(whishlistCount - 1); // отнимаем -1 в шапке для лайков
                    if (whishlistCount - 1 === 0) {
                        $('.whishlist-btn').removeClass('_is-active');
                    }
                } else {
                    $(this).addClass('_is-active');

                    if (!selectedOptions['whishlist']) {
                        selectedOptions['whishlist'] = [];
                    }

                    const index = selectedOptions['whishlist'].indexOf(product_id);

                    if (index === -1) {
                        selectedOptions['whishlist'].push(product_id);
                    }

                    selectedOptions['whishlist_add'] = product_id;
                    selectedOptions['whishlist_remove'] = '';

                    updateData(selectedOptions);

                    $('.whishlist-count').text(whishlistCount + 1);
                    $('.whishlist-btn').addClass('_is-active');
                }
            } else {
                $(".modal-order").addClass("show-modal-order");
            }
        });

        function updateData(dataObject) {
            console.log(dataObject);

            $.ajax({
                url: '/vendor/category/whishlist-ajax.php',
                method: 'POST',
                data: {
                    whishlist_add: dataObject.whishlist_add,
                    whishlist_remove: dataObject.whishlist_remove,
                    whishlist: Array.from(new Set(dataObject.whishlist)), // Удаление дубликатов
                },
            });
        }
    });

</script>

