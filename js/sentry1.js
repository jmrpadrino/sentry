/* Variables */
var toggle_responsive = false;

/* Smooth Scroll*/

$(function () {
    "use strict";
    $('a[href*=#]:not([href=#])').click(function () {
        
        if (location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') && location.hostname === this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            if (target.length) {
                $('html,body').animate({
                    scrollTop: target.offset().top
                }, 1000);
                return false;
            }
        }
    });
});

/*----- END SMOOTH SCROLL ------*/

// Sidebar category list behavior
//    function showchild(child){
//        $( '#parent-' + child ).show();
//    };
//    function hidechild(child){
//        $( '#parent-' + child ).hide();
//    }

$(window).on('load', function() {
    $('.children-list').each(function() {
        $(this).css('marginTop', ( ($(this).actual('outerHeight') * -1 ) - 20 )).show();
    });
});

$('.chevron-toggle').click(function(e){
    e.preventDefault();
    $(this).parents('.main-item').toggleClass('show-children');
    $(this).toggleClass('zmdi-chevron-down').toggleClass('zmdi-chevron-up');
});

//----- END SIDEBAR CATEGORY LIST BEHAVIOR

window.onload = function () {
    "use strict";
    var navbar = $("#responsive-nav");
    navbar.on('show.bs.collapse', function () {
        
        $('#responsive-nav').css('overflow', 'visible');
        $('.header-bar').css('background', '#232323');
        $('#header-logo').attr('src', 'http://' + window.location.hostname + '/wp-content/themes/Sentry/images/sentry-wellhead-systems-logo-whitebkg.png');
        $('#responsive-nav')
            .addClass('navbar-full');
        /*$('.icon-bar')
            .css('background-color', 'white');
        $('.navbar-image>img')
            .css('opacity', 0.2);
        navbar.children('ul').css('height', '100%');*/
        
        //$('<div id="search-button-nav-responsive" class="search-button-nav-responsive"><span class="fa fa-search"></span>&nbsp; SEARCH</div>').insertAfter('#menu-top_main_menu');
        
        var isMobile = !!(/Android|iPhone|iPad|iPod|BlackBerry|IEMobile|Windows Phone/i.test(navigator.userAgent));
        var ua = navigator.userAgent.toLowerCase();
        var is_safari = false;
        if (ua.indexOf('safari') !== -1 && !(ua.indexOf('chrome') > -1)) {
            is_safari = true;
        }
        if (!isMobile) {
            if (/Edge\/\d./i.test(navigator.userAgent) && window.innerWidth < 768) {
                navbar.css('margin-right', '-12px');
            } else if (/Edge\/\d./i.test(navigator.userAgent) && window.innerWidth > 767 && window.innerWidth < 992) {
                navbar.css('margin-right', '-17px');
            } else if (is_safari && window.innerWidth > 767 && window.innerWidth < 992) {
                navbar.css('margin-right', '-6px');
            } else if (is_safari) {
                navbar.css('margin-right', '0');
            } else if (window.innerWidth > 767 && window.innerWidth < 992) {
                navbar.css('margin-right', '-21px');
            } else {
                navbar.css('margin-right', '-15px');
            }
        } else {
            navbar.css('margin-right', 0);
        }
    })
        .on('hidden.bs.collapse', function () {
            $('body').css('overflow', 'auto');
            $('.header-bar').css('background','#ffffff');
            $('#header-logo').attr('src', 'http://'+ window.location.hostname +'/wp-content/themes/Sentry/images/sentry-wellhead-systems-logo.png');
        /*$('#navbar-container')
            .removeClass('navbar-full')
            .addClass('navbartransparent');
        $('.icon-bar')
            .css('background-color', '#314f6a');
        $('.navbar-image>img')
            .css('opacity', 1);
        navbar.children('ul').css('height', '75px');*/
    });
    
    // Searh mask transform
    /*var search_frame_responsive = $('#search-frame-responsive');
    var navbar_container = $('#navbar-container');
    search_frame_responsive.css('height', window.innerHeight - navbar_container.height() ) ;*/
}

// Bootstrap Clickable navbar menu item
$('li.dropdown').on('click', function () {
    "use strict";
    var $el = $(this);
    var $a = $el.children('a.dropdown-toggle');
    if ($a.length && $a.attr('href')) {
        location.href = $a.attr('href');
    }
});

(function () {
    "use strict";

    var toggles = document.querySelectorAll(".c-hamburger");

    for (var i = toggles.length - 1; i >= 0; i--) {
        var toggle = toggles[i];
        toggleHandler(toggle);
    };

    function toggleHandler(toggle) {
        toggle.addEventListener( "click", function(e) {
          e.preventDefault();
          (this.classList.contains("is-active") === true) ? this.classList.remove("is-active") : this.classList.add("is-active");
        });
    }

})();
$(window).load(function(){
  $("#stickyImage").sticky({ topSpacing: 50, bottomSpacing: 450 });
});
$(document).ready( function() {
    
    $('#stickyImage').sticky             
    
    $("#search-filters").change( function() {
         var selectedOption = this.value;
         window.location.href = selectedOption;
    });
    
    //change navbar item color
    var location = window.location.href;
    if ( location.indexOf('products') > -1 || location.indexOf('product') > -1 ){
        $("#menu-main-navigation li a[title='Products']").css('color','#ed3422');
        $("#menu-footer-navigation li a[title='Products']").css('color','white');
    }
    /*else{
        $("#menu-main-navigation li a[title='Products']").css('color','#484848');
        $("#menu-footer-navigation li a[title='Products']").css('color','rgba(255, 255, 255, 0.7)');
    }*/
    if ( location.indexOf('/services/') > -1 || location.indexOf('/service/') > -1 ){
        $("#menu-main-navigation li a[title='Services']").css('color','#ed3422');
        $("#menu-footer-navigation li a[title='Services']").css('color','white');
    }
    /*else{
        $("#menu-main-navigation li a[title='Services']").css('color','#484848');
        $("#menu-footer-navigation li a[title='Services']").css('color','rgba(255, 255, 255, 0.7)');
    }*/
    
    // Responsive navbar category list behavior
    var category_toggle = false;
    $('#navbar-responsive-list-title').click( function(){
        if(category_toggle){
            $('#responsive-category-list').removeClass('show');
            $('#responsive-category-list').addClass('hide');
            $('#navbar-responsive-list-title span').removeClass('fa-chevron-up');
            $('#navbar-responsive-list-title span').addClass('fa-chevron-down');
            category_toggle = false;
        }else{
            $('#responsive-category-list').removeClass('hide');
            $('#responsive-category-list').addClass('show');
            $('#navbar-responsive-list-title span').removeClass('fa-chevron-down');
            $('#navbar-responsive-list-title span').addClass('fa-chevron-up');
            category_toggle = true;
        }
    });

    
    // Owlslider
    $('#slider').owlCarousel({
        items:4, // if you want a slider, not a carousel, specify "1" here
        loop:true,
        autoPlay:true,
        autoplayHoverPause:true, // if slider is autoplaying, pause on mouse hover
        autoplayTimeout:380,
        autoplaySpeed:800,
        navSpeed:500,
        dots:true, // dots navigation below the slider
        nav:true, // left and right navigation
        navText:['<','>']
    });
    $( ".owl-prev").html('<i class="fa fa-chevron-left"></i>');
    $( ".owl-next").html('<i class="fa fa-chevron-right"></i>');
    
    $('#nav-collaping').click( function (){
        if ( $('#nav-collaping').hasClass('c-hamburger--htla') ){
            $('#search-frame-responsive').removeClass('open');
            $('#nav-collaping').removeClass('c-hamburger--htla');
            $("#nav-collaping").addClass('c-hamburger--htx');
        }
    })
    
    // Toggle searh bar responsive function
    $('#search-button-nav-responsive').click( function (){
        if (toggle_responsive){
            toggle_responsive = false;
            $('#search-frame-responsive').removeClass('open');
            $('#search-frame-responsive').addClass('open');
            $("#nav-collaping").addClass('c-hamburger--htx');
            $("#nav-collaping").removeClass('c-hamburger--htla');
            $('#resonsive-search_input').focus();
        }else{
            search_toggle_responsive = true;
            $('#search-frame-responsive').removeClass('open');
            $('#search-frame-responsive').addClass('open');
            $("#nav-collaping").removeClass('c-hamburger--htx');
            $("#nav-collaping").addClass('c-hamburger--htla');
            $('#resonsive-search_input').focus();
            
        }
    });
    
    // Toggle searh bar function
    var search_toggle = false;
    $('#search-toggle').click( function(){
        if (search_toggle){
            search_toggle = false;
            $('#search-frame').removeClass('search-shown');
            $('#search-frame').addClass('search-hidden');
            $('.search-icon').css('color','#484848');
            $('#search_input').focus();
        }else{
            search_toggle = true;
            $('.search-icon').css('color','#ed3422');
            $('#search-frame').removeClass('search-hidden');
            $('#search-frame').addClass('search-shown');
            $('#search_input').focus();
        }
    });
    $('#search-icon-box').click( function(){
        if (search_toggle){
            search_toggle = false;
            $('#search-frame').removeClass('search-shown');
            $('#search-frame').addClass('search-hidden');
            $('.search-icon').css('color','#484848');
            $('#search_input').focus();
        }else{
            search_toggle = true;
            $('.search-icon').css('color','#ed3422');
            $('#search-frame').removeClass('search-hidden');
            $('#search-frame').addClass('search-shown');
            $('#search_input').focus();
        }
    });
    
    // Sending mial via ajax
    $('#contact-form').submit( function(e) {
        var fname = $('input[name=fname]');
        var lname = $('input[name=lname]');
        var email = $('input[name=email]');
        var phone = $('input[name=phone]');
        var company = $('input[name=company]');
        var region = $('input[name=region]');
        var inquiry = $('input[name=inquiry]');
        
        $.ajax({
            type        : 'POST', 
            url         : sentryAjax.ajaxurl, 
            data        : 
            {
                'action': 'ajaxConversion',
                'action': 'send_mail_via_ajax',
                'g-recaptcha-response': grecaptcha.getResponse(),
                'fname' : fname.val(),
                'lname' : lname.val(),
                'email' : email.val(),
                'phone' : phone.val(),
                'company' : company.val(),
                'region' : region.val(),
                'inquiry' : inquiry.val()
            },
            dataType: 'text',
            beforeSend  : function(){
                $('#submit-btn').val('Sending');    
            },
            error       : function(data){
                console.log(data);
            },
            success     : function(data){
                $('#form-submit-wrapper').html(data);
                console.log(data);
                if( data == 0 ){
                    //show error
                    $('#message-wrapper').html(
                        '<p class="form-message error">' +
                        'The field below is required.' +
                        '</p>'
                    ).css('display','block');
                    $('#submit-btn').val('Send');
                }else{
                    $('#message-wrapper').html(
                        '<p class="form-message success">' +
                        'Thank you for your message. We will be in touch shortly' +
                        '</p>'
                    ).css('display','block');
                    //clean inputs
                    fname.val('');
                    lname.val('');
                    email.val('');
                    phone.val('');
                    company.val('');
                    region.val('');
                    inquiry.val('');
                    $('#submit-btn').val('Send');
                    grecaptcha.reset();
                }
            }
        });
        
        // Prevenir que se envie el formulario
        e.preventDefault();
    });

 function getBG () {
    if ( $('.get-background').height() > $('.content-wrapper').height() ){
        $('.background-gray-sidebar').css('height', $('.get-background').height() + 150 );
    }
 }   

getBG();

});
/*----- END READY FUNCTION -------*/

$('.slider-item').click(function(){
    console.log(9999999);
    var newImg = $(this).data().img;
    console.log(newImg);
    $('#featured_image').attr("src",newImg);
    $('#featured_image').attr("srcset",newImg);   
});


/*----- carrousel -------*/

