( function( $ ) {

	var dtShopProducts = function($scope, $){

		var swiperProduct = [];
		var swiperProductOptions = [];
		var swiperIterator = 1;

		$scope.find('.dt-sc-products-container.swiper-container').each(function() {

			var $swiperItem = jQuery(this);
			var swiperUniqueId = 'swiperuniqueid-'+swiperIterator;

			swiperProductOptions[swiperUniqueId] = [];
			$swiperItem.attr('id', swiperUniqueId);

			// Get swiper options
			var effect = $swiperItem.attr('data-carouseleffect');

			var slidesperview = parseInt($swiperItem.attr('data-carouselslidesperview'), 10);

			var loopmode = ($swiperItem.attr('data-carouselloopmode') == 'true') ? true : false;
			var mousewheelcontrol = ($swiperItem.attr('data-carouselmousewheelcontrol') == 'true') ? true : false;

			var pagination_class = '';
			var pagination_type = '';

			var carouselbulletpagination = ($swiperItem.attr('data-carouselbulletpagination') == 'true') ? true : false;
			if(carouselbulletpagination) {
				var pagination_class = $swiperItem.find('.dt-sc-products-bullet-pagination');
				var pagination_type = 'bullets';
			}

			var carouselthumbnailposition = ($swiperItem.attr('data-carouselthumbnailposition') != '') ? $swiperItem.attr('data-carouselthumbnailposition') : false;
			if(carouselthumbnailposition) {
				swiperProductOptions[swiperUniqueId]['carouselthumbnailposition'] = 'vertical';
			} else {
				swiperProductOptions[swiperUniqueId]['carouselthumbnailposition'] = 'horizontal';
			}

			var scrollbar_class = '';
			var	scrollbar_hide = true;
			var carouselscrollbar = ($swiperItem.attr('data-carouselscrollbar') == 'true') ? true : false;
			if(carouselscrollbar) {
				scrollbar_class = $swiperItem.find('.dt-sc-products-scrollbar');
				scrollbar_hide = false;
			}

			var spacebetween = parseInt($swiperItem.attr('data-carouselspacebetween'), 10);
			if(spacebetween) {
				spacebetween = spacebetween;
			} else {
				spacebetween = 0;
			}

			if($swiperItem.parents('section').hasClass('page-with-sidebar')) {

				if(slidesperview == 1) {
					var breakpoint_slides_1 = breakpoint_slides_2 = breakpoint_slides_3 = breakpoint_slides_4 = breakpoint_slides_5 = 1;
				} else if(slidesperview == 2) {
					var breakpoint_slides_1 = 2; var breakpoint_slides_2 = 2; var breakpoint_slides_3 = 2; var breakpoint_slides_4 = 1; var breakpoint_slides_5 = 1;
				} else if(slidesperview >= 3) {
					var breakpoint_slides_1 = 3; var breakpoint_slides_2 = 2; var breakpoint_slides_3 = 2; var breakpoint_slides_4 = 1; var breakpoint_slides_5 = 1;
				}

			} else {

				if(slidesperview == 1) {
					var breakpoint_slides_1 = breakpoint_slides_2 = breakpoint_slides_3 = breakpoint_slides_4 = breakpoint_slides_5 = 1;
				} else if(slidesperview == 2) {
					var breakpoint_slides_1 = 2; var breakpoint_slides_2 = 2; var breakpoint_slides_3 = 2; var breakpoint_slides_4 = 2; var breakpoint_slides_5 = 1;
				} else if(slidesperview == 3) {
					var breakpoint_slides_1 = 3; var breakpoint_slides_2 = 3; var breakpoint_slides_3 = 2; var breakpoint_slides_4 = 2; var breakpoint_slides_5 = 1;
				} else if(slidesperview >= 4) {
					var breakpoint_slides_1 = 4; var breakpoint_slides_2 = 3; var breakpoint_slides_3 = 2; var breakpoint_slides_4 = 2; var breakpoint_slides_5 = 1;
				}	
				
			}

			// Generate swiper
			swiperProduct[swiperUniqueId] = new Swiper($swiperItem, {
				
				initialSlide: 0,
				simulateTouch: true,
				roundLengths: true,
				spaceBetween: spacebetween,
				keyboardControl: true,
				paginationClickable: true,
				autoHeight: true,
				grabCursor: true,

				slidesPerView: slidesperview,
				loop:loopmode,
				mousewheel: mousewheelcontrol,
				direction: 'horizontal',

				pagination: {
					el: pagination_class,
					type: pagination_type,
					clickable: true					
				},

				scrollbar: {
					el: scrollbar_class,
					hide: scrollbar_hide,
					draggable: true,
				},                  

				effect: effect,
			
				breakpoints: {
					1680: {
						slidesPerView: breakpoint_slides_1,
					},
					1440: {
						slidesPerView: breakpoint_slides_2,
					},										
					1199: {
						slidesPerView: breakpoint_slides_3,
					},	            
					991: {
						slidesPerView: breakpoint_slides_4,
					},
					767: {
						slidesPerView: breakpoint_slides_5,
					}
				},            

			});

			// Arrow pagination
			var arrowpagination = ($swiperItem.attr('data-carouselarrowpagination') == 'true') ? true : false;

			if(arrowpagination) {

				$swiperItem.find('.dt-sc-products-arrow-pagination .dt-sc-products-arrow-prev').on('click', function(e) {			    	
					var swiperUniqueId = $swiperItem.attr('id');
					swiperProduct[swiperUniqueId].slidePrev();
					if(swiperProductOptions[swiperUniqueId]['autoplay_enable']) {
						swiperProduct[swiperUniqueId].autoplay.start();
					}
					e.preventDefault();		
				});

				$swiperItem.find('.dt-sc-products-arrow-pagination .dt-sc-products-arrow-next').on('click', function(e) {
					var swiperUniqueId = $swiperItem.attr('id');
					swiperProduct[swiperUniqueId].slideNext();
					if(swiperProductOptions[swiperUniqueId]['autoplay_enable']) {
						swiperProduct[swiperUniqueId].autoplay.start();
					}
					e.preventDefault();	
				});	

			}

			swiperIterator++;

		});	

	};
		
    $(window).on('elementor/frontend/init', function(){
		elementorFrontend.hooks.addAction('frontend/element_ready/dt-shop-products.default', dtShopProducts);
    });	
    
} )( jQuery );