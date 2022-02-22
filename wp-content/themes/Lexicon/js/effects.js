jQuery(document).ready(function() {
   
    jQuery('.arc-cover .col-md-6:nth-child(2n+0)').after('<div class="clear"></div>')
    jQuery('#related_posts ul li:nth-child(even)').after('<div class="clear"></div>')
	jQuery("#topnav, #subnav").tinyNav({
		active: 'selected', // String: Set the "active" class
		header: 'Navigation', // String: Specify text for "header" and show header instead of the active item
		indent: '- ', // String: Specify text for indenting sub-items
		label: '' // String: Sets the <label> text for the <select> (if not set, no label will be added)
	});

   jQuery(function($) {
	    var placeholders = {
	      'author': 'Name*',
	      'url': 'Website',
	      'email': 'Email*',
	      'comment': 'Your comment'
	    };
  
	    // Sets the HTML5 placeholders
	    for(var id in placeholders){jQuery("#"+id).attr("placeholder",placeholders[id])}

	    // Polyfill to add support for browsers like IE<=9
	    if(document.createElement("input").placeholder===undefined){jQuery("html").attr("data-placeholder-focus","false");jQuery.getScript("//jamesallardice.github.io/Placeholders.js/assets/js/placeholders.jquery.min.js",function(){jQuery(function(){var e=window.module.lp.form.data.validationRules;var t=window.module.lp.form.data.validationMessages;lp.jQuery.validator.addMethod("notEqual",function(e,t,n){return this.optional(t)||jQuery(t).attr("data-placeholder-active")!=="true"||e!==n},function(e,n){return t[jQuery(n).attr("id")].required});for(var n in placeholders){if(jQuery("#"+n).length){if(typeof t[n].required!=="undefined"){e[n].notEqual=placeholders[n]}else{e[n]={}}}}})})}
	  
  });

});