
$(document).ready(function(){
    $('.oks-faqs-item .faqs-content').hide();
    $('.fasq-header').click(function(){
        $('.oks-faqs-wrap .col-sm-6:first-child .fasq-header').find('.toggle-icon').text('-');
        $(this).next('.faqs-content').slideToggle();
        $(this).find('.toggle-icon').text(function(_, oldText) {
            return oldText === '+' ? '-' : '+';
        });
    });
});
$(document).ready(function() {
    AOS.init();
        if (window.innerWidth <= 1000 ) {
          var elements = document.querySelectorAll('[data-aos]');
          elements.forEach(function(element) {
            element.removeAttribute('data-aos');
          });
        }
  });

// slideToggle menu
$(document).ready(function() {
      var $mobileMenuToggle = $('.menu-toggle');
      var $navList = $('.oks-primary-menu');

      $mobileMenuToggle.on('click', function() {
        $('.menu-toggle').toggleClass('active');
        $navList.slideToggle();
      });

       $('.oks-primary-menu ul li .oks-submenu-container i').on('click', function(e) {
        if ($(window).width() <= 768) { // Check if it's a mobile view
          e.preventDefault();
          var $clickedSubmenuContainer = $(this).closest('.oks-submenu-container');
            $('.oks-submenu-container').not($clickedSubmenuContainer).find('ul').removeClass('active');

            $clickedSubmenuContainer.find('ul').toggleClass('active');
        e.stopPropagation();
        }
      });

  $('.oks-show-more-btn').on('click', function() {
      // $('.oks-show-more-btn').toggleClass('show');
      // $('.resultcard_expanded').toggleClass('show');
      // $('.dashboard-board').toggleClass('show');
      console.log('yes');
    });

   $('.oks-filte-btn').on('click', function() {
      $('.oks-dis-filter-main-div-left').show();
    });
   $('.mobile-close-popup').on('click', function() {
      $('.oks-dis-filter-main-div-left').hide();
    });
});

$(document).ready(function(){

    $('.oks-gender label').click(function(){ 
        $('label').removeClass('checked'); 
        $(this).addClass('checked');
    });

});

// signup form setup
$(document).ready(function(){
    $('.sing-term-opt').hide();
    $('#oks-first-btn').click(function(){ 
        $('.oks-sign-first-form').hide();
        $('.oks-sign-up-second-form').show();
    });
    $('#oks-second-btn').click(function(){ 
        $('.oks-sign-up-second-form').hide();
        $('.oks-sign-up-third-form').show();
    });
    $('#oks-third-btn').click(function(){ 
        $('.oks-sign-up-third-form').hide();
        $('.sign-num').hide();
        $('.sing-term-opt').show();
        $('.oks-sign-up-fourth-form').show();
    });
});


// book consultant
$(document).ready(function () {

    $('#select-drop-down-option').change(function () {
        if ($(this).val() !== "") {
            $('#dateAndTimeGroup').show();
            $('#select-drop-down-option-group').hide();
            $('#book-progressbar li:nth-child(2)').addClass('active');
        } else {
            $('#dateAndTimeGroup').hide();
            $('#select-drop-down-option-group').show();
        }
    });

    $('.book-buttons .next-btn').on('click', function() {
        $('#dateAndTimeGroup').hide();
        $('#help-required-specific').show();
        $('#book-progressbar li:nth-child(3)').addClass('active');
    });

    $('.book-buttons .previous-btn').on('click', function() {
        $('#dateAndTimeGroup').hide();
        $('#select-drop-down-option-group').show();
        $('#book-progressbar li:nth-child(2)').removeClass('active');
    });
    $('.previous-btn-last').on('click', function() {
        $('#help-required-specific').hide();
        $('#dateAndTimeGroup').show();
        $('#book-progressbar li:nth-child(3)').removeClass('active');
    });

    $('.eks-login-discover').hide();
    $('.oks-wishlist-icon .ekas-login').on('click', function(e){
        e.preventDefault();
        $(this).next('.eks-login-discover').show();
    });
    $('.eks-login-discover i').on('click', function(){
        $('.eks-login-discover').hide();
    });
    $(document).mouseup(function(e) {
        var popup = $('.eks-login-discover');
        if (!popup.is(e.target) && popup.has(e.target).length === 0) {
            popup.hide();
        }
    });
});

var currentStep = 1; // track the current step

