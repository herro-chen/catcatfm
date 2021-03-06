// Fix iPhone viewport scaling bug on orientation change
// By @mathias, @cheeaun and @jdalton
if (navigator.userAgent.match(/iPhone|iPad/i)) {
	(function(doc){
		var addEvent = 'addEventListener', type = 'gesturestart', qsa = 'querySelectorAll', scales = [1, 1], meta = qsa in doc ? doc[qsa]('meta[name=viewport]') : [];
		function fix() {
			meta.content = 'width=device-width,minimum-scale=' + scales[0] + ',maximum-scale=' + scales[1];
			doc.removeEventListener(type, fix, true);
		}
		if (( meta = meta[meta.length - 1]) && addEvent in doc) {
			fix();
			scales = [.25, 1.6];
			doc[addEvent](type, fix, true);
		}
	}(document));
}

/////////////////////////////////////////////
// Themify Timeline Script
/////////////////////////////////////////////
var ThemifyTimeLine = {
	init: function(config){
		// private
		if(typeof(timeline_query_posts) === 'undefined'){
			timeline_query_posts = {cat: '', posts_per_page: '', ajax_query: '', post_value: ''};
		}
		this.posts_cat = timeline_query_posts.cat;
		this.posts_page = timeline_query_posts.posts_per_page;
		this.ajax_query = timeline_query_posts.ajax_query;
		this.post_value = timeline_query_posts.post_value;

		// public
		this.config = config;
		this.setupJumpNav();
		this.setupInfinite();
		this.bindEvents();
		this.setupInnerLoadTitle();
	},

	bindEvents: function(){
		this.config.calendarNav.live('click', this.calendarClicked);
		jQuery(this.config.loadMore).live('click', this.loadMoreClicked);
		jQuery(this.config.triggerMore).live('click', this.triggerMoreClicked);
	},

	setupJumpNav: function(){
		this.config.calendarNav.each(function(index) {
			jumper = '#' + jQuery(this).attr('data-jump');
			if( jQuery(jumper).length > 0 ){
				jQuery(this).attr('href', jumper);
			}
		});
	},

	setupInnerLoadTitle: function() {
		jQuery(this.config.container).find('.date-placeholder-story').each(function(){
			var title = jQuery(this).closest('.timeline-set-month').find('.timeline-month span').text();
			jQuery(this).text(title);
		});
	},

	getDocHeight: function(){
		var D = document;
    return Math.max(
		    Math.max(D.body.scrollHeight, D.documentElement.scrollHeight),
		    Math.max(D.body.offsetHeight, D.documentElement.offsetHeight),
		    Math.max(D.body.clientHeight, D.documentElement.clientHeight)
		);
	},

	setupInfinite: function(){
		var self = ThemifyTimeLine;
		
		// add class next-load-queue to the main timeline set
		jQuery(self.config.container).find('.unexpand').first().addClass('next-load-queue');

		// apply class expanded to the first element
		jQuery(self.config.container).find('.timeline-set-month').first().addClass('expanded');

		// hide all inner load more
		if(self.config.autoInfinite){
			jQuery(self.config.triggerMore).hide();
		}

		jQuery(self.config.container).ajaxStart(function() {
		  jQuery(self.config.loadMore).addClass('main-load-more-disabled');
		  jQuery(self.config.triggerMore).addClass('inner-loader-disabled');
		});

		// hack damn IE !!
		if(jQuery.browser.msie && parseInt(jQuery.browser.version, 10) == 7) {
			//Do something
			setInterval(function() {
			  // Do something every 5 seconds
			  jQuery(self.config.loadMore).removeClass('main-load-more-disabled');
			}, 5000);
		}

		// check whether auto infinite active or not
		if(self.config.autoInfinite){
			
			// inner load more trigger
			jQuery(self.config.innerScrollTrigger).bind('inview', function (event, visible, topOrBottomOrBoth) {
				if (visible == true) {
			    // element is now visible in the viewport
			    if (topOrBottomOrBoth == 'top')
			    {
			      // top part of element is visible
			    }
			    else if (topOrBottomOrBoth == 'bottom')
			    {
			      // bottom part of element is visible
			    }
			    else
			    {
			      // whole part of element is visible
			      jQuery(this).find('a').trigger('click').addClass('inner-loader-disabled');
			    }
			  } else {
			    // element has gone out of viewport
			  }
			});
			
			// main load more trigger
			jQuery(self.config.loadMoreContainer).bind('inview', function (event, visible, topOrBottomOrBoth) {
			  if (visible == true) {
			    // element is now visible in the viewport
			    if (topOrBottomOrBoth == 'top')
			    {
			      // top part of element is visible
			    }
			    else if (topOrBottomOrBoth == 'bottom')
			    {
			      // bottom part of element is visible
			    }
			    else
			    {
			    	if(!jQuery(self.config.loadMore).hasClass('main-load-more-disabled')){
				    	jQuery(self.config.loadMore).trigger('click').addClass('main-load-more-disabled');
				    }
			    }
			  } else {
			    // element has gone out of viewport
			  }
			});

			jQuery(self.config.loadMore).parent().hide();

		}
	},

	calendarClicked: function(e){
		var self = ThemifyTimeLine,
				_this = jQuery(this),
				jumpID = jQuery('#' + jQuery(this).data('jump')),
				month = jQuery(this).data('month'),
				year = jQuery(this).data('year');

		if(jumpID.parent().hasClass('timeline-disable')){

			// disable main load more
			jQuery(self.config.loadMore).addClass('main-load-more-disabled');

			// clear next load queue
			jQuery(self.config.container).find('.next-load-queue').removeClass('next-load-queue');

			jumpID.parent().removeClass('timeline-disable').parent().removeClass('unexpand').addClass('expanded').show();
			jQuery('html,body').animate({ scrollTop: jQuery(this.hash).offset().top - 100 }, 500);
			jumpID.parents('.timeline-set-month').find(self.config.triggerMore).trigger('click');

			// disable inner load more
			jQuery(self.config.innerScrollVisible).find('a').addClass('inner-loader-disabled').show();

			jumpID.parents('.timeline-set-month').find('.inner-scroll-trigger').addClass('inner-scroll-visible');

			jumpID.parents('.timeline-content').find('.expanded').last().next('.unexpand').addClass('next-load-queue');
		}
		else{
			jQuery('html,body').animate({ scrollTop: jQuery(this.hash).offset().top - 100 }, 500);
		}

		e.preventDefault();
	},

	loadMoreClicked: function(e){
		var self = ThemifyTimeLine;

		// disable load more being clicked when it has class disabled
		if(jQuery(this).hasClass('main-load-more-disabled')){
			return false;
		}

		// remove class next load if have reach end
		if(jQuery(self.config.container).find('.timeline-set-month').last().hasClass('expanded')){
			jQuery(self.config.container).find('.timeline-set-month').last().removeClass('next-load-queue');
		}

		var nextQueue = jQuery(self.config.container).find('.next-load-queue').first();
		nextQueue.find('.timeline-month').removeClass('timeline-disable');
		nextQueue.removeClass('unexpand').addClass('expanded').show().find('.trigger-more').trigger('click');
		nextQueue.removeClass('next-load-queue');
		nextQueue.next('.unexpand').addClass('next-load-queue');

		// if no more queue then hide it (#load-more a), just hide it no remove
		if(jQuery(self.config.container).find('.next-load-queue').length == 0){
			jQuery(this).parent().hide();
		}

		e.preventDefault();
	},

	triggerMoreClicked: function(e){
		var self = ThemifyTimeLine,
				_this = jQuery(this),
				container = jQuery(this).closest('.timeline-set-month').find('.set-month'),
				parentId = jQuery(this).parent().attr('id');

		if(jQuery(this).hasClass('inner-loader-disabled')){
			return false;
		}

		var posts_ids = [];
		container.find('.post-load-queue').each(function(i){
			if( i < timeline_query_posts.posts_per_page ) {
				var post_id = jQuery(this).data('post-id');
				posts_ids.push(post_id);
			}
		});

		// remove inner load more if there is no more posts to load
		if(posts_ids.length == 0) {
			_this.parent().remove();
			return false;
		}
		
		jQuery.ajax({
      type: "POST",
      url: themifyScript.timeLineAjaxUrl,
      dataType: 'html',
      data:
      {
        action : 'timeline_add_element',
        post_ids : posts_ids,
        posts_page : timeline_query_posts.posts_per_page,
        timeline_ajax_request: 1,
        timeline_load_nonce : themifyScript.timeline_load_nonce,
      },
      beforeSend: function( xhr ){
      	jQuery(self.config.loader).clone().insertAfter(jQuery(container)).addClass('loader-' + parentId);
      },
      success: function( data ){
        
        var $newElems = jQuery(data);
				var $container = container;
				$newElems.hide().imagesLoaded( function(){
					jQuery(this).show();
					jQuery(window).smartresize(function(){
						var viewport = jQuery(window).width();
			    	if(viewport > 585){
			    		var layoutMode = 'spineAlign';
			    	}
			    	else{
			    		var layoutMode = 'masonry';
			    		jQuery('.post-arrow').hide();
							jQuery('.post-dot').fadeOut();
			    	}
			    	
				    $container.isotope({
							resizable: false,
							layoutMode: layoutMode,
							spineAlign: {
								gutterWidth: 0
							},
							itemSelector : '.post',
							transformsEnabled : false
						});
				    // trigger resize so isotope layout is triggered
				  }).smartresize();
	        $container.isotope('insert', $newElems).isotope('reLayout'); // use method insert
	        jQuery(window).resize();

					jQuery(self.config.loadMore).removeClass('main-load-more-disabled');
			    jQuery('.loader-' + parentId).remove();
			    jQuery(self.config.triggerMore).removeClass('inner-loader-disabled');

			    jQuery(self.config.innerScrollVisible).find('a').removeClass('inner-loader-disabled');

			    if(jQuery(window).scrollTop() + jQuery(window).height() > self.getDocHeight() - 100) {
			    	jQuery('html,body').animate({ scrollTop: jQuery(window).scrollTop() - 150 }, 100);
		      }

		      // remove posts load queue
		      // post-load-queue-
		      for (var i = 0; i < posts_ids.length; i++) {
						jQuery('.post-load-queue-' + posts_ids[i]).remove();
					}

	      }); // images load end

      }
    });

		e.preventDefault();
	}
};

