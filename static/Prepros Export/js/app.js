$(document).ready(function () {
  $('.jsMobileMenuClose').click(function () {
   
    $('html').removeClass('pushed');

  });

  $('.mobile-menu').on('click', function() {
    e.stopPropagation();
    
  });

  $('.jsMobileMenuOpen').click(function (e) {
    e.preventDefault();
    e.stopPropagation();
    $('.mobile-menu').show();
    $('html').addClass('pushed');
  });


  $('html').on('click', '.visibleContent', function() {
    if ($('html').hasClass('pushed')) {
      $('html').removeClass('pushed');
    }
    
  });




  $('.jsPopupModalShow').click(function(e) {
    e.preventDefault();
    $($(this).attr('href')).show();
    $('.overlay').show();
  });

  $('.jsDropDown').click(function() {
    $(this).parent().find('.leftMenu__subMenu').slideToggle();
  });



  $(document).ready(function () {
    $(".owl-carousel").owlCarousel({
      items: 1,
      dots: true,

    });
  });

  $('.fancybox').fancybox({
    lang: 'ru',
    i18n: {
      'ru': {
        CLOSE: 'Закрыть',
        NEXT: 'Дальше',
        PREV: 'Назад',
        ERROR: 'Не удается загрузить. <br/> Попробуйте позднее.',
        PLAY_START: 'Начать слайдшоу',
        PLAY_STOP: 'Остановить слайдшоу',
        FULL_SCREEN: 'На весь экран',
        THUMBS: 'Превью'
      }
    },
    buttons: [


      'thumbs',

      //'download',
      //'zoom',
      'close'
    ],
  });

  
  // $('.jsCertForm').submit(function (e) {
  //   e.preventDefault();
  //   var that = this;
  //   $('.jsPopupModal').show();
  //   $('.overlay').show();
  //   var formData = new FormData(this);
  //   $.ajax({
  //     method: "POST",
  //     url: "/ajax/cert-form.php",
  //     data: formData,
  //     processData: false,
  //     contentType: false,
  //   })
  //     .done(function (msg) {
  //       $('.jsPopupModal').show();
  //       $('.overlay').show();

  //     });
  // });


  $('.jsModalClose, .overlay').click(function () {
    $('.jsPopupModal').hide();
    $('.overlay').hide();

  });
});