$(".next").click(function(){
    var currentStepDiv = $("#step-" + currentStep);
    var nextStepDiv = $("#step-" + (currentStep + 1));

    $("#step-number").text(currentStep + 1);

    // $("#progressbar li").eq(currentStep - 1).removeClass("active");
    $("#progressbar li").eq(currentStep).addClass("active");

    // nextStepDiv.removeClass('hidden'); 
    currentStepDiv.animate({opacity: 0}, {
        step: function(now, mx) {
            currentStepDiv.css({
                'left': ((1 - now) * 50) + "%",
                'position': 'absolute'
            });
            nextStepDiv.css({'left': (now * 50) + "%", 'opacity': 1 - now});
        }, 
        duration: 800, 
        complete: function(){
            currentStepDiv.hide();
        }, 
        easing: 'easeInOutBack'
    });

    currentStep++; // Move to the next step
});

$('.oks-login-user-menu .menu-toggle').on('click', function(){
    $('.oks-primary-menu-login').toggleClass('toggle');
});

$('.oks-user-log-info ul .oks-user-login .my-pages').on('click', function(e){
    e.preventDefault();
    $('.mypages-container').toggleClass('toggle');
});
$(document).mouseup(function(e) {
    var popup = $('.mypages-container');
    if (!popup.is(e.target) && popup.has(e.target).length === 0) {
        popup.removeClass('toggle');
    }
});

$(document).ready(function () {
  const handle = $('#handle');
  let isDragging = false;

  handle.on('mousedown', function (e) {
    isDragging = true;
    handle.css('cursor', 'grabbing');
  });

  $(document).on('mouseup', function () {
    if (isDragging) {
      isDragging = false;
      handle.css('cursor', 'grab');
    }
  });

  $(document).on('mousemove', function (e) {
    if (!isDragging) return;

    const filter = $('.price-filter');
    const handleBounds = handle[0].getBoundingClientRect();
    const filterBounds = filter[0].getBoundingClientRect();

    let newPosition = e.clientX - filterBounds.left - handleBounds.width / 2;

    if (newPosition < 0) {
      newPosition = 0;
    } else if (newPosition > filterBounds.width - handleBounds.width) {
      newPosition = filterBounds.width - handleBounds.width;
    }

    handle.css('left', `${newPosition}px`);

    // Calculate and update the price range based on the handle's position
    const percentage = newPosition / (filterBounds.width - handleBounds.width);
    const minPrice = 10; // Adjust the minimum price as needed
    const maxPrice = 1000; // Adjust the maximum price as needed

    const selectedMinPrice = Math.round(minPrice + percentage * (maxPrice - minPrice));
    const selectedMaxPrice = selectedMinPrice + 50; // Adjust the range as needed

    console.log(`Selected Price Range: ${selectedMinPrice} - ${selectedMaxPrice}`);
  });

  handle.on('dragstart', function (e) {
    e.preventDefault();
  });
});

$(document).ready(function(){
    $('.oks-main-content').hide();
    $('.oks-team-member').on('click', function(){
        var memberPopup = $(this).find('.oks-main-content');
        memberPopup.show();
        memberPopup.show().toggleClass('active');
    });
    $(document).on('click', '.oks-popup-cross-btn', function(){
      $(this).closest('.oks-main-content').removeClass('active').hide();
    });

     $(document).mouseup(function(e) {
            var popup = $('.oks-main-content');
            if (!popup.is(e.target) && popup.has(e.target).length === 0) {
                popup.hide();
            }
        });
});

$(document).ready(function() {
  var header = $('.main-header');
  var headerHeight = header.outerHeight();
  
  $(window).scroll(function() {
    if ($(window).scrollTop() > headerHeight) {
      header.addClass('sticky');
    } else {
      header.removeClass('sticky');
    }
  });
});


 // Explore pages
$(document).ready(function () {
    // Function to check viewport width
    function isMobile() {
        return window.innerWidth <= 767; // Adjust the threshold based on your design
    }

    // Add accordion-item class for mobile views
    if (isMobile()) {
        $(".oks-austria-sec-content").addClass("accordion-item");
    }

    // Initially hide all accordion items
    $(".accordion-item p").hide();
    // $('.accordion-item h3').addClass('active');
    // Add click event to toggle visibility
    $(".accordion-item h3").click(function () {
        $(this).toggleClass('active');
        $(this).next(".oks-content-box p").slideToggle();
    });


      $(document).ready(function() {
        $('.oks-uni-popup').hide();
        $(document).on('click', '.oks-uni-btn .open-popup', function(e) {
            e.preventDefault();
            $(this).next('.oks-uni-popup').show();
        });

        // Hide popup when "x" button is clicked
        $('.oks-uni-popup-btn').click(function() {
            $(this).closest('.oks-uni-popup').hide();
        });

        // Hide popup when any space of the page is clicked
        $(document).mouseup(function(e) {
            var popup = $('.oks-uni-popup');
            if (!popup.is(e.target) && popup.has(e.target).length === 0) {
                popup.hide();
            }
        });
    });
});