jQuery(document).ready(function($) {

	/////////////////////////////////////////////
	// Initialize Themify Timeline Script
	/////////////////////////////////////////////
	ThemifyTimeLine.init({
		container: '#content .timeline-content',
		timeLineMonth: '.timeline-content .timeline-month',
		calendarNav: $('.timeline-nav .jump-month'),
		isotopeContainer: '.timeline-content .set-month',
		loader: $('<div id="infscr-loading" style="text-align: center;"><img src="'+ themifyScript.loadingImg +'" alt="Loading..."></div>'),
		innerScrollTrigger: '.inner-scroll-trigger',
		triggerMore: '.trigger-more',
		loadMoreContainer: '#timeline-load-more',
		loadMore: '#timeline-load-more a',
		innerScrollVisible: '.inner-scroll-visible',
		autoInfinite: ( 'auto' == themifyScript.autoInfinite ) ? true : false
	});

	/////////////////////////////////////////////
	// Initialize Isotope init
	/////////////////////////////////////////////
	var $container = jQuery('#content .set-month');
	$container.imagesLoaded( function(){
    jQuery(window).smartresize(function(){
    	var viewport = jQuery(window).width();
    	if(viewport > 585){
    		var layoutMode = 'spineAlign';
    	}
    	else{
    		var layoutMode = 'masonry';
    		jQuery('.post-arrow').hide();
				jQuery('.post-dot').fadeOut();
    	}

	    $container.isotope({
				resizable: false,
				layoutMode: layoutMode,
				spineAlign: {
					gutterWidth: 0
				},
				itemSelector : '.post',
				transformsEnabled : false
			}).isotope('reLayout');
	    // trigger resize so isotope layout is triggered
	  }).smartresize();
		jQuery(window).resize();
  });

	$('.timeline-nav-months').hide();
	$('.timeline-nav-year:not(.nav-yearly)').click(function(e){
		e.preventDefault();
		$('.timeline-nav-months').not($(this).parent().children('.timeline-nav-months')).slideUp();
		$(this).parent().children('.timeline-nav-months').slideToggle();
	});


	/////////////////////////////////////////////
	// HTML5 placeholder fallback
	/////////////////////////////////////////////
	$('[placeholder]').focus(function() {
		var input = $(this);
		if (input.val() == input.attr('placeholder')) {
			input.val('');
			input.removeClass('placeholder');
		}
	}).blur(function() {
		var input = $(this);
		if (input.val() == '' || input.val() == input.attr('placeholder')) {
			input.addClass('placeholder');
			input.val(input.attr('placeholder'));
		}
	}).blur();
	$('[placeholder]').parents('form').submit(function() {
		$(this).find('[placeholder]').each(function() {
			var input = $(this);
			if (input.val() == input.attr('placeholder')) {
				input.val('');
			}
		})
	});

	/////////////////////////////////////////////
	// Scroll to top
	/////////////////////////////////////////////
	$('.back-top a').click(function() {
		$('body,html').animate({
			scrollTop : 0
		}, 800);
		return false;
	});

	/////////////////////////////////////////////
	// Toggle menu on mobile
	/////////////////////////////////////////////
	$("#menu-icon").click(function() {
		$("#headerwrap #main-nav").fadeToggle();
		$("#headerwrap #searchform").hide();
		$(this).toggleClass("active");
	});

	/////////////////////////////////////////////
	// Toggle searchform on mobile
	/////////////////////////////////////////////
	$("#search-icon").click(function() {
		$("#headerwrap #searchform").fadeToggle();
		$("#headerwrap #main-nav").hide();
		$('#headerwrap #s').focus();
		$(this).toggleClass("active");
	});

	/////////////////////////////////////////////
	// Scroll Fixed jQuery
	/////////////////////////////////////////////
	$('.timeline-nav-wrap').scrollToFixed({marginTop: 100});
	
});

