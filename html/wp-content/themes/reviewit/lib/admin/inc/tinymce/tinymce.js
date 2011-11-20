function init() {
	tinyMCEPopup.resizeToInnerSize();
}

function getCheckedValue(radioObj) {
	if(!radioObj)
		return "";
	var radioLength = radioObj.length;
	if(radioLength == undefined)
		if(radioObj.checked)
			return radioObj.value;
		else
			return "";
	for(var i = 0; i < radioLength; i++) {
		if(radioObj[i].checked) {
			return radioObj[i].value;
		}
	}
	return "";
}

function insertghostpoolLink() {
	
	var tagtext;

	var style = document.getElementById('style_panel');
	
		var styleid = document.getElementById('style_shortcode').value;
		if (styleid != 0 ){
			tagtext = "["+ styleid + "]Insert your text here[/" + styleid + "]";
		}
		
		if (styleid != 0 && styleid == 'button' ){
			tagtext = "["+ styleid + " link=\"#\"]Read More[/" + styleid + "]";	
		}	
		
		if (styleid != 0 && styleid == 'toggle' ){
			tagtext = "["+ styleid + " title=\"#\"]Insert your text here[/" + styleid + "]";	
		}

		if (styleid != 0 && styleid == 'bq_left') {
			tagtext = "["+ styleid + "]Insert your text here[/" + styleid + "] ";	
		}
		
		if (styleid != 0 && styleid == 'bq_right') {
			tagtext = "["+ styleid + "]Insert your text here[/" + styleid + "] ";	
		}

		if (styleid != 0 && styleid == 'contact') {
			tagtext = "["+ styleid + " email=\"#\" /] ";	
		}
		
		if (styleid != 0 && styleid == 'divider') {
			tagtext = "["+ styleid + " /] ";
		}
		
		if (styleid != 0 && styleid == 'top') {
			tagtext = "["+ styleid + " /] ";
		}
		
		if (styleid != 0 && styleid == 'clear') {
			tagtext = "["+ styleid + " /] ";
		}

		if (styleid != 0 && styleid == 'video') {
			tagtext = "["+ styleid + " name=\"#\" url=\"#\" image=\"\" width=\"470\" height=\"320\" align=\"alignnone\" controlbar=\"bottom\" autostart=\"false\" stretching=\"fill\" icons=\"true\" /] ";	
		}
		
		if (styleid != 0 && styleid == 'two') {
			tagtext = "["+ styleid + "]Insert your text here[/" + styleid + "] ["+ styleid + "_last]Insert your text here[/" + styleid + "_last] ";	
		}		

		if (styleid != 0 && styleid == 'three') {
			tagtext = "["+ styleid + "]Insert your text here[/" + styleid + "] ["+ styleid + "_middle]Insert your text here[/" + styleid + "_middle] ["+ styleid + "_last]Insert your text here[/" + styleid + "_last] ";	
		}		

		if (styleid != 0 && styleid == 'four') {
			tagtext = "["+ styleid + "]Insert your text here[/" + styleid + "] ["+ styleid + "_middle]Insert your text here[/" + styleid + "_middle] ["+ styleid + "_middle]Insert your text here[/" + styleid + "_middle] ["+ styleid + "_last]Insert your text here[/" + styleid + "_last] ";	
		}	

		if (styleid != 0 && styleid == 'onethird') {
			tagtext = "["+ styleid + "]Insert your text here[/" + styleid + "] [twothirds_last]Insert your text here[/twothirds_last] ";	
		}	

		if (styleid != 0 && styleid == 'twothirds') {
			tagtext = "["+ styleid + "]Insert your text here[/" + styleid + "] [onethird_last]Insert your text here[/onethird_last] ";	
		}
		
		if (styleid != 0 && styleid == 'onefourth') {
			tagtext = "["+ styleid + "]Insert your text here[/" + styleid + "] [threefourths_last]Insert your text here[/threefourths_last] ";	
		}
		
		if (styleid != 0 && styleid == 'threefourths') {
			tagtext = "["+ styleid + "]Insert your text here[/" + styleid + "] [onefourth_last]Insert your text here[/onefourth_last] ";	
		}	
		
		if ( styleid == 0 ){
			tinyMCEPopup.close();
		}
	
	if(window.tinyMCE) {
		//TODO: For QTranslate we should use here 'qtrans_textarea_content' instead 'content'
		window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, tagtext);
		//Peforms a clean up of the current editor HTML. 
		//tinyMCEPopup.editor.execCommand('mceCleanup');
		//Repaints the editor. Sometimes the browser has graphic glitches. 
		tinyMCEPopup.editor.execCommand('mceRepaint');
		tinyMCEPopup.close();
	}
	return;
}