jQuery('.oks-blog-video').owlCarousel({
                loop:true,
                nav: true,
                dots: true,
                items:3,
                margin: 24,
                border:0,
                padding:0,
                autoplay:true,   
                smartSpeed: 1000, 
                autoplayTimeout:5000,
                autoplayHoverPause:true,
                responsive: {

                      0:{
                          items:1,
                          nav: false
                      },
                      576:{
                          items:1,
                          nav: false
                      },
                      768:{
                          items:1,
                          nav: false
                      },
                      992:{
                          items:3,
                           nav: true,
                           dots: true,
                      }
                }
       });

jQuery('.oks-testimonial-slider').owlCarousel({
        loop:true,
        nav: true,
        dots: true,
        items:3,
        margin: 24,
        border:0,
        padding:0,
        autoplay:true,   
        smartSpeed: 1000, 
        autoplayTimeout:5000,
        autoplayHoverPause:true,
        responsive: {

              0:{
                  items:1,
                  nav: false
              },
              576:{
                  items:1,
                  nav: false
              },
              768:{
                  items:1
              },
              992:{
                  items:3,
                   nav: true,
                   dots: true,
              }
        }
});
$(document).ready(function() {
    $('#tab1').show();
    $('.oks-tabs-item[data-tab="tab1"]').addClass('current-tab');
    $('.oks-tabs-item').on('click', function() {
        $('.oks-tabs-item').removeClass('current-tab');
      var tabId = $(this).data('tab');

      // Hide all tabs
      $('.oks-dashboad-wrap').hide();

      // Show the selected tab
      $('#' + tabId).show();
      
       $(this).addClass('current-tab');
    });
});

$(document).ready(function () {
  const handle = $('#handle');
  let isDragging = false;

  handle.on('mousedown', function (e) {
    isDragging = true;
    handle.css('cursor', 'grabbing');
  });

  $(document).on('mouseup', function () {
    if (isDragging) {
      isDragging = false;
      handle.css('cursor', 'grab');
    }
  });

  $(document).on('mousemove', function (e) {
    if (!isDragging) return;

    const filter = $('.price-filter');
    const handleBounds = handle[0].getBoundingClientRect();
    const filterBounds = filter[0].getBoundingClientRect();

    let newPosition = e.clientX - filterBounds.left - handleBounds.width / 2;

    if (newPosition < 0) {
      newPosition = 0;
    } else if (newPosition > filterBounds.width - handleBounds.width) {
      newPosition = filterBounds.width - handleBounds.width;
    }

    handle.css('left', `${newPosition}px`);

    // Calculate and update the price range based on the handle's position
    const percentage = newPosition / (filterBounds.width - handleBounds.width);
    const minPrice = 10; // Adjust the minimum price as needed
    const maxPrice = 1000; // Adjust the maximum price as needed

    const selectedMinPrice = Math.round(minPrice + percentage * (maxPrice - minPrice));
    const selectedMaxPrice = selectedMinPrice + 50; // Adjust the range as needed

    console.log(`Selected Price Range: ${selectedMinPrice} - ${selectedMaxPrice}`);
  });

  handle.on('dragstart', function (e) {
    e.preventDefault();
  });
});

$(document).ready(function() {
    $(".tab-content.support").hide();
    $('.oks-dashboad-btn #oks-dashboard-tab1').addClass('active');
    $(".oks-dashboad-btn #oks-dashboard-tab1").click(function() {
        $(this).addClass('active');
        $('.oks-dashboad-btn #oks-dashboard-tab2').removeClass('active');
        $(".tab-content.oks-course-item-wrap").show();
        $(".tab-content.support").hide();
    });
    $(".oks-dashboad-btn #oks-dashboard-tab2").click(function() {
        $(this).addClass('active');
        $('.oks-dashboad-btn #oks-dashboard-tab1').removeClass('active');
        $(".tab-content.oks-course-item-wrap").hide();
        $(".tab-content.support").show();
    });
});

