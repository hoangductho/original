$(document).ready(function() {

    "use strict";

    /*-----------------------------------------------------------------------------------*/
    /*  Superfish Menu
    /*-----------------------------------------------------------------------------------*/
    var example = $('ul.sf-menu').superfish({
        delay:       100,
        speed:       'fast',
        autoArrows:  false     
    });

    /*-----------------------------------------------------------------------------------*/
    /*  Responsive Menu
    /*-----------------------------------------------------------------------------------*/
    $('#primary-mobile-menu').sidr({
        name: 'sidr-existing-primary',
        source: '#primary-nav'    
    });
   
    $('#secondary-mobile-menu').sidr({
        name: 'sidr-existing-secondary',
        source: '#secondary-nav'
    });

    /*-----------------------------------------------------------------------------------*/
    /*  Header Search Form (Popup)
    /*-----------------------------------------------------------------------------------*/
    $('.header-search > .fa-search').click(function(){
        $('.search-form').slideDown('', function() {});
        $('.header-search > .fa-search').toggleClass('active');
        $('.header-search > .fa-times').toggleClass('active');
    });

    $('.header-search > .fa-times').click(function(){
        $('.search-form').slideUp('', function() {});
        $('.header-search > .fa-search').toggleClass('active');
        $('.header-search > .fa-times').toggleClass('active');
    });

    /*-----------------------------------------------------------------------------------*/
    /*  Sticky
    /*-----------------------------------------------------------------------------------*/
    $("#breadcrumbs").sticky({topSpacing:0}); 

    /*-----------------------------------------------------------------------------------*/
    /*  Match Height
    /*-----------------------------------------------------------------------------------*/
    $('.content-block-1 li').matchHeight();
    $('.content-block-3 .block').matchHeight();
    $('.content-block-4 .block').matchHeight();
    $('.carousel-loop li').matchHeight();  
    $('.grid .hentry').matchHeight();
    $('.column').matchHeight();

    /*-----------------------------------------------------------------------------------*/
    /*  News Ticker
    /*-----------------------------------------------------------------------------------*/
    var newsTicker = jQuery('li.news-item');
    var tickerTimeId = 0;
    var currentNews = 0;
    var olderNews = 0;
    var sumNews = jQuery(newsTicker).size();

    function newsTickerInit(){
        jQuery(newsTicker).eq(0).fadeIn();
        newsTickerClick();
        tickerTimeId = setInterval(autoTicherScroll,6000);
    }
    newsTickerInit();

    function newsTickerClick(){
        jQuery(newsTicker).each(function(index){
            if(!jQuery(this).children('a').is(':hidden')){
                currentNews = index;
            }
        });
        jQuery('a.headline-prev').click(function(e){
            e.preventDefault();
            clearInterval(tickerTimeId);
            olderNews = currentNews;
            if(currentNews == 0){
                currentNews = sumNews-1;
            }else{
                currentNews = currentNews-1;
            }
            jQuery(newsTicker).eq(olderNews).stop(true,true).fadeOut().queue(function(){
                jQuery(newsTicker).eq(currentNews).stop(true,true).fadeIn();
            });

            tickerTimeId = setInterval(autoTicherScroll,6000);
        });
        jQuery('a.headline-next').click(function(e){
            e.preventDefault();
            clearInterval(tickerTimeId);
            olderNews = currentNews;
            if(currentNews == sumNews-1){
                currentNews = 0;
            }else{
                currentNews = currentNews+1;
            }
            jQuery(newsTicker).eq(olderNews).stop(true,true).fadeOut().queue(function(){
                jQuery(newsTicker).eq(currentNews).stop(true,true).fadeIn();
            });
            tickerTimeId = setInterval(autoTicherScroll,6000);
        });
    }

    function autoTicherScroll(){
        olderNews = currentNews;
        if(currentNews == sumNews-1){
            currentNews = 0;
        }else{
            currentNews = currentNews+1;
        }
        jQuery(newsTicker).eq(olderNews).stop(true,true).fadeOut().queue(function(){
            jQuery(newsTicker).eq(currentNews).stop(true,true).fadeIn();
        });
    }
    
    /*-----------------------------------------------------------------------------------*/
    /*  Tabs
    /*-----------------------------------------------------------------------------------*/
    var $tabsNav    = $('.tabs-nav'),
        $tabsNavLis = $tabsNav.children('li'),
        $tabContent = $('.tab-content');

    $tabsNav.each(function() {
        var $this = $(this);

        $this.next().children('.tab-content').stop(true,true).hide()
                                             .first().show();

        $this.children('li').first().addClass('active').stop(true,true).show();
    });

    $tabsNavLis.on('click', function(e) {
        var $this = $(this);

        $this.siblings().removeClass('active').end()
             .addClass('active');

        $this.parent().next().children('.tab-content').stop(true,true).hide()
                                                      .siblings( $this.find('a').attr('href') ).fadeIn();

        e.preventDefault();
    });

    /*-----------------------------------------------------------------------------------*/
    /*   Carousel #0 / Featured Content
    /*-----------------------------------------------------------------------------------*/
    $('#carousel-0').jcarousel({
        wrap: 'circular',
        animation: {
            duration: 500
        }
    });

    $('#carousel-0').jcarouselAutoscroll({
        autostart: true,
        interval: 5000

    });

    $('.jcarousel-pagination-0')
        .on('jcarouselpagination:active', 'a', function() {
            $(this).addClass('active');
        })
        .on('jcarouselpagination:inactive', 'a', function() {
            $(this).removeClass('active');
        })
        .jcarouselPagination();
      
    $('#carousel-0 .jcarousel-control-prev')
        .on('jcarouselcontrol:active', function() {
            $(this).removeClass('inactive');
        })
        .on('jcarouselcontrol:inactive', function() {
            $(this).addClass('inactive');
        })
        .jcarouselControl({
            target: '-=1'
        });

    $('#carousel-0 .jcarousel-control-next')
        .on('jcarouselcontrol:active', function() {
            $(this).removeClass('inactive');
        })
        .on('jcarouselcontrol:inactive', function() {
            $(this).addClass('inactive');
        })
        .jcarouselControl({
            target: '+=1'
        });

    $('.jcarousel')
        .jcarousel({
            wrap: 'circular'                
        });

    $('.jcarousel-pagination-1')
        .on('jcarouselpagination:active', 'a', function() {
            $(this).addClass('active');
        })
        .on('jcarouselpagination:inactive', 'a', function() {
            $(this).removeClass('active');
        })
        .jcarouselPagination({
            target: "+=1"
        });

    /*-----------------------------------------------------------------------------------*/
    /*  Carousel #1 / Must See Videos
    /*-----------------------------------------------------------------------------------*/
    $('#carousel-1 .jcarousel-control-prev')
        .on('jcarouselcontrol:active', function() {
            $(this).removeClass('inactive');
        })
        .on('jcarouselcontrol:inactive', function() {
            $(this).addClass('inactive');
        })
        .jcarouselControl({
            target: '-=1'
        });

    $('#carousel-1 .jcarousel-control-next')
        .on('jcarouselcontrol:active', function() {
            $(this).removeClass('inactive');
        })
        .on('jcarouselcontrol:inactive', function() {
            $(this).addClass('inactive');
        })
        .jcarouselControl({
            target: '+=1'
        });

    /*-----------------------------------------------------------------------------------*/
    /*  prettyPhoto
    /*-----------------------------------------------------------------------------------*/
    $("a.zoom").prettyPhoto({
        hook: 'data-rel',
        social_tools: false,
        theme: 'pp_woocommerce',
        horizontal_padding: 20,
        opacity: 0.8,
        deeplinking: false
    });
    $("a[data-rel^='prettyPhoto']").prettyPhoto({
        hook: 'data-rel',
        social_tools: false,
        theme: 'pp_woocommerce',
        horizontal_padding: 20,
        opacity: 0.8,
        deeplinking: false
    });

    /*-----------------------------------------------------------------------------------*/
    /*  WooCommerce Integration
    /*-----------------------------------------------------------------------------------*/

    // Tabs
    $( '.woocommerce-tabs .panel' ).hide();

    $( '.woocommerce-tabs ul.tabs li a' ).click( function() {

        var $tab = $( this ),
            $tabs_wrapper = $tab.closest( '.woocommerce-tabs' );

        $( 'ul.tabs li', $tabs_wrapper ).removeClass( 'active' );
        $( 'div.panel', $tabs_wrapper ).hide();
        $( 'div' + $tab.attr( 'href' ), $tabs_wrapper).show();
        $tab.parent().addClass( 'active' );

        return false;
    });

    $( '.woocommerce-tabs' ).each( function() {
        var hash    = window.location.hash,
            url     = window.location.href,
            tabs    = $( this );

        if ( hash.toLowerCase().indexOf( "comment-" ) >= 0 ) {
            $('ul.tabs li.reviews_tab a', tabs ).click();

        } else if ( url.indexOf( "comment-page-" ) > 0 || url.indexOf( "cpage=" ) > 0 ) {
            $( 'ul.tabs li.reviews_tab a', $( this ) ).click();

        } else {
            $( 'ul.tabs li:first a', tabs ).click();
        }
    });

    $( 'a.woocommerce-review-link' ).click( function() {
        $( '.reviews_tab a' ).click();
        return true;
    });

    // Star ratings for comments
    $( '#rating' ).hide().before( '<p class="stars"><span><a class="star-1" href="#">1</a><a class="star-2" href="#">2</a><a class="star-3" href="#">3</a><a class="star-4" href="#">4</a><a class="star-5" href="#">5</a></span></p>' );

    $( 'body' )
        .on( 'click', '#respond p.stars a', function() {
            var $star   = $( this ),
                $rating = $( this ).closest( '#respond' ).find( '#rating' );

            $rating.val( $star.text() );
            $star.siblings( 'a' ).removeClass( 'active' );
            $star.addClass( 'active' );

            return false;
        })
        .on( 'click', '#respond #submit', function() {
            var $rating = $( this ).closest( '#respond' ).find( '#rating' ),
                rating  = $rating.val();

            if ( $rating.size() > 0 && ! rating && wc_single_product_params.review_rating_required === 'yes' ) {
                alert( wc_single_product_params.i18n_required_rating_text );

                return false;
            }
        });

    // prevent double form submission
    $( 'form.cart' ).submit( function() {
        $( this ).find( ':submit' ).attr( 'disabled','disabled' );
    });

    // Orderby
    $( '.woocommerce-ordering' ).on( 'change', 'select.orderby', function() {
        $( this ).closest( 'form' ).submit();
    });

    // Quantity buttons
    $( 'div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)' ).addClass( 'buttons_added' ).append( '<input type="button" value="+" class="plus" />' ).prepend( '<input type="button" value="-" class="minus" />' );

    // Target quantity inputs on product pages
    $( 'input.qty:not(.product-quantity input.qty)' ).each( function() {
        var min = parseFloat( $( this ).attr( 'min' ) );

        if ( min && min > 0 && parseFloat( $( this ).val() ) < min ) {
            $( this ).val( min );
        }
    });

    $( document ).on( 'click', '.plus, .minus', function() {

        // Get values
        var $qty        = $( this ).closest( '.quantity' ).find( '.qty' ),
            currentVal  = parseFloat( $qty.val() ),
            max         = parseFloat( $qty.attr( 'max' ) ),
            min         = parseFloat( $qty.attr( 'min' ) ),
            step        = $qty.attr( 'step' );

        // Format values
        if ( ! currentVal || currentVal === '' || currentVal === 'NaN' ) currentVal = 0;
        if ( max === '' || max === 'NaN' ) max = '';
        if ( min === '' || min === 'NaN' ) min = 0;
        if ( step === 'any' || step === '' || step === undefined || parseFloat( step ) === 'NaN' ) step = 1;

        // Change the value
        if ( $( this ).is( '.plus' ) ) {

            if ( max && ( max == currentVal || currentVal > max ) ) {
                $qty.val( max );
            } else {
                $qty.val( currentVal + parseFloat( step ) );
            }

        } else {

            if ( min && ( min == currentVal || currentVal < min ) ) {
                $qty.val( min );
            } else if ( currentVal > 0 ) {
                $qty.val( currentVal - parseFloat( step ) );
            }

        }

        // Trigger change event
        $qty.trigger( 'change' );
    });                             

});


