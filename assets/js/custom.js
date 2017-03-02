/**
 * Custom JS
 */

'use strict';

$(function() {

    /**
     * Adjusting height of columns in the About section
     */

    function adjustAboutColumns() {
        var section = $(".about_table");

        section.each(function() {
            var elem = $(this);
            var height = 0;
            var block = elem.find(".about_desc");

            if (block.length) 
                height = block.outerHeight(); 

            elem.find("[class*='about_img_']").css("height", height); 
        });

    }

    /**
     * Adjusting height of columns in the Reservation section
     */

    function adjustReservationColumns() {
        var section = $(".section_reservation");

        section.each(function() {
            var elem = $(this);
            var height = 0;
            var block = elem.find(".reservation_form_body");

            if (block.length) 
                height = block.outerHeight(); 

            elem.find(".reservation_img").css("height", height); 
        }); 

    }

    /**
     * Navbar class toggle
     */

    var theWindow = $(window);
    var scrollTop = theWindow.scrollTop();
    var navbar = $(".navbar");
    var navbarDefault = $(".navbar-default");
    var navbarCollapse = $(".navbar-collapse");

    theWindow.on({
        'load': function() {

            /**
             * Smooth scroll to anchor
             */

            $('a[href*="#"]').not('[href="#"], [data-slide]').on('click', function() {

                if (location.pathname.replace(/^\//,'') === this.pathname.replace(/^\//,'') && location.hostname === this.hostname) {
                    
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) +']');

                    if (target.length) {
                        $('html, body').animate({
                        scrollTop: target.offset().top - 15}, 1000);
                        return false;
                    }
                }
            });


            /**
             * Navbar class toggle
             */

            // Toggle navbar on page load if needed

            if (scrollTop > 0) {
                navbar.toggleClass("navbar-default navbar-inverse");
            }

            // Toggle navbar on collapse
            navbarCollapse.on({
                'show.bs.collapse': function() {
                    navbar.removeClass("navbar-default").addClass("navbar-inverse");
                },
                'hidden.bs.collapse': function() {
                    var scrollTop = theWindow.scrollTop();

                    if (scrollTop === 0) { 
                        navbar.removeClass("navbar-inverse").addClass("navbar-default");
                    }
                }
            });

            // Close collapsed navbar on click
            //$(".navbar-nav").on('click', 'a', function() {
			$(".navbar a").click(function() {
                navbarCollapse.collapse('hide');
            });


            /**
             * Menu (filtering)
             */

            // Init Isotope
            var $menu = $(".menu__grid").isotope({
                itemSelector: ".menu__item",
                layoutMode: "masonry"
            });

            // Set ititial filtering
            $menu.isotope({ filter: ".menu_Combos" });

            // Filter items on click
            $(".menu_nav").on('click', 'a', function(e) {
                var elem = $(this);

                // Filter items 
                var filterValue = elem.attr('data-filter');
                $menu.isotope({ filter: filterValue });

                // Change active button
                elem.parents("li").addClass("active").siblings("li").removeClass("active");

                e.preventDefault();
            });

            // Filter items on click
            $(".map_nav").on('click', 'a', function(e) {
                var elem = $(this);

                // Change active button
                elem.parents("li").addClass("active").siblings("li").removeClass("active");

                e.preventDefault();
            });

            /**
             * Gallery (layout)
             */

            // Init Isotope
            var $gallery = $(".gallery__grid").isotope({
                itemSelector: ".gallery__item",
                percentPosition: true,
                layoutMode: "masonry"
            });

            // layout Isotope after each image loads
            $gallery.imagesLoaded().progress( function() {
                $gallery.isotope('layout');
            });


            /**
             * Adjusting columns heights
             */

            adjustAboutColumns();
            adjustReservationColumns();

        },
        'scroll': function() {

            /**
             * Navbar
             */

            var scrollTop = theWindow.scrollTop();

            if (scrollTop > 0 && navbarDefault.length) {
                navbar.removeClass("navbar-default").addClass("navbar-inverse");
            } else if (scrollTop === 0) {
                navbar.removeClass("navbar-inverse").addClass("navbar-default");
            }

            /**
             * Adjusting columns heights
             */

            adjustAboutColumns();
            adjustReservationColumns();

        }
    });

});
