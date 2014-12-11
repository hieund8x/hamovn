jQuery(document).ready(function() {

lizatomInfobox();
lizatomTabsVertical();
lizatomTabsHorizontal();
lizatomAccordion();
lizatomSimpleTabs();
lizatomSpoiler();

//########################
// infobox close
//########################
function lizatomInfobox(){
			jQuery('.lizatom-infobox span.close-infobox').click(function() {
                jQuery(this).parents('.lizatom-infobox').fadeOut(800);
            });	
}            
//########################
// tabs vertical
//########################

function lizatomTabsVertical(){
    jQuery('.lizatom-tabs-vertical dd:first').addClass('current');
	jQuery('.lizatom-tabs-vertical dt:first').addClass('current');
	var tabs = jQuery('.lizatom-tabs-vertical');
	
	//jQuery('.lizatom-tabs-vertical dd.current').text(current_height);
	if(tabs.length < 1){
		return;
	}
	
	tabs.append("<span class='lizatom-tabs-vertical_arrow'></span>");
	tabs.each(function(){
		jQuery(this).children('dd:first').addClass('current');
		var self = jQuery(this);
		var handlers = self.children('dt');
		var tabContentBlocks = self.children('dd');
		var currentTab = tabContentBlocks.eq(0);	
		var arrow = self.children('span').eq(0);
		var handlersWidth = handlers.eq(0).outerWidth();
		var firstHandlerY = handlers.eq(0).position().top + handlers.eq(0).outerHeight() - 40;

		var current_height = jQuery('.lizatom-tabs-vertical dd.current').get(0).scrollHeight;
	    jQuery(currentTab).parent().css( 'height', current_height + 'px' );

		arrow.css({'left': handlersWidth-17 + 'px', 'top': firstHandlerY + 'px'});
		handlers.click(function(){
			var self = jQuery(this);		
			currentTab.prev().removeClass('current');
			currentTab.fadeOut('fast');
			currentTab = self.next();
			var minus = self.index() == 0 ? 40 : self.outerHeight()/2 + 20;
			arrowY = self.position().top + self.outerHeight() - minus;
			arrow.animate({'top':arrowY + 'px'});
			currentTab.fadeIn('slow');
			self.addClass('current');
		
			var current_height_tabs = currentTab.parent().prop('scrollHeight');	
			var current_height_tab = currentTab.prop('scrollHeight');	
		    
			if( current_height_tab > current_height_tabs ) {	
        		currentTab.parent().css( 'height', current_height_tab  + 'px' );
			}

		});
	});
}

//########################
// tabs horizontal
//########################

function lizatomTabsHorizontal(){
    jQuery('.lizatom-tabs-horizontal dd:first').addClass('current');
	jQuery('.lizatom-tabs-horizontal dt:first').addClass('current');
	var tabs = jQuery('.lizatom-tabs-horizontal');
	if(tabs.length <  1){
		return;
	}
	tabs.append("<span class='lizatom-tabs-horizontal_arrow'></span>");
	tabs.each(function(){
		jQuery(this).children('dd:first').addClass('current');
		var self = jQuery(this);
		var handlers = self.children('dt');
		var tabContentBlocks = self.children('dd');
		var currentTab = tabContentBlocks.eq(0);
		var arrow = self.children('span').eq(0);
		var handlersWidth = handlers.eq(0).outerWidth();
		var firstHandlerY = handlers.eq(0).position().top + handlers.eq(0).outerHeight() - 18;

		var current_height = jQuery('.lizatom-tabs-horizontal dd.current').get(0).scrollHeight;
	    jQuery(currentTab).parent().css( 'height', current_height + 'px' );

		arrow.css({'left': handlersWidth/2 - 7 + 'px'});
		handlers.click(function(){
			var self = jQuery(this);
			currentTab.prev().removeClass('current');
			currentTab.fadeOut('fast');
			currentTab = self.next();
			//var minus = self.index() == 0 ? 18 : self.outerHeight()/2 + 18;
			arrowY = self.position().left + (self.outerWidth() /2) - 2;
			arrow.animate({'left':arrowY + 'px'});
			currentTab.fadeIn('slow');
			self.addClass('current');

			var current_height_tabs = currentTab.parent().prop('scrollHeight');	
			var current_height_tab = currentTab.prop('scrollHeight');	
		    //self.text(current_height_tab);		
        	currentTab.parent().css( 'height', current_height_tab  + 'px' );
		
		});
	});
}

//########################
// accordion
//########################
function lizatomAccordion(){
	var accordions = jQuery('.lizatom-accordion');
	if(accordions.length < 1){
		return;
	}
	accordions.each(function(){
		var self = jQuery(this);
		var handlers = self.children('dt');
		handlers.click(function(){
			var self = jQuery(this);
			self.children('dt.current').removeClass('current').next().slideUp();
			self.toggleClass('current');
			self.next('dd').slideToggle();
		});
	});
}

//########################
// simpleTabs
//########################
function lizatomSimpleTabs(){	
	jQuery('.lizatom-simpletabs-nav').delegate('span:not(.lizatom-simpletabs-current)', 'click', function() {
		jQuery(this).addClass('lizatom-simpletabs-current').siblings().removeClass('lizatom-simpletabs-current')
		.parents('.lizatom-simpletabs').find('.lizatom-simpletabs-pane').hide().eq(jQuery(this).index()).show();
	});
	jQuery('.lizatom-simpletabs-pane').hide();
	jQuery('.lizatom-simpletabs-nav span:first-child').addClass('lizatom-simpletabs-current');
	jQuery('.lizatom-simpletabs-panes .lizatom-simpletabs-pane:first-child').show();
}

//########################
// spoiler
//########################
function lizatomSpoiler(){
	jQuery('.lt-spoiler').removeClass('lt-spoiler-open');
	jQuery('.lt-spoiler .lt-spoiler-title').click(function() {
		jQuery(this).parent('.lt-spoiler').toggleClass('lt-spoiler-open');
	});
}

});
