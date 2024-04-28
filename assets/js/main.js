$(document).ready(function(){
    // menu click event
    $('.menuBtn').click(function() {
      $(this).toggleClass('act');
        if($(this).hasClass('act')) {
          $('.mainMenu').addClass('act');
          $('body').addClass('_is-scroll');
        }
        else {
          $('.mainMenu').removeClass('act');
          $('body').removeClass('_is-scroll');
        }
    });

//wishlist
    $('.catalog__inner.wishlist .product__item .whishlist').on('click', function() {
        let $productItem = $(this).closest('.product__item-whishlist');
        $productItem.remove();

        let $wishlistItems = $('.catalog__inner.wishlist .product__item-whishlist');
        if ($wishlistItems.length === 0) {
            let $wishlistEmpty = $(
                '<div class="account__whislist dac">' +
                '   <img src="./assets/images/whishlist-none.png" alt="">' +
                '   <div class="account__whislist-title">Список избранного пуст</div>' +
                '   <div class="account__whislist-text">У вас пока нет товаров в списке желаний. <br>  На странице «Товары» вы найдете много интересных товаров.</div>' +
                '   <div class="account__btn">' +
                '       <a href="/catalog.php" id="account-login" class="btn">' +
                '           вернуться в магазин' +
                '       </a>' +
                '   </div>' +
                '</div>'
            );

            $('.catalog__inner.wishlist').append($wishlistEmpty).addClass('_is-active');
        }
    });
});