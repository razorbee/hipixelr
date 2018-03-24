( function( $, elementor ) {

	"use strict";

	var JetElements = {

		init: function() {

			var widgets = {
				'jet-carousel.default' : JetElements.widgetCarousel,
				'jet-circle-progress.default' : JetElements.widgetProgress,
				'jet-map.default' : JetElements.widgetMap,
				'jet-countdown-timer.default' : JetElements.widgetCountdown,
				'jet-posts.default' : JetElements.widgetPosts,
				'jet-animated-text.default' : JetElements.widgetAnimatedText,
				'jet-animated-box.default' : JetElements.widgetAnimatedBox,
				'jet-images-layout.default' : JetElements.widgetImagesLayout,
				'jet-slider.default' : JetElements.widgetSlider,
				'jet-testimonials.default' : JetElements.widgetTestimonials,
				'jet-image-comparison.default' : JetElements.widgetImageComparison,
				'jet-instagram-gallery.default' : JetElements.widgetInstagramGallery,
				'jet-scroll-navigation.default' : JetElements.widgetScrollNavigation,
				'mp-timetable.default': JetElements.widgetTimeTable
			};

			$.each( widgets, function( widget, callback ) {
				elementor.hooks.addAction( 'frontend/element_ready/' + widget, callback );
			});

		},

		widgetCountdown: function( $scope ) {

			var timeInterval,
				$coutdown = $scope.find( '[data-due-date]' ),
				endTime = new Date( $coutdown.data( 'due-date' ) * 1000 ),
				elements = {
					days: $coutdown.find( '[data-value="days"]' ),
					hours: $coutdown.find( '[data-value="hours"]' ),
					minutes: $coutdown.find( '[data-value="minutes"]' ),
					seconds: $coutdown.find( '[data-value="seconds"]' )
				};

			JetElements.widgetCountdown.updateClock = function() {

				var timeRemaining = JetElements.widgetCountdown.getTimeRemaining( endTime );

				$.each( timeRemaining.parts, function( timePart ) {

					var $element = elements[ timePart ];

					if ( $element.length ) {
						$element.html( this );
					}

				} );

				if ( timeRemaining.total <= 0 ) {
					clearInterval( timeInterval );
				}
			};

			JetElements.widgetCountdown.initClock = function() {
				JetElements.widgetCountdown.updateClock();
				timeInterval = setInterval( JetElements.widgetCountdown.updateClock, 1000 );
			};

			JetElements.widgetCountdown.splitNum = function( num ) {

				var num   = num.toString(),
					arr   = [],
					reult = '';

				if ( 1 === num.length ) {
					num = 0 + num;
				}

				arr = num.match(/\d{1}/g);

				$.each( arr, function( index, val ) {
					reult += '<span class="jet-countdown-timer__digit">' + val + '</span>';
				});

				return reult;
			};

			JetElements.widgetCountdown.getTimeRemaining = function( endTime ) {

				var timeRemaining = endTime - new Date(),
					seconds = Math.floor( ( timeRemaining / 1000 ) % 60 ),
					minutes = Math.floor( ( timeRemaining / 1000 / 60 ) % 60 ),
					hours = Math.floor( ( timeRemaining / ( 1000 * 60 * 60 ) ) % 24 ),
					days = Math.floor( timeRemaining / ( 1000 * 60 * 60 * 24 ) );

				if ( days < 0 || hours < 0 || minutes < 0 ) {
					seconds = minutes = hours = days = 0;
				}

				return {
					total: timeRemaining,
					parts: {
						days: JetElements.widgetCountdown.splitNum( days ),
						hours: JetElements.widgetCountdown.splitNum( hours ),
						minutes: JetElements.widgetCountdown.splitNum( minutes ),
						seconds: JetElements.widgetCountdown.splitNum( seconds )
					}
				};
			};

			JetElements.widgetCountdown.initClock();

		},

		widgetMap: function( $scope ) {

			var $container = $scope.find( '.jet-map' ),
				map,
				init,
				pins;

			if ( ! window.google ) {
				return;
			}

			init = $container.data( 'init' );
			pins = $container.data( 'pins' );
			map  = new google.maps.Map( $container[0], init );

			if ( pins ) {
				$.each( pins, function( index, pin ) {

					var marker,
						infowindow,
						pinData = {
							position: pin.position,
							map: map
						};

					if ( '' !== pin.image ) {
						pinData.icon = pin.image;
					}

					marker = new google.maps.Marker( pinData );

					if ( '' !== pin.desc ) {
						infowindow = new google.maps.InfoWindow({
							content: pin.desc
						});
					}

					marker.addListener( 'click', function() {
						infowindow.open( map, marker );
					});

					if ( 'visible' === pin.state && '' !== pin.desc ) {
						infowindow.open( map, marker );
					}

				});
			}

		},

		widgetProgress: function( $scope ) {

			var $progress = $scope.find( '.circle-progress' );

			if ( ! $progress.length ) {
				return;
			}

			var $value        = $progress.find( '.circle-progress__value' ),
				percent       = parseInt( $value.data( 'value' ) ),
				radius        = parseInt( $progress.data( 'radius' ) ),
				circumference = parseInt( $progress.data( 'circumference' ) ),
				progress      = percent / 100,
				dashoffset    = circumference * ( 1 - progress ),
				duration      = $scope.find( '.circle-progress-wrap' ).data( 'duration' );

			$value.css({
				'transitionDuration': duration + 'ms'
			});

			elementorFrontend.waypoint( $scope, function() {

				// animate counter
				var $number = $scope.find( '.circle-counter__number' ),
					data = $number.data();

				var decimalDigits = data.toValue.toString().match( /\.(.*)/ );

				if ( decimalDigits ) {
					data.rounding = decimalDigits[1].length;
				}

				data.duration = duration;

				$number.numerator( data );

				// animate progress
				$value.css({
					'strokeDashoffset': dashoffset
				});

			}, {
				offset: 'bottom-in-view'
			} );

		},

		widgetCarousel: function( $scope ) {

			var $carousel = $scope.find( '.jet-carousel' );

			if ( ! $carousel.length ) {
				return;
			}

			JetElements.initCarousel( $carousel, $carousel.data( 'slider_options' ) );

		},

		widgetPosts: function ( $scope ) {

			var $target = $scope.find( '.jet-carousel' );

			if ( ! $target.length ) {
				return;
			}

			JetElements.initCarousel( $target.find( '.jet-posts' ), $target.data( 'slider_options' ) );

		},

		widgetAnimatedText: function( $scope ) {
			var $target = $scope.find( '.jet-animated-text' ),
				instance = null,
				settings = {};

			if ( ! $target.length ) {
				return;
			}

			settings = $target.data( 'settings' );
			instance = new jetAnimatedText( $target, settings );
			instance.init();
		},

		widgetAnimatedBox: function( $scope ) {
			var $target      = $scope.find( '.jet-animated-box' ),
				toogleEvents = 'mouseenter mouseleave',
				scrollOffset = $( window ).scrollTop();

			if ( ! $target.length ) {
				return;
			}

			if ( 'ontouchend' in window || 'ontouchstart' in window ) {
				$target.on( 'touchstart', function( event ) {
					scrollOffset = $( window ).scrollTop();
				} );

				$target.on( 'touchend', function( event ) {

					if ( scrollOffset !== $( window ).scrollTop() ) {
						return false;
					}

					$( this ).toggleClass( 'flipped' );
				} );

			} else {
				$target.on( toogleEvents, function( event ) {
					$( this ).toggleClass( 'flipped' );
				} );
			}
		},

		widgetImagesLayout: function( $scope ) {
			var $target = $scope.find( '.jet-images-layout' ),
				instance = null,
				settings = {};

			if ( ! $target.length ) {
				return;
			}

			settings = $target.data( 'settings' ),
			instance = new jetImagesLayout( $target, settings );
			instance.init();
		},

		widgetInstagramGallery: function( $scope ) {
			var $target         = $scope.find( '.jet-instagram-gallery__instance' ),
				instance        = null,
				defaultSettings = {},
				settings        = {};

			if ( ! $target.length ) {
				return;
			}

			settings = $target.data( 'settings' ),

			/*
			 * Default Settings
			 */
			defaultSettings = {
				layoutType: 'masonry',
				columns: 3,
				columnsTablet: 2,
				columnsMobile: 1,
			}

			/**
			 * Checking options, settings and options merging
			 */
			$.extend( defaultSettings, settings );

			if ( 'masonry' === settings.layoutType ) {
				salvattore.init();
			}

		},

		widgetScrollNavigation: function( $scope ) {
			var $target         = $scope.find( '.jet-scroll-navigation' ),
				instance        = null,
				settings        = $target.data( 'settings' );

			instance = new jetScrollNavigation( $target, settings );
			instance.init();
		},

		widgetSlider: function( $scope ) {
			var $target        = $scope.find( '.jet-slider' ),
				$imagesTagList = $( '.sp-image', $target ),
				instance       = null,
				settings       = {};

			if ( ! $target.length ) {
				return;
			}

			$target.imagesLoaded().progress( function( instance, image ) {
				var loadedImages = null,
					progressBarWidth = null;

				if ( image.isLoaded ) {

					if ( $( image.img ).hasClass( 'sp-image' ) ) {
						$( image.img ).addClass( 'image-loaded' );
					}

					loadedImages = $( '.image-loaded', $target );
					progressBarWidth = 100 * ( loadedImages.length / $imagesTagList.length ) + '%';

					$( '.jet-slider-loader', $target ).css( { width: progressBarWidth } );
				}

			} ).done( function( instance ) {

				$( '.slider-pro', $target ).addClass( 'slider-loaded' );
				$( '.jet-slider-loader', $target ).css( { 'display': 'none' } );
			} );

			settings = $target.data( 'settings' ),

			$( '.slider-pro', $target ).sliderPro( {
				width: settings['sliderWidth']['size'] + settings['sliderWidth']['unit'],
				height: +settings['sliderHeight']['size'],
				arrows: settings['sliderNavigation'],
				fadeArrows: settings['sliderNaviOnHover'],
				buttons: settings['sliderPagination'],
				autoplay: settings['sliderAutoplay'],
				autoplayDelay: settings['sliderAutoplayDelay'],
				fullScreen: settings['sliderFullScreen'],
				shuffle: settings['sliderShuffle'],
				loop: settings['sliderLoop'],
				fade: settings['sliderFadeMode'],
				slideDistance: ( 'string' !== typeof settings['slideDistance']['size'] ) ? settings['slideDistance']['size'] : 0,
				slideAnimationDuration: +settings['slideDuration'],
				imageScaleMode: settings['imageScaleMode'],
				waitForLayers: false,
				visibleSize: 'auto',
				grabCursor: false,
				thumbnailWidth: settings['thumbnailWidth'],
				thumbnailHeight: settings['thumbnailHeight'],
				init: function() {
					$( this ).resize();

					$( '.sp-previous-arrow', $target ).append( '<i class="' + settings['sliderNavigationIcon'] + '"></i>' );
					$( '.sp-next-arrow', $target ).append( '<i class="' + settings['sliderNavigationIcon'] + '"></i>' );

					$( '.sp-full-screen-button', $target ).append( '<i class="' + settings['sliderFullscreenIcon'] + '"></i>' );
				},
				breakpoints: {
					1023: {
						height: +settings['sliderHeightTablet']['size'] || +settings['sliderHeight']['size']
					},
					767: {
						height: +settings['sliderHeightMobile']['size'] || +settings['sliderHeight']['size']
					}
				}
			} );
		},

		widgetTestimonials: function( $scope ) {
			var $target        = $scope.find( '.jet-testimonials__instance' ),
				$imagesTagList = $( '.jet-testimonials__figure', $target ),
				instance       = null,
				settings       = $target.data( 'settings' );

			if ( ! $target.length ) {
				return;
			}

			settings.adaptiveHeight = true;
			JetElements.initCarousel( $target, settings );
		},

		widgetImageComparison: function( $scope ) {
			var $target              = $scope.find( '.jet-image-comparison__instance' ),
				instance             = null,
				imageComparisonItems = $( '.jet-image-comparison__container', $target ),
				settings             = $target.data( 'settings' ),
				elementId            = $scope.data( 'id' );

			if ( ! $target.length ) {
				return;
			}

			window.juxtapose.scanPage( '.jet-juxtapose' );

			settings.draggable = false;
			settings.infinite = false;
			//settings.adaptiveHeight = true;
			JetElements.initCarousel( $target, settings );
		},

		widgetTimeTable: function( $scope ) {

			var $mptt_shortcode_wrapper = $scope.find( '.mptt-shortcode-wrapper' );

			if ( ( typeof typenow ) !== 'undefined' ) {
				if ( pagenow === typenow ) {
					switch ( typenow ) {

						case 'mp-event':
							Registry._get( 'Event' ).init();
							break;

						case 'mp-column':
							Registry._get( 'Event' ).initDatePicker();
							Registry._get( 'Event' ).columnRadioBox();
							break;

						default:
							break;
					}
				}
			}

			if ( $mptt_shortcode_wrapper.length ) {

				Registry._get( 'Event' ).initTableData();
				Registry._get( 'Event' ).filterShortcodeEvents();
				Registry._get( 'Event' ).getFilterByHash();

				$mptt_shortcode_wrapper.show();
			}

			if ( $( '.upcoming-events-widget' ).length || $mptt_shortcode_wrapper.length ) {
				Registry._get( 'Event' ).setColorSettings();
			}
		},

		initCarousel: function( $target, options ) {

			var tabletSlides, mobileSlides, defaultOptions, slickOptions;

			if ( options.slidesToShow.tablet ) {
				tabletSlides = options.slidesToShow.tablet;
			} else {
				tabletSlides = 1 === options.slidesToShow.desktop ? 1 : 2;
			}

			if ( options.slidesToShow.mobile ) {
				mobileSlides = options.slidesToShow.mobile;
			} else {
				mobileSlides = 1;
			}

			options.slidesToShow = options.slidesToShow.desktop;

			defaultOptions = {
				customPaging: function(slider, i) {
					return $( '<span />' ).text( i + 1 );
				},
				dotsClass: 'jet-slick-dots',
				responsive: [
					{
						breakpoint: 1025,
						settings: {
							slidesToShow: tabletSlides,
						}
					},
					{
						breakpoint: 768,
						settings: {
							slidesToShow: mobileSlides,
							slidesToScroll: 1
						}
					}
				]
			};

			slickOptions = $.extend( {}, defaultOptions, options );

			$target.slick( slickOptions );
		}

	};

	$( window ).on( 'elementor/frontend/init', JetElements.init );

	var JetElementsTools = {
		debounce: function( threshold, callback ) {
			var timeout;

			return function debounced( $event ) {
				function delayed() {
					callback.call( this, $event );
					timeout = null;
				}

				if ( timeout ) {
					clearTimeout( timeout );
				}

				timeout = setTimeout( delayed, threshold );
			};
		},

		getObjectNextKey: function( object, key ) {
			var keys      = Object.keys( object ),
				idIndex   = keys.indexOf( key ),
				nextIndex = idIndex += 1;

			if( nextIndex >= keys.length ) {
				//we're at the end, there is no next
				return false;
			}

			var nextKey = keys[ nextIndex ];

			return nextKey;
		},

		getObjectPrevKey: function( object, key ) {
			var keys      = Object.keys( object ),
				idIndex   = keys.indexOf( key ),
				prevIndex = idIndex -= 1;

			if ( 0 > idIndex ) {
				//we're at the end, there is no next
				return false;
			}

			var prevKey = keys[ prevIndex ];

			return prevKey;
		}
	}

	/**
	 * Jet animated text Class
	 *
	 * @return {void}
	 */
	window.jetAnimatedText = function( $selector, settings ) {
		var self                   = this,
			$instance              = $selector,
			$animatedTextContainer = $( '.jet-animated-text__animated-text', $instance ),
			$animatedTextList      = $( '.jet-animated-text__animated-text-item', $animatedTextContainer ),
			timeOut                = null,
			defaultSettings        = {},
			settings               = settings || {},
			currentIndex           = 0;

		/*
		 * Default Settings
		 */
		defaultSettings = {
			effect: 'fx1',
			delay: 3000
		}

		/**
		 * Checking options, settings and options merging
		 */
		$.extend( defaultSettings, settings );

		/**
		 * Avaliable Effects
		 */
		self.avaliableEffects = {
			'fx1' : {
				in: {
					duration: 1000,
					delay: function( el, index ) { return 75 + index * 100; },
					easing: 'easeOutElastic',
					elasticity: 650,
					opacity: {
						value: [ 0, 1 ],
						easing: 'easeOutExpo',
					},
					translateY: ['100%','0%']
				},
				out: {
					duration: 300,
					delay: function(el, index) { return index*40; },
					easing: 'easeInOutExpo',
					opacity: 0,
					translateY: '-100%'
				}
			},
			'fx2' : {
				in: {
					duration: 800,
					delay: function( el, index) { return index * 50; },
					easing: 'easeOutElastic',
					opacity: {
						value: [ 0, 1 ],
						easing: 'easeOutExpo',
					},
					translateY: function(el, index) {
						return index%2 === 0 ? ['-80%', '0%'] : ['80%', '0%'];
					}
				},
				out: {
					duration: 300,
					delay: function( el, index ) { return index * 20; },
					easing: 'easeOutExpo',
					opacity: 0,
					translateY: function( el, index ) {
						return index%2 === 0 ? '80%' : '-80%';
					}
				}
			},
			'fx3' : {
				in: {
					duration: 700,
					delay: function(el, index) {
						return ( el.parentNode.children.length - index - 1 ) * 80;
					},
					easing: 'easeOutElastic',
					opacity: {
						value: [ 0, 1 ],
						easing: 'easeOutExpo',
					},
					translateY: function(el, index) {
						return index%2 === 0 ? [ '-80%', '0%' ] : [ '80%', '0%' ];
					},
					rotateZ: [90,0]
				},
				out: {
					duration: 300,
					delay: function(el, index) { return (el.parentNode.children.length-index-1) * 50; },
					easing: 'easeOutExpo',
					opacity: 0,
					translateY: function(el, index) {
						return index%2 === 0 ? '80%' : '-80%';
					},
					rotateZ: function(el, index) {
						return index%2 === 0 ? -25 : 25;
					}
				}
			},
			'fx4' : {
				in: {
					duration: 700,
					delay: function( el, index ) { return 550 + index * 50; },
					easing: 'easeOutQuint',
					opacity: {
						value: [ 0, 1 ],
						easing: 'easeOutExpo',
					},
					translateY: [ '-150%','0%' ],
					rotateY: [ 180, 0 ]
				},
				out: {
					duration: 200,
					delay: function( el, index ) { return index * 30; },
					easing: 'easeInQuint',
					opacity: {
						value: 0,
						easing: 'linear',
					},
					translateY: '100%',
					rotateY: -180
				}
			},
			'fx5' : {
				in: {
					duration: 250,
					delay: function( el, index ) { return 200 + index * 25; },
					easing: 'easeOutCubic',
					opacity: {
						value: [ 0, 1 ],
						easing: 'easeOutExpo',
					},
					translateY: ['-50%','0%']
				},
				out: {
					duration: 250,
					delay: function( el, index ) { return index * 25; },
					easing: 'easeOutCubic',
					opacity: 0,
					translateY: '50%'
				}
			},
			'fx6' : {
				in: {
					duration: 400,
					delay: function( el, index ) { return index * 50; },
					easing: 'easeOutSine',
					opacity: {
						value: [ 0, 1 ],
						easing: 'easeOutExpo',
					},
					rotateY: [ -90, 0 ]
				},
				out: {
					duration: 200,
					delay: function( el, index ) { return index * 50; },
					easing: 'easeOutSine',
					opacity: 0,
					rotateY: 45
				}
			},
			'fx7' : {
				in: {
					duration: 1000,
					delay: function( el, index ) { return 100 + index * 30; },
					easing: 'easeOutElastic',
					opacity: {
						value: [ 0, 1 ],
						easing: 'easeOutExpo',
					},
					rotateZ: function( el, index ) {
						return [ anime.random( 20, 40 ), 0 ];
					}
				},
				out: {
					duration: 300,
					opacity: {
						value: [ 1, 0 ],
						easing: 'easeOutExpo',
					}
				}
			},
			'fx8' : {
				in: {
					duration: 400,
					delay: function( el, index ) { return 200 + index * 20; },
					easing: 'easeOutExpo',
					opacity: 1,
					rotateY: [ -90, 0 ],
					translateY: [ '50%','0%' ]
				},
				out: {
					duration: 250,
					delay: function( el, index ) { return index * 20; },
					easing: 'easeOutExpo',
					opacity: 0,
					rotateY: 90
				}
			},
			'fx9' : {
				in: {
					duration: 400,
					delay: function(el, index) { return 200+index*30; },
					easing: 'easeOutExpo',
					opacity: 1,
					rotateX: [90,0]
				},
				out: {
					duration: 250,
					delay: function(el, index) { return index*30; },
					easing: 'easeOutExpo',
					opacity: 0,
					rotateX: -90
				}
			},
			'fx10' : {
				in: {
					duration: 400,
					delay: function( el, index ) { return 100 + index * 50; },
					easing: 'easeOutExpo',
					opacity: {
						value: [ 0, 1 ],
						easing: 'easeOutExpo',
					},
					rotateX: [ 110, 0 ]
				},
				out: {
					duration: 250,
					delay: function( el, index ) { return index * 50; },
					easing: 'easeOutExpo',
					opacity: 0,
					rotateX: -110
				}
			},
			'fx11' : {
				in: {
					duration: function( el, index ) { return anime.random( 800, 1000 ); },
					delay: function( el, index ) { return anime.random( 100, 300 ); },
					easing: 'easeOutExpo',
					opacity: {
						value: [ 0, 1 ],
						easing: 'easeOutExpo',
					},
					translateY: [ '-150%','0%' ],
					rotateZ: function( el, index ) { return [ anime.random( -50, 50 ), 0 ]; }
				},
				out: {
					duration: function( el, index ) { return anime.random( 200, 300 ); },
					delay: function( el, index ) { return anime.random( 0, 80 ); },
					easing: 'easeInQuart',
					opacity: 0,
					translateY: '50%',
					rotateZ: function( el, index ) { return anime.random( -50, 50 ); }
				}
			},
			'fx12' : {
				in: {
					duration: 1,
					delay: function( el, index ) {
						var delay = index * 200 + anime.random( 0, 200 );

						return delay;
					},
					width: [ 0, function( el, i ) { return $( el ).width(); } ]
				},
				out: {
					duration: 1,
					delay: function( el, index ) { return ( el.parentNode.children.length - index - 1 ) * 100; },
					easing: 'linear',
					width: {
						value: 0
					}
				}
			}
		};

		self.textChange = function() {

			if ( timeOut ) {
				clearTimeout( timeOut );
			}

			timeOut = setTimeout( function() {
				var $prevText,
					$nextText;

				$prevText = $animatedTextList.eq( currentIndex );

				if ( currentIndex < $animatedTextList.length - 1 ) {
					currentIndex++;
				} else {
					currentIndex = 0;
				}

				$nextText = $animatedTextList.eq( currentIndex );

				self.hideText( $prevText, settings.effect, null, function( anime ) {
					$prevText.toggleClass( 'visible' );
					self.showText(
						$nextText,
						settings.effect,
						function() {
							$nextText.toggleClass( 'active' );
							$prevText.toggleClass( 'active' );

							$nextText.toggleClass( 'visible' );

							self.textChange();
						},
						null
					);
				} );

				//self.textChange();

			}, settings.delay );

		};

		self.showText = function( $selector, effect, beginCallback, completeCallback ) {
			var targets = [];

			$( 'span', $selector ).each( function() {
				$( this ).css( {
					'width': 'auto',
					'opacity': 1,
					'WebkitTransform': '',
					'transform': ''
				});
				targets.push( this );
			});

			self.animateText( targets, 'in', effect, beginCallback, completeCallback );
		};

		self.hideText = function( $selector, effect, beginCallback, completeCallback ) {
			var targets = [];

			$( 'span', $selector ).each( function() {
				targets.push(this);
			});

			self.animateText( targets, 'out', effect, beginCallback, completeCallback );
		};

		self.animateText = function( targets, direction, effect, beginCallback, completeCallback ) {
			var effectSettings   = self.avaliableEffects[ effect ] || {},
				animationOptions = effectSettings[ direction ],
				animeInstance = null;

			animationOptions.targets = targets;

			animationOptions.begin = beginCallback;
			animationOptions.complete = completeCallback;

			animeInstance = anime(animationOptions);
		};

		self.init = function() {
			var $text = $animatedTextList.eq( currentIndex );

			self.showText(
				$text,
				settings.effect,
				null,
				function() {
					self.textChange();
				}
			);
		};
	}

	/**
	 * Jet Images Layout Class
	 *
	 * @return {void}
	 */
	window.jetImagesLayout = function( $selector, settings ) {
		var self            = this,
			$instance       = $selector,
			$instanceList   = $( '.jet-images-layout__list', $instance ),
			$itemsList      = $( '.jet-images-layout__item', $instance ),
			defaultSettings = {},
			settings        = settings || {};

		/*
		 * Default Settings
		 */
		defaultSettings = {
			layoutType: 'masonry',
			columns: 3,
			columnsTablet: 2,
			columnsMobile: 1,
			justifyHeight: 300
		}

		/**
		 * Checking options, settings and options merging
		 */
		$.extend( defaultSettings, settings );

		/**
		 * Layout build
		 */
		self.layoutBuild = function() {
			switch ( settings['layoutType'] ) {
				case 'masonry':
					salvattore.init();
				break;
				case 'justify':
					$itemsList.each( function() {
						var $this          = $( this ),
							$imageInstance = $( '.jet-images-layout__image-instance', $this),
							imageWidth     = $imageInstance.data( 'width' ),
							imageHeight    = $imageInstance.data( 'height' ),
							imageRatio     = +imageWidth / +imageHeight,
							flexValue      = imageRatio * 100,
							newWidth       = +settings['justifyHeight'] * imageRatio,
							newHeight      = 'auto';

						$this.css( {
							'flex-grow': flexValue,
							'flex-basis': newWidth
						} );
					} );
				break;
			}

			$( '.jet-images-layout__image', $itemsList ).imagesLoaded().progress( function( instance, image ) {
				var $image      = $( image.img ),
					$parentItem = $image.closest( '.jet-images-layout__item' ),
					$loader     = $( '.jet-images-layout__image-loader', $parentItem );

				$parentItem.addClass( 'image-loaded' );

				$loader.fadeTo( 500, 0, function() {
					$( this ).remove();
				} );

			});
		}

		/**
		 * Init
		 */
		self.init = function() {
			self.layoutBuild();
		}
	}

	/**
	 * Jet Scroll Navigation Class
	 *
	 * @return {void}
	 */
	window.jetScrollNavigation = function( $selector, settings ) {
		var self            = this,
			$window         = $( window ),
			$instance       = $selector,
			$htmlBody       = $( 'html, body' ),
			$itemsList      = $( '.jet-scroll-navigation__item', $instance ),
			sectionList     = [],
			defaultSettings = {
			speed: 500,
			blockSpeed: 500,
			offset: 1,
			sectionSwitch: false
			},
			settings        = $.extend( {}, defaultSettings, settings ),
			sections        = {},
			isScrolling     = false,
			hash            = window.location.hash.slice(1),
			timeout         = null,
			timeStamp       = 0,
			platform        = navigator.platform;

		jQuery.extend( jQuery.easing, {
			easeInOutCirc: function (x, t, b, c, d) {
				if ((t/=d/2) < 1) return -c/2 * (Math.sqrt(1 - t*t) - 1) + b;
				return c/2 * (Math.sqrt(1 - (t-=2)*t) + 1) + b;
			}
		});

		/**
		 * Init
		 */
		self.init = function() {
			self.setSectionsData();

			// Add Events
			$( $itemsList ).on( 'click', self.onAnchorChange );

			$window.on( 'scroll.jetScrollNavigation', self.onScroll );
			$window.on( 'resize.jetScrollNavigation orientationchange.jetScrollNavigation', JetElementsTools.debounce( 50, self.onResize ) );

			if ( settings.sectionSwitch ) {
				if ( 'onwheel' in window ) {
					$window.on( 'mousewheel DOMMouseScroll', self.onWheel );
				}
			}

			if ( hash && sections[hash].invert ) {
				$itemsList.addClass( 'invert' );
			}

			for ( var section in sections ) {
				var $section = sections[section].selector;

				elementorFrontend.waypoint( $section, function( direction ) {
					var $this = $( this ),
						sectionId = $this.attr( 'id' );

						if ( 'down' === direction && ! isScrolling ) {
							window.history.pushState( null, null, '#' + sectionId );
							$itemsList.removeClass( 'active' );
							$( '[data-anchor=' + sectionId + ']', $instance ).addClass( 'active' );

							$itemsList.removeClass( 'invert' );

							if ( sections[sectionId].invert ) {
								$itemsList.addClass( 'invert' );
							}
						}
				}, {
					offset: '95%'
				} );

				elementorFrontend.waypoint( $section, function( direction ) {
					var $this = $( this ),
						sectionId = $this.attr( 'id' );

						if ( 'up' === direction && ! isScrolling ) {
							window.history.pushState( null, null, '#' + sectionId );
							$itemsList.removeClass( 'active' );
							$( '[data-anchor=' + sectionId + ']', $instance ).addClass( 'active' );

							$itemsList.removeClass( 'invert' );

							if ( sections[sectionId].invert ) {
								$itemsList.addClass( 'invert' );
							}
						}
				}, {
					offset: '0%'
				} );
			}
		};

		self.setSectionsData = function() {
			$itemsList.each( function() {
				var $this         = $( this ),
					sectionId     = $this.data('anchor'),
					sectionInvert = 'yes' === $this.data('invert') ? true : false,
					$section      = $( '#' + sectionId );

				if ( $section[0] ) {
					sections[ sectionId ] = {
						selector: $section,
						offset: Math.round( $section.offset().top ),
						height: $section.outerHeight(),
						invert: sectionInvert
					};
				}
			} );
		};

		self.onAnchorChange = function( event ) {
			var $this     = $( this ),
				sectionId = $this.data('anchor'),
				offset = sections[sectionId].offset - settings.offset;

			if ( ! isScrolling ) {
				isScrolling = true;
				window.history.pushState( null, null, '#' + sectionId );

				$itemsList.removeClass( 'active' );
				$this.addClass( 'active' );

				$itemsList.removeClass( 'invert' );

				if ( sections[sectionId].invert ) {
					$itemsList.addClass( 'invert' );
				}

				$htmlBody.stop().clearQueue().animate( { 'scrollTop': offset }, settings.speed, 'easeInOutCirc', function() {
					isScrolling = false;
				} );
			}
		};

		self.onScroll = function( event ) {
			/* On Scroll Event */
			if ( isScrolling ) {
				event.preventDefault();
			}
		};

		self.onWheel = function( event ) {

			if ( isScrolling ) {
				event.preventDefault();
				return false;
			}

			var $target       = $( event.target ),
				$section      = $target.closest( '.elementor-top-section' ),
				sectionId     = $section.attr( 'id' ),
				offset        = 0,
				newSectionId  = false,
				prevSectionId = false,
				nextSectionId = false,
				delta         = event.originalEvent.wheelDelta || -event.originalEvent.detail,
				direction     = ( 0 < delta ) ? 'up' : 'down';

			if ( sectionId && sections.hasOwnProperty( sectionId ) ) {

				prevSectionId = JetElementsTools.getObjectPrevKey( sections, sectionId );
				nextSectionId = JetElementsTools.getObjectNextKey( sections, sectionId );

				if ( 'up' === direction ) {
					if ( ! nextSectionId && sections[sectionId].offset < $(window).scrollTop() ) {
						newSectionId = sectionId;
					} else {
						newSectionId = prevSectionId;
					}
				}

				if ( 'down' === direction ) {
					if ( ! prevSectionId && sections[sectionId].offset > $(window).scrollTop() + 5 ) {
						newSectionId = sectionId;
					} else {
						newSectionId = nextSectionId;
					}
				}

				if ( newSectionId ) {
					event.preventDefault();
					isScrolling = true;

					if ( event.timeStamp - timeStamp > 10 && 'MacIntel' == platform ) {
						timeStamp = event.timeStamp;
						event.preventDefault();
						return false;
					}

					offset = sections[newSectionId].offset - settings.offset;
					window.history.pushState( null, null, '#' + newSectionId );

					$itemsList.removeClass( 'active' );
					$( '[data-anchor=' + newSectionId + ']', $instance ).addClass( 'active' );

					$itemsList.removeClass( 'invert' );

					if ( sections[newSectionId].invert ) {
						$itemsList.addClass( 'invert' );
					}

					self.scrollStop();
					$htmlBody.animate( { 'scrollTop': offset }, settings.blockSpeed, 'easeInOutCirc', function() {
						isScrolling = false;
					} );
				}
			}

		};

		self.onResize = function( event ) {
			self.setSectionsData();
		};

		self.scrollStop = function() {
			$htmlBody.stop( true );
			//$htmlBody.clearQueue();
		};

	}


}( jQuery, window.elementorFrontend ) );
