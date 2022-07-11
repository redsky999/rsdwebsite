;(function ($, window, document, undefined) {
	'use strict';

	if (typeof fitVids === 'function') {
		$('body').fitVids({ignore: '.vimeo-video, .youtube-simple-wrap iframe, .iframe-video.for-btn iframe, .post-media.video-container iframe'});
	}

	/*=================================*/
	/* PAGE CALCULATIONS */
	/*=================================*/
	/**
	 *
	 * PageCalculations function
	 * @since 1.0.0
	 * @version 1.0.0
	 * @var winW
	 * @var winH
	 * @var winS
	 * @var pageCalculations
	 * @var onEvent
	 **/
	if (typeof pageCalculations !== 'function') {

		var winW, winH, winS, pageCalculations, onEvent = window.addEventListener;

		pageCalculations = function (func) {

			winW = window.innerWidth;
			winH = window.innerHeight;
			winS = document.body.scrollTop;

			if (!func) return;

			onEvent('load', func, true); // window onload
			onEvent('resize', func, true); // window resize
			onEvent("orientationchange", func, false); // window orientationchange

		}; // end pageCalculations

		pageCalculations(function () {
			pageCalculations();
		});
	}


	$(window).on('load', function () {
		if ($('.outsourceo-preloader').length) {
			$('.outsourceo-preloader').fadeOut(400);
		}

		wpc_add_img_bg('.s-img-switch');
	});

	function calcPaddingMainWrapper() {

		if ($('.outsourceo-footer').length) {
			var footer    = $('.outsourceo-footer');
			var paddValue = footer.outerHeight();

			footer.bind('heightChange', function () {
				$('body').css('padding-bottom', paddValue);

			});

			footer.trigger('heightChange');
		}
	}


	function blogIsotope() {
		if ($('.outsourceo-blog--isotope').length) {
			$('.outsourceo-blog--isotope').each(function () {
				var self = $(this);
				self.isotope({
					itemSelector: '.outsourceo-blog--post',
					layoutMode: 'masonry',
					masonry: {
						columnWidth: '.outsourceo-blog--post'
					}
				});
			});
		}
	}

	function wpc_add_img_bg(img_sel, parent_sel) {
		if (!img_sel) {
			return false;
		}

		var $parent, $imgDataHidden, _this;
		$(img_sel).each(function () {
			_this          = $(this);
			$imgDataHidden = _this.data('s-hidden');
			$parent        = _this.closest(parent_sel);
			$parent        = $parent.length ? $parent : _this.parent();
			$parent.css('background-image', 'url(' + this.src + ')').addClass('s-back-switch');
			if ($imgDataHidden) {
				_this.css('visibility', 'hidden');
				_this.show();
			}
			else {
				_this.hide();
			}
		});
	}

	function adminBarPositionFix() {
		if ($('#wpadminbar').length) {
			$('#wpadminbar').css('position', 'fixed');
		}
	}

	function errorPageHeight() {
		if ($('.outsourceo-error--wrap').length) {
			var footerH = $('.outsourceo-footer').length ? $('.outsourceo-footer').outerHeight() : 0,
				headerH = $('.outsourceo-header--wrap').length ? $('.outsourceo-header--wrap').outerHeight() : 0,
				errorH  = $(window).height() - footerH - headerH;

			$('.outsourceo-error--wrap').outerHeight(errorH);
		}
	}

	$('.aht-page__socials__icon').on('click', function () {
		$(this).toggleClass('active');
	});

	$('[data-share]').on('click', function (event) {
		event.preventDefault();

		let w          = window,
			url        = this.getAttribute('data-share'),
			title      = '',
			w_pop      = 600,
			h_pop      = 600,
			scren_left = w.screenLeft != undefined ? w.screenLeft : screen.left,
			scren_top  = w.screenTop != undefined ? w.screenTop : screen.top,
			width      = w.innerWidth,
			height     = w.innerHeight,
			left       = ((width / 2) - (w_pop / 2)) + scren_left,
			top        = ((height / 2) - (h_pop / 2)) + scren_top,
			newWindow  = w.open(url, title, 'scrollbars=yes, width=' + w_pop + ', height=' + h_pop + ', top=' + top + ', left=' + left);

		if (w.focus) {
			newWindow.focus();
		}

		return false;
	});

	$(window).on('load resize orientationchange', function () {
		calcPaddingMainWrapper();
		blogIsotope();
		adminBarPositionFix();
		errorPageHeight();
	});


})(jQuery, window, document);