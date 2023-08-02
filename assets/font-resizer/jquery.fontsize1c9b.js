var customVar = jQuery.noConflict();
customVar.fn.fontresizermanager = function () {

    var fontResizer_value = customVar('#fontResizer_value').val();
    var fontResizer_ownid = customVar('#fontResizer_ownid').val();
    var fontResizer_ownelement = customVar('#fontResizer_ownelement').val();
    var fontResizer_resizeSteps = customVar('#fontResizer_resizeSteps').val();
    var fontResizer_cookieTime = customVar('#fontResizer_cookieTime').val();
    var fontResizer_maxFontsize = customVar('#fontResizer_maxFontsize').val();
    var fontResizer_element = fontResizer_value;
 
	if(fontResizer_value == "innerbody") {
		fontResizer_element = "div#innerbody";
	} else if(fontResizer_value == "ownid") {
		fontResizer_element = "div#" + fontResizer_ownid;
	} else if(fontResizer_value == "ownelement") {
		fontResizer_element = fontResizer_ownelement;
	}

	var startFontSize = parseFloat(customVar(fontResizer_element+"").css("font-size"));
	var savedSize = customVar.cookie('fontSize');
	if(savedSize > 4) {
		customVar(fontResizer_element).css("font-size", savedSize + "px");
	}

	customVar('.fontResizer_add').css("cursor","pointer");
	customVar('.fontResizer_minus').css("cursor","pointer");
	customVar('.fontResizer_reset').css("cursor","pointer");

	// Increase font size
	var i=0;
	var j=0;
	customVar('.fontResizer_add').click(function(event) {
		if(i<2){
		     i++;
			 j--;	
			
			
		event.preventDefault();
		var newFontSize = parseFloat(customVar(fontResizer_element+"").css("font-size"));
		newFontSize=newFontSize+parseFloat(fontResizer_resizeSteps);
		if( newFontSize <= fontResizer_maxFontsize || fontResizer_maxFontsize == 0 || fontResizer_maxFontsize == '' ) {
			customVar(fontResizer_element+"").css("font-size",newFontSize+"px");
			customVar.cookie('fontSize', newFontSize, {expires: parseInt(fontResizer_cookieTime), path: '/'});
		}
		}
	});
   
	// Decrease font size
	customVar('.fontResizer_minus').click(function(event) {
		 if(j<2){
			j++;
			i--;
		event.preventDefault();
		var newFontSize = parseFloat(customVar(fontResizer_element+"").css("font-size"))
		newFontSize=newFontSize-fontResizer_resizeSteps;
		customVar(""+fontResizer_element+"").css("font-size",newFontSize+"px");			 
		customVar.cookie('fontSize', newFontSize, {expires: parseInt(fontResizer_cookieTime), path: '/'});
		}
	});

	// Reset font size
	customVar('.fontResizer_reset').click(function(event) {
		i=0;
		j=0;
		event.preventDefault();
		customVar(""+fontResizer_element+"").css("font-size",startFontSize);			 
		customVar.cookie('fontSize', startFontSize, {expires: parseInt(fontResizer_cookieTime), path: '/'});
	});

	// Accessibility stuff
	customVar('.fontResizer_minus, .fontResizer_reset, .fontResizer_add').keypress(function (e) {
	var key = e.which;
		if(key == 13) {
			$(this).click();
			return false;  
		}
	});

}
