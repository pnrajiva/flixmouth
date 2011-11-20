/*************************** Menu ***************************/

function mainmenu(){
jQuery("#nav ul li a").removeAttr("title");
jQuery("#nav ul a").removeAttr("title");
jQuery("#nav ul li:first-child").addClass("nav-first");
jQuery("#nav ul li:last-child").addClass("nav-last");
jQuery("#nav ul ul ").css({display: "none"}); // Opera Fix
jQuery("#nav ul li").hover(function(){
		jQuery(this).find('ul:first').css({visibility: "visible",display: "none"}).show(0);
		},function(){
		jQuery(this).find('ul:first').css({visibility: "hidden"});
		});
}
  
jQuery(document).ready(function(){					
	mainmenu();
});


/*************************** Lightbox ***************************/

jQuery(document).ready(function(){
	jQuery("div.gallery-item .gallery-icon a").attr("rel", "prettyPhoto[gallery]");
	jQuery("a[rel^='prettyPhoto']").prettyPhoto({
		theme: 'light_square',
		animationSpeed: 'fast',
		keyboard_shortcuts: false,
		social_tools: ''
	});
});


/*************************** Image Preloader ***************************/

jQuery(function () {
	jQuery('.preload').hide();
});

var i = 0;
var int=0;
jQuery(window).bind("load", function() {
	var int = setInterval("doThis(i)",500);
});

function doThis() {
	var images = jQuery('.preload').length;
	if (i >= images) {
		clearInterval(int);
	}
	jQuery('.preload:hidden').eq(0).fadeIn(500);
}


/*************************** Switch Display ***************************/

jQuery(document).ready(function(){
	jQuery("#display-compact").click(function() {
	jQuery("#display-compact").toggleClass("swap");
	jQuery(".review-display").fadeOut("fast", function() {
	jQuery(this).fadeIn("fast").addClass("review-box-top-compact");
	jQuery(this).fadeIn("fast").removeClass("review-box-top-extended");
	jQuery.cookie("display_cookie", "compact");
	});
});
});

jQuery(document).ready(function(){
	jQuery("#display-extended").click(function() {
	jQuery("#display-extended").toggleClass("swap");
	jQuery(".review-display").fadeOut("fast", function() {
	jQuery(this).fadeIn("fast").addClass("review-box-top-extended");
	jQuery(this).fadeIn("fast").removeClass("review-box-top-compact");
	jQuery.cookie("display_cookie", "extended");
	});
});
});


/*************************** Toggle Content ***************************/

jQuery(document).ready(function(){
jQuery(".toggle-box").hide(); 

jQuery(".toggle").toggle(function(){
	jQuery(this).addClass("toggle-active");
	}, function () {
	jQuery(this).removeClass("toggle-active");
});

jQuery(".toggle").click(function(){
	jQuery(this).next(".toggle-box").slideToggle();
});
});


/*************************** Tabs ***************************/

jQuery(document).ready(function(){
	// We can use this object to reference the panels container
	var panelContainer = jQuery('div#panels');
	
	// Find panel names and create nav
	// -- Loop through each panel
	panelContainer.find('.panel').each(function(n){
		// For each panel, create a tab
		jQuery('div#tabs-box ul').append('<li class="tab"><a href="#' + (n+1) + '">' + jQuery(this).attr('title') + '</a></li>');
	});
	
	// Determine which tab should show first based on the URL hash	
	var panelLocation = location.hash.slice(1);
		if(panelLocation == '1'){
			var panelNum = panelLocation;
		} else if(panelLocation == '2'){
			var panelNum = panelLocation;
		} else if(panelLocation == '3'){
			var panelNum = panelLocation;
		} else if(panelLocation == '4'){
			var panelNum = panelLocation;
		} else if(panelLocation == '5'){
			var panelNum = panelLocation;
		} else if(panelLocation == '6'){
			var panelNum = panelLocation;
		} else if(panelLocation == '7'){
			var panelNum = panelLocation;
		} else if(panelLocation == '8'){
			var panelNum = panelLocation;			
		} else if(panelLocation == '9'){
			var panelNum = panelLocation;			
		} else if(panelLocation == '10'){
			var panelNum = panelLocation;
		}else{
			var panelNum = '1';
		}	
	// Hide all panels
	panelContainer.find('div.panel').hide();
	// Display the initial panel
	panelContainer.find('div.panel:nth-child(' + panelNum + ')').fadeIn('slow');
	// Change the class of the current tab
	jQuery('div#tabs-box ul').find('li.tab:nth-child(' + panelNum + ')').removeClass().addClass('tab-active');
	
	// What happens when a tab is clicked
	// -- Loop through each tab
	jQuery('div#tabs-box ul').find('li').each(function(n){
		// For each tab, add a 'click' action
		jQuery(this).click(function(){
			// Hide all panels
			panelContainer.find('div.panel').hide();
			// Find the required panel and display it
			panelContainer.find('div.panel:nth-child(' + (n+1) + ')').fadeIn('slow');
			// Give all tabs the 'tab' class
			jQuery(this).parent().find('li').removeClass().addClass('tab');
			// Give the clicked tab the 'tab-active' class
			jQuery(this).removeClass().addClass('tab-active');
		});
	});
});


/*************************** Contact Form ***************************/

jQuery(document).ready(function(){
	
	jQuery('#contact-form').submit(function() {

		jQuery('.contact-error').remove();
		var hasError = false;
		jQuery('.requiredFieldContact').each(function() {
			if(jQuery.trim(jQuery(this).val()) == '') {
				jQuery(this).addClass('input-error');
				hasError = true;
			} else if(jQuery(this).hasClass('email')) {
				var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
				if(!emailReg.test(jQuery.trim(jQuery(this).val()))) {
					jQuery(this).addClass('input-error');
					hasError = true;
				}
			}
		});
	
	});
				
	jQuery('#contact-form .contact-submit').click(function() {
		jQuery('.loader').css({display:"block"});
	});	

});