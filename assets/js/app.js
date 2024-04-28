document.addEventListener('DOMContentLoaded', () => {

    // каталог сайдбар и чекбоксы
    document.querySelectorAll('.accordion-item h2').forEach((accordionToggle) => {
        accordionToggle.addEventListener('click', () => {
            const accordionItem = accordionToggle.parentNode;
            const accordionContent = accordionToggle.nextElementSibling;

            if (accordionContent.style.maxHeight) {
                accordionContent.style.maxHeight = null;
                accordionItem.classList.remove('active');
            } else {
                accordionContent.style.maxHeight = accordionContent.scrollHeight + 'px';
                accordionItem.classList.add('active');
            }
        });
    });

    // мобайл меню
    var arrow = document.querySelector('.dropdown-mobile-arrow__line');
    var dropdownList = document.querySelector('.dropdown-mobile-list');

    arrow.addEventListener('click', function () {
        if (arrow.classList.contains('_is-active')) {
            arrow.classList.remove('_is-active');
            dropdownList.classList.remove('_is-active');
        } else {
            arrow.classList.add('_is-active');
            dropdownList.classList.add('_is-active');
        }
    });

    // Слайдер каталога
    const swiper = new Swiper(".js-c-product-swiper", {
        slidesPerView: 3,
        spaceBetween: 30,
        loop: true,

        mousewheel: {
            releaseOnEdges: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },

        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },

        breakpoints: {
            320: {
                slidesPerView: 1,
                spaceBetween: 20,
            },
            480: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            1000: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            1200: {
                slidesPerView: 3,
                spaceBetween: 30,
            },
        },
    });

    // Слайдер bannera
    const swiperHistory = new Swiper(".js-history", {
        slidesPerView: 1,
        spaceBetween: 10,
        loop: true,

        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },

        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });

    // галерея продуктов
    const swiper5 = new Swiper(".mySwiper", {
        spaceBetween: 44,
        slidesPerView: 3,

        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
    });
    const swiper2 = new Swiper(".mySwiper2", {
        spaceBetween: 10,
        thumbs: {
            swiper: swiper5,
        },

        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
    });

    // modalka
    function modalCustomProduct() {
        let modal = document.querySelector(".modal-order");
        let trigger = document.querySelectorAll(".product-popup");
        let closeButton = document.querySelector(".close-button-order");
        let body = document.querySelector("body");

        function toggleModal(e) {
            modal.classList.toggle("show-modal-order");
            body.classList.toggle("_is-no-scroll");
        }

        function windowOnClick(event) {
            if (event.target === modal) {
                toggleModal(event);
            }
        }

        if(trigger){
            trigger.forEach(item => {
                item.addEventListener("click", toggleModal);
            });
            closeButton.addEventListener("click", toggleModal);
            window.addEventListener("click", windowOnClick);
        }
    }

    modalCustomProduct();
});