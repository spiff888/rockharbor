/* These scripts are for everything IE 8 and below */

(function($) {
	$(document).ready(function() {
		// fix for lack of nth-child support
		$('#access ul li div.submenu.cols2 ul:nth-child(2n+2)').addClass('nthreset');
		$('#access ul li div.submenu.cols2 ul:nth-child(3n+3)').addClass('nthreset');
		$(".stories-2 .story-box:nth-child(2n+2)").addClass('nthreset');
		$(".stories-3 .story-box:nth-child(3n+3)").addClass('nthreset');
		$(".stories-4 .story-box:nth-child(4n+4)").addClass('nthreset');
		$(".home #frontpage-sidebar aside:nth-child(odd)").addClass('nthreset');
		$(".home #frontpage-sidebar aside:nth-child(even)").addClass('nthreset');
	});
}(jQuery))