// custom layout mode spineAlign
jQuery.Isotope.prototype._spineAlignReset = function() {
	this.spineAlign = {
		colA: 0,
		colB: 0
	};
};

jQuery.Isotope.prototype._spineAlignLayout = function( $elems ) {
	var instance = this,
		props = this.spineAlign,
		gutterWidth = Math.round( this.options.spineAlign && this.options.spineAlign.gutterWidth ) || 0,
		centerX = Math.round(this.element.width() / 2);
	
	$elems.each(function(){
		var $this = jQuery(this),
			isColA = props.colB > props.colA,
			x = isColA ?
				centerX + gutterWidth / 2 : // left side
				centerX - ( $this.outerWidth(true) + gutterWidth / 2 ), // right side
			y = isColA ? props.colA : props.colB;
		instance._pushPosition( $this, x, y );
		props[( isColA ? 'colA' : 'colB' )] += $this.outerHeight(true);
		if('0px' != $this.css('left') && '1px' != $this.css('left')){	
			$this.addClass('alt');
		} else {
			$this.removeClass('alt');
		}
		jQuery('.post-arrow', $this).show();
		jQuery('.post-dot', $this).fadeIn();
	});
};

jQuery.Isotope.prototype._spineAlignGetContainerSize = function() {
	var size = {};
	size.height = this.spineAlign[( this.spineAlign.colB > this.spineAlign.colA ? 'colB' : 'colA' )];
	return size;
};

jQuery.Isotope.prototype._spineAlignResizeChanged = function() {
	return true;
};

jQuery(window).load(function() {
	
	var $isotopeContainer = jQuery('.grid4 #content .loops-wrapper, .grid3 #content .loops-wrapper, .grid2 #content .loops-wrapper');
	
	// isotope init
	$isotopeContainer.isotope({
		itemSelector : '.post',
		transformsEnabled : false
	});
	jQuery(window).resize();
  
});