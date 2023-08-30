$(function () {
  /*console*/
  ("use strict");
  //sticky-header
  var header = $("header");
  $(window).scrollTop() >= header.height() && $(window).width() >= '480'
    ? header.addClass("sticky-header").fadeIn()
    : header.removeClass("sticky-header");
  $(window).scroll(function () {
    //if condition
    $(window).scrollTop() >= header.height() && $(window).width() >= '480'
      ? header.addClass("sticky-header").fadeIn()
      : header.removeClass("sticky-header");
  });
  /* active link */
  $("header .menuLinks li").click(function () {
    $(this).addClass("active").siblings().removeClass("active");
  });

  /* Account sub-menu */
  /* $('.after-login .account').click(function() {
    if ($(window).width() <= 991)
      $(this).toggleClass('open');
  }); */


  

// filter products
/* $('#product-filter a').click(function(){
    $(this).addClass('active').parent().siblings().find('.active').removeClass('active');
    var filterType = $(this).data('filter');
    $('.products-list .tab-pane.active').find('.card:not([data-type*="' + filterType + '"])').parent().hide();
    $('.products-list .tab-pane.active').find('.card[data-type*="' + filterType + '"]').parent().show()
}) */
// heart Button
  $(".heart-like-button").click(function(){
      $(this).parent().toggleClass("liked");
  });

  var scrollButton = $("#scrollTop");
  $(window).scroll(function(){
    if ($(this).scrollTop() > 100) {
      scrollButton.fadeIn();
    } else {
      scrollButton.fadeOut();
    }
  });

  //click to scroll top
  scrollButton.click(function () {
    $('html,body').animate({
        scrollTop: 0
    }, 500);
});

// cart number
$('.quantity').on('click', '.plus', function (e) {
  let $input = $(this).next('input.qty');
  let val = parseInt($input.val());
  $input.val(val + 1).change();
});

$('.quantity').on('click', '.minus', function (e) {
      let $input = $(this).prev('input.qty');
      var val = parseInt($input.val());
      if (val >= 1) 
          $input.val(val - 1).change();
  });

  // show and hide password
  $('.password .input-group-text').click(function(){
    var inputType = ($(this).parent().find('input').attr('type') == 'password') ?  'text' : 'password';
    $(this).parent().find('input').attr('type',inputType)
  })

  /* Insialize animation on scroll */
  function initiateAnimation() {
    AOS.init({
      delay: 200, // values from 0 to 3000, with step 50ms
      duration: 900, // values from 0 to 3000, with step 50ms
      easing: 'ease', // default easing for AOS animations
      once: true,
    });
  }
  initiateAnimation();

});
