//***************************** Theme Option Tabs *****************************//

jQuery(document).ready(function(){
	// We can use this object to reference the panels container
	var panelContainer = jQuery('div#panels');
	// Create a DIV for the tabs and insert it before the panel container
	jQuery('<div id="tabs"></div>').insertBefore(panelContainer);
	
	// Find panel names and create nav
	// -- Loop through each panel
	panelContainer.find('div.panel').each(function(n){
		// For each panel, create a tab
		jQuery('div#tabs').append('<a class="tab" href="#' + (n+1) + '">' + jQuery(this).attr('title') + '</a>');
	});
	
	// Determine which tab should show first based on the URL hash
	var panelLocation = location.hash.slice(1);
	if(panelLocation){
		var panelNum = panelLocation;
	}else{
		var panelNum = '1';
	}
	// Hide all panels
	panelContainer.find('div.panel').hide();
	// Display the initial panel
	panelContainer.find('div.panel:nth-child(' + panelNum + ')').fadeIn('slow');
	// Change the class of the current tab
	jQuery('div#tabs').find('a.tab:nth-child(' + panelNum + ')').removeClass().addClass('tab-active');
	
	// What happens when a tab is clicked
	// -- Loop through each tab
	jQuery('div#tabs').find('a').each(function(n){
		// For each tab, add a 'click' action
		jQuery(this).click(function(){
			// Hide all panels
			panelContainer.find('div.panel').hide();
			// Find the required panel and display it
			panelContainer.find('div.panel:nth-child(' + (n+1) + ')').fadeIn('slow');
			// Give all tabs the 'tab' class
			jQuery(this).parent().find('a').removeClass().addClass('tab');
			// Give the clicked tab the 'tab-active' class
			jQuery(this).removeClass().addClass('tab-active');
		});
	});
});