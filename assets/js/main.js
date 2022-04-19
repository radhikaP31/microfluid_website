!(function($) {
  "use strict";

  // Smooth scroll for the navigation menu and links with .scrollto classes
  var scrolltoOffset = $('#header').outerHeight() - 2;
  $(document).on('click', '.nav-menu a, .mobile-nav a, .scrollto', function(e) {
    if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
      var target = $(this.hash);
      if (target.length) {
        e.preventDefault();

        var scrollto = target.offset().top - scrolltoOffset;

        if ($(this).attr("href") == '#header') {
          scrollto = 0;
        }

        $('html, body').animate({
          scrollTop: scrollto
        }, 1500, 'easeInOutExpo');

        if ($(this).parents('.nav-menu, .mobile-nav').length) {
          $('.nav-menu .active, .mobile-nav .active').removeClass('active');
          $(this).closest('li').addClass('active');
        }

        if ($('body').hasClass('mobile-nav-active')) {
          $('body').removeClass('mobile-nav-active');
          $('.mobile-nav-toggle i').toggleClass('icofont-navigation-menu icofont-close');
          $('.mobile-nav-overly').fadeOut();
        }
        return false;
      }
    }
  });

  // Activate smooth scroll on page load with hash links in the url
  $(document).ready(function() {
    if (window.location.hash) {
      var initial_nav = window.location.hash;
      if ($(initial_nav).length) {
        var scrollto = $(initial_nav).offset().top - scrolltoOffset;
        $('html, body').animate({
          scrollTop: scrollto
        }, 1500, 'easeInOutExpo');
      }
    }
  });

  // Mobile Navigation
  if ($('.nav-menu').length) {
    var $mobile_nav = $('.nav-menu').clone().prop({
      class: 'mobile-nav d-lg-none'
    });
    $('body').append($mobile_nav);
    $('body').prepend('<button type="button" class="mobile-nav-toggle d-lg-none"><i class="icofont-navigation-menu"></i></button>');
    $('body').append('<div class="mobile-nav-overly"></div>');

    $(document).on('click', '.mobile-nav-toggle', function(e) {
      $('body').toggleClass('mobile-nav-active');
      $('.mobile-nav-toggle i').toggleClass('icofont-navigation-menu icofont-close');
      $('.mobile-nav-overly').toggle();
    });

    $(document).on('click', '.mobile-nav .drop-down > a', function(e) {
      e.preventDefault();
      $(this).next().slideToggle(300);
      $(this).parent().toggleClass('active');
    });

    $(document).click(function(e) {
      var container = $(".mobile-nav, .mobile-nav-toggle");
      if (!container.is(e.target) && container.has(e.target).length === 0) {
        if ($('body').hasClass('mobile-nav-active')) {
          $('body').removeClass('mobile-nav-active');
          $('.mobile-nav-toggle i').toggleClass('icofont-navigation-menu icofont-close');
          $('.mobile-nav-overly').fadeOut();
        }
      }
    });
  } else if ($(".mobile-nav, .mobile-nav-toggle").length) {
    $(".mobile-nav, .mobile-nav-toggle").hide();
  }

  // Intro carousel
  var heroCarousel = $("#heroCarousel");
  var heroCarouselIndicators = $("#hero-carousel-indicators");
  heroCarousel.find(".carousel-inner").children(".carousel-item").each(function(index) {
    (index === 0) ?
    heroCarouselIndicators.append("<li data-target='#heroCarousel' data-slide-to='" + index + "' class='active'></li>"):
      heroCarouselIndicators.append("<li data-target='#heroCarousel' data-slide-to='" + index + "'></li>");
  });

  heroCarousel.on('slid.bs.carousel', function(e) {
    $(this).find('.carousel-content ').addClass('animate__animated animate__fadeInDown');
  });

  // Back to top button
  $(window).scroll(function() {
    if ($(this).scrollTop() > 100) {
      $('.back-to-top').fadeIn('slow');
    } else {
      $('.back-to-top').fadeOut('slow');
    }
  });

  $('.back-to-top').click(function() {
    $('html, body').animate({
      scrollTop: 0
    }, 1500, 'easeInOutExpo');
    return false;
  });

  // Porfolio isotope and filter
  $(window).on('load', function() {
    var portfolioIsotope = $('.portfolio-container').isotope({
      itemSelector: '.portfolio-item'
    });

    $('#portfolio-flters li').on('click', function() {
      $("#portfolio-flters li").removeClass('filter-active');
      $(this).addClass('filter-active');

      portfolioIsotope.isotope({
        filter: $(this).data('filter')
      });
      aos_init();
    });

    // Initiate venobox (lightbox feature used in portofilo)
    $(document).ready(function() {
      $('.venobox').venobox();
    });
  });

  // Skills section
  $('.skills-content').waypoint(function() {
    $('.progress .progress-bar').each(function() {
      $(this).css("width", $(this).attr("aria-valuenow") + '%');
    });
  }, {
    offset: '80%'
  });

  // Portfolio details carousel
  $(".portfolio-details-carousel").owlCarousel({
    autoplay: true,
    dots: true,
    loop: true,
    items: 1
  });

  // Init AOS
  function aos_init() {
    AOS.init({
      duration: 1000,
      once: true
    });
  }
  $(window).on('load', function() {
    aos_init();
  });


$('.client-container').slick({
  dots: true,
  infinite: false,
  speed: 300,
  slidesToShow: 4,
  slidesToScroll: 4,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});

//Set height for div
var height =  $('.fixed-top').outerHeight();
$('.header_space').css('height',height+'px');

//set height of breadcrumb opacity div
var opacity_height =  $('.breadcrumbs').outerHeight();
$('.opacity-breadcrumbs').css('height',opacity_height+'px');

//height of about us opacity banner
$('.banner-opacity').height($('.about-us-banner').height());

/*//about us page js start old
//$( ".about-us-blocks div:first-child" ).css( "display", "inline" );
$( ".about-us-blocks div:first-child" ).removeAttr("style");

$(".about-us-nav li:first").addClass("active");
//$( ".about-us-blocks" ).first().css( "background-color", "red" );
jQuery('.block-filter').click(function(){
    jQuery('.block-filter').removeClass('active');
    jQuery(this).addClass('active');
    let type = jQuery(this).data('block_type');
    console.log('.block-type-'+type);
    jQuery('.block-type').hide();
    jQuery('.block-type-'+type).show();

});
//about us page js end old */

//about us page js start
//$( ".about-us-blocks div:first-child" ).css( "display", "inline" );
$( ".about-us-blocks div:first-child" ).removeAttr("style");

$(".about-list-group a:first").addClass("active");
jQuery('.block-filter').click(function(){
    jQuery('.block-filter').removeClass('active');
    jQuery(this).addClass('active');
    let type = jQuery(this).data('block_type');
    jQuery('.block-type').hide();
    jQuery('.block-type-'+type).show();

});
//about us page js end

//products page js start

$(".product-list-group a:first").addClass("active");
jQuery('.product-cat').click(function(){
    jQuery('.product-cat').removeClass('active');
    jQuery(this).addClass('active');
    let type = jQuery(this).data('sc_cat');
    //console.log('.product-cat-filter-'+type);
    jQuery('.product-cat-filter').hide();
    jQuery('.product-cat-filter-'+type).show();

});
//tab is selected and redirect to the category
$('.product-list-group-item').on('click', function(e) {
    // Save value in localstorage
    localStorage.setItem("activeTab", $(e.target).attr('href'));
    localStorage.setItem('productCatCD', $(e.target).attr('data-sc_cat'));
 });
// get value of localstorage
var activeTab = localStorage.getItem('activeTab');
var productCatCD = localStorage.getItem('productCatCD');
if(activeTab){
  //if value is store in local storage then active tab and show product tab
    $('.product-list-group a[href="' + activeTab + '"]').tab('show');
    $(".product-cat-filter-"+productCatCD).css("display","block");
}

//products page js end

//product page js start
let slideIndex = 1;
showSlides(slideIndex);

$('.prev-product-img,.next-product-img').click(function() {
  showSlides(slideIndex += jQuery(this).data('slide_count'));
});

$('.product-cursor').click(function() {
  showSlides(slideIndex = jQuery(this).data('slide'));
});

function showSlides(n) {
  let i;
  let slides = document.getElementsByClassName("my-product-slides");
  let dots = document.getElementsByClassName("product-image");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
}
//product page js end

window.onscroll = function() {myFunction()};

var header = document.getElementById("myHeader");
var sticky = header.offsetTop;

function myFunction() {
  if (window.pageYOffset > sticky) {
    header.classList.add("sticky");
    
  } else {
    header.classList.remove("sticky");
  }
}

})(jQuery);