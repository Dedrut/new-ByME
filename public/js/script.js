$(document).ready(function () {
    const swiper = new Swiper('.swiper-baju', {
        speed: 400,

        pagination:{
            el: '.swiper-pagination',
            type: 'bullets',
            clickable: true,
            dynamicBullets: true,
            enabled: false,
        },

        autoplay:{
            delay: 4000,
            disableOnInteraction: false,
        },

        breakpoints: {
            // when window width is >= 320px
            320: {
              pagination:{
                enabled: false,
              },
            },
            // when window width is >= 480px
            480: {
                pagination:{
                    enabled: true,
                  },
            },
        }
    });
});