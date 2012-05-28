$(document).ready(function() {
	// create box parts
	var mask = $('<div id="mask"></div>');
	var box = $('<div id="box"></div>');
	var cDiv = $('<div id="boxContent"></div');
	var modal = $('div[name=modal]');
	var title = $(modal).attr('title');
	var head = $('<div id="head"></div>');
	var close = $("<div id='close' title='Click to close, or press Esc'></div>");
	var a = $("a[name=modal]");
	var content = $(modal).contents();

	// create modal box
	mask.appendTo("body");
	box.appendTo("body");
	if(!title) {
		close.appendTo(mask);
	} else {
		head.html("<h3>"+title+"</h3>").appendTo(box);
		close.appendTo(mask);
	}
	cDiv.html(content);
	cDiv.appendTo(box);

	// get the document's width and height and edit the CSS of the mask (back)
	// to fit the user's screen settings
	var mW = $(document).width();
	var mH = $(document).height();
	mH = mH - 35 + "px";
	$(mask).css({'width':mW,'height':mH});

	// get the window's width and height, then edit the CSS to center the box
	var wW = $(window).width();
	var wH = $(window).height();
	var bW = box.outerWidth();
	var bH = box.outerHeight();
	var sT = $(window).scrollTop();
	var sL = $(window).scrollLeft();
	box.css({
		'top' : ((wH - bH) / 2) + sT + "px",
		'left' : ((wW - bW) / 2) + sL + "px"
	});

	// fix the close button, use the wW and wH from earlier
	close.css({
		'top' : ((wH - bH) / 2) + sT - 13 + "px",
		'left' : ((wW - bW) / 2) + sL - 13 + "px"
	});

	// open the modal box via the anchor tag with the name modal
	a.click(function() {
		mask.fadeIn('slow');
		box.fadeIn('slow');
		return false;
	});

	// close when the X button is clicked
	close.click(function() {
		mask.fadeOut('slow');
		box.fadeOut('slow');
		return false;
	});

	// close when the mask is clicked
	mask.click(function() {
		$(this).fadeOut('slow');
		box.fadeOut('slow');
	});
});

// close if escape key is pressed
$(document).keyup(function(e) {
	if(e.keyCode==27) {
		$('#mask').fadeOut('slow');
		$('#box').fadeOut('slow');
	}
});
