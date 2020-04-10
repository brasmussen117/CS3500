$(function() {
	// highlightArtist
	$('#headliners .card').on('click', highlightArtist);

	// artistMouseOver
	$('#headliners .card').on('mouseenter', artistMouseOver);

	// artistMouseOut
	$('#headliners .card').on('mouseleave', artsitMouseOut);
});

function highlightArtist (e) {
	console.log('card clicked');
	// push everything else to back
	$('body')
		.blur()
		.css('zIndex','-1');

	// setup vars
	var highlightAlt = 	$(this).find("img").attr("alt");
	var highlightSrc = $(this).find("img").attr("src");
	var bigSrc = "";
	var index = highlightSrc.indexOf("sm_crop");
	if (index > 1) {
		bigSrc = highlightSrc.replace("sm_crop","full");
	} else {
		bigSrc = highlightSrc.replace("sm","full");
	}
	

	// create the modal
	var highlightModal = $(
		'<div id="highlightModal" class="modal-content">' +
			'<div class="modal-header text-center">' + 
				'<h4>' + highlightAlt + '</h4>' + // modal header
				'<button type="button" class="close" data-dismiss="modal">Exit <i class="far fa-times-circle"></i></button>' +
			'</div>' + 
			'<div class="modal-body">' +
				'<img src="' + bigSrc + // img src
				'" class="modal-content" style="width:100%" alt="' + 
				highlightAlt + // img alt
				'">' +
			'</div>' +
		'</div>'
	);

	// make div to blur background
	var blurry = $(
		'<div id="blurry"></div>'
	);

	// put the modal on the page
	$('body')
		.prepend(blurry)
		.prepend(highlightModal);

	// make the page fit the window
	$('body').css('height', "100%");

	// put obscuring div behind modal, style it, listen on it for click
	$('#blurry')
		.prependTo('body')
		.css({
			position: "fixed",
			zIndex: "0",
			backgroundColor: "black",
			opacity: "0.5",
			height: "100%"
			})
		.click(function(e) {
			$("#highlightModal").remove()
			$('#blurry').remove();
		});

	// put listener on exit icon to close highlightCard
	$("#highlightModal button")
		.on('click', function(e) {
			$("#highlightModal")
				.slideUp("slow")
				// .remove();
			})
			$('#blurry').slideUp("slow");
	;
	// style div and listener for focusout
	$("#highlightModal")
		.css({
			zIndex: '1',
			position : 'absolute',
			height: "100%"
		})
		.on('focusout', function(e){
			console.log('focusout highlight')
			$("#highlightModal").remove()
			$('#blurry').remove();
			})
	;
}

function artistMouseOver (e) {
	// console.log('mouseover ' + $(this).find("img").attr("alt"));
	$(this).attr('class', 'card bg-white text-black');
}

function artsitMouseOut (e) {
	// console.log('mouseout ' + $(this).find("img").attr("alt"));
	$(this).attr('class', 'card bg-black text-white');
}