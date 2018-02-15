(function ($) {

  if (typeof Drupal != 'undefined') {
    Drupal.behaviors.midWest = {
      attach: function (context, settings) {
        init();
      },

      completedCallback: function () {
        // Do nothing. But it's here in case other modules/themes want to override it.
      }
    }
  }

  $(function () {
    if (typeof Drupal == 'undefined') {
      init();
    }

    $(window).load(function () {
      if ($(window).outerWidth() > 767) {
        initFancyBox();
      } else {
        $('.gallery-list a').on('click touch', function (e) {
          e.preventDefault();
        })
        initGalleryActive()
      }
    });
  });

  function init() {
    initFlexslider();
    initColumDivision();
    initFlexsliderone();
    initFormStyler();
    initMenuBtn();
    initvideoClick();

  }

  function initFlexslider() {
    $('#flexSlide').flexslider({
      animationLoop: false,
      prevText: "",
      nextText: ""
    });
  }

  function initGalleryActive() {
    var $elem = $('.gallery-list li');

    $elem.on('click touch', function () {

      if ($(this).hasClass('active')) {
        $elem.removeClass('active');
      } else {
        $elem.removeClass('active');
        $(this).addClass('active')
      }
    })
  }

  function initMenuBtn() {
    var $btn = $('.site-header .btn-menu'),
      $nav = $('.site-header .nav');

    $btn.on('click touch', function () {

      if ($btn.hasClass('active')) {
        $btn.removeClass('active');
        $nav.hide();
      } else {
        $btn.addClass('active');
        $nav.show();
      }

    })
  }

  function initFlexsliderone() {
    $('#carousel').flexslider({
      animation: "slide",
      controlNav: false,
      animationLoop: false,
      slideshow: false,
      itemWidth: 500,
      asNavFor: '#slider',
      directionNav: false
    });

    $('#slider').flexslider({
      animation: "slide",
      controlNav: false,
      animationLoop: false,
      slideshow: false,
      sync: "#carousel"
    });
  }

  function initFormStyler() {
    $('.content-wrapper select').styler({
      selectPlaceholder: 'Select...'
    });
  }

  function initColumDivision() {
    var $menu = $('.col-two').find('.col1');

    $menu.each(function () {
      var $this = $(this),
        $ul = $this.find('ul.client-list'),
        $items = $this.find('li'),
        $index = Math.round($items.length / 2);

      $this.append('<div class="clearfix">' +
      '<div class="first-col"><ul></ul></div>' +
      '<div class="last-col"><ul></ul></div>' +
      '</div>');

      var $firstCol = $this.find('.first-col ul'),
        $lastCol = $this.find('.last-col ul');

      for (var i = 0; i < $items.length; i++) {
        if (i < $index) {
          $firstCol.append('<li class="dontsplit">' + $items.eq(i).html() + '</li>');
        } else {
          $lastCol.append('<li class="dontsplit">' + $items.eq(i).html() + '</li>');
        }
      }

      $ul.hide();
    })

  }

  function initvideoClick() {
    var $btn = $('.page-home .img-slider'),
      $video = $('.page-home video');

    console.log($video);
    $btn.on('click touch', function () {
      $(this).hide();
      $video.show();
      $video.get(0).play();
    })
  }

  function initFancyBox() {
    $(".fancybox").fancybox({
      openEffect: 'none',
      closeEffect: 'none'
    });
  }

})(jQuery);