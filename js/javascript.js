$('.portfolio-logo').bind('mouseenter mouseleave', function() {
    $(this).find('.bloc1').toggleClass('hidden-img');
});

$(window).load(function() {
  $('.flexslider').flexslider({
    animation: "slide"
  });
});

