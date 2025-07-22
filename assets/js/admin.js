(function ($) {
    "use strict";
	
	 document.addEventListener('DOMContentLoaded', function ( ) {
		const link = document.querySelector('a[href="themes.php?page=custom_documentation_link"]');
		if (link) {
			link.setAttribute('href', 'https://docs.xpertpointthemes.com/masterwp/');
			link.setAttribute('target', '_blank');
			link.setAttribute('rel', 'noopener noreferrer');
		}
	});
	
})(jQuery);