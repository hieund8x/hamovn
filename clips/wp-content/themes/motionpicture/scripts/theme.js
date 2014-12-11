function slide_frame(frame_no, new_frame, div){
	container = jQuery(div).parent().children("ul");

	image_container = jQuery(div).parent().parent().children(".gallery-container");

	//Fade Out
	container.children("li").eq(frame_no).fadeOut({duration: 250});
	image_container.children("li").eq(frame_no).fadeOut({duration: 350});

	//Set Dot
	jQuery(".dot-selected").removeClass("dot-selected");
	container.parent().children(".slider-dots").children("a").eq(new_frame).addClass("dot-selected");

	//Fade In
	slideTimeout = setTimeout(function(){
		container.children("li").eq(new_frame).fadeIn({duration: 250});
	}, 250);

	slideTimeout = setTimeout(function(){
		image_container.children("li").eq(new_frame).fadeIn({duration: 350});
	}, 350);
}

function clear_auto_slide(){
	jQuery("div[id^='slider-auto-']").each(function(){
		if(!isNaN(jQuery(this).text()) && jQuery(this).text() !== "0" && jQuery(this).text() !== "")
			{clearInterval(SliderInterval);}
	});
}

jQuery(document).ready(function()
	{
		if(jQuery.browser.msie || jQuery.browser.mozilla)
			{Screen = jQuery("html");}
		else
			{Screen = jQuery("body");}

		jQuery.frame_no = 0;
		jQuery("div[id^='slider-auto-']").each(function(){
			if(!isNaN(jQuery(this).text()) && jQuery(this).text() !== "0" && jQuery(this).text() !== "")
				{

					var frame_div = jQuery(this).parent().children("div[id^='slider-number-']")
					var div = jQuery(this).parent().children(".copy").children("ul");
					var max_clicks = div.children("li").size();

					SliderInterval = setInterval(function(){
						frame_no = frame_div.text();
						new_frame = (frame_no/1+1);
						if(new_frame == max_clicks){new_frame = 0;}

						slide_frame(frame_no, new_frame, div);

						jQuery(frame_div).text(new_frame);
					}, (jQuery(this).text()*1000));
				}
		});

		jQuery("iframe, object").mouseover(function(){clear_auto_slide();});

		jQuery(".slider .copy .next").click(function(){
			container = jQuery(this).parent().children("ul");
			max_clicks = container.children("li").size();

			var frame_div = jQuery(this).parent().parent().children("div[id^='slider-number-']")
			var frame_no = frame_div.text();
			var div = jQuery(this);

			new_frame = (frame_no/1+1);
			if(new_frame == max_clicks){new_frame = 0;}

			slide_frame(frame_no, new_frame, div);

			jQuery(frame_div).text(new_frame);

			clear_auto_slide();

			return false;
		});

		jQuery(".slider .copy .previous").click(function(){
			container = jQuery(this).parent().children("ul");
			max_clicks = container.children("li").size();

			var frame_div = jQuery(this).parent().parent().children("div[id^='slider-number-']")
			var frame_no = frame_div.text();
			var div = jQuery(this);

			new_frame = (frame_no/1-1);
			if(new_frame < 0){new_frame = (max_clicks-1), frame_no = 0;}

			slide_frame(frame_no, new_frame, div);

			frame_div.text(new_frame);

			clear_auto_slide();

			return false;
		});

		jQuery(".slider-dots a").click(function(){
			var frame_div = jQuery(this).parent().parent().parent().children("div[id^='slider-number-']")
			var frame_no = frame_div.text();
			var div = jQuery(this).parent().parent();

			new_frame = jQuery(this).attr("rel");

			slide_frame(frame_no, new_frame, div);
			frame_div.text(new_frame);

			clear_auto_slide();

			return false;
		});

		jQuery.video_frame = 1;
		jQuery(".latest-videos .pagination .next").click(function(){
			i = ((jQuery.video_frame/1)+1);
			vidmax = jQuery("[id^='video_widget_']").size();

			if(vidmax < i)
				i = 1;

			new_videoid = "#video_widget_"+i;
			old_videoid = "#video_widget_"+jQuery.video_frame;

			jQuery("[rel='"+old_videoid+"']").fadeOut({duration: 400});
			setTimeout(function(){jQuery("[rel='"+new_videoid+"']").fadeIn()}, 500);

			newleft = (i*(-300)+300)+"px";


			jQuery(".latest-videos .content").animate({"left": newleft},{duration: 500});

			jQuery.video_frame = i;
			return false;
		});
		jQuery(".latest-videos .pagination .previous").click(function(){
			i = ((jQuery.video_frame/1)-1);

			if(i < 1)
				i = 1;

			new_videoid = "#video_widget_"+i;
			old_videoid = "#video_widget_"+jQuery.video_frame;

			jQuery("[rel='"+old_videoid+"']").fadeOut({duration: 400});
			setTimeout(function(){jQuery("[rel='"+new_videoid+"']").fadeIn()}, 500);

			newleft = (i*(-300)+300)+"px";

			jQuery(".latest-videos .content").animate({"left": newleft},{duration: 500});

			jQuery.video_frame = i;
			return false;
		});

		/*--------------------------------------------*/
		/*- RESPONSIVE -------------------------------*/
		/*--------------------------------------------*/
		jQuery("#menu-drop-button").bind("click", function(){
			jQuery("#nav").slideToggle();
			return false;
		});

		/*--------------------------------------------*/
		/*- EQUAL HEIGHT JQUERY ----------------------*/
		/*--------------------------------------------*/
		fix_heights(jQuery('#widget-block .widget-list .content'));
		fix_heights(jQuery('.three-column li .content-copy'));

	});

function fix_heights($selector) {
	var width = jQuery(window).width();  

	if (width < 600  ) {
		return;
	}

	var tallest = 0,
		elements = new Array(),
		$el;

	$selector.each(function() {
		$el = jQuery(this);
		elements.push($el);
		tallest = (tallest < $el.height()) ? $el.height() : tallest;
	}); // for each selector

	for (i = 0; i < elements.length; i++) {
		elements[i].css({'minHeight': tallest});
	} // for each element
} // fix_heights