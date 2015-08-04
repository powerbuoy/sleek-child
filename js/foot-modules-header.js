// Since the header exists on every page, we run our global JS fom here
App.modules.Header = {
	init: function () {
		// Adds "has-scrolled", "scrolling-down" etc to <html> (for styling purposes)
		ScrollClasses.init();

		// Hijaxes all form.ajax
	//	AjaxForms.init('form.ajax');

		// Zooms all img-links 
	//	ImageZoom.init(document.body);

		// Some nice utlities for input[type=range]
	//	InputRangeUtils.values(); // Display value of input next to label
	//	InputRangeUtils.colors(red, green); // Different colors on left/right side

		// Live Ajax Search
	//	LiveSearch.init(document.querySelector('input[name=s]'), '/?s=', 'after');

		// Smoothly scroll #in-page-links
	//	SmoothScrolling.init(20); // 20 = offset from top

		// Expands code blocks on hover
	//	HoverExpand.init();
	}
};
