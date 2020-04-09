$(function(e) {


	var inputFields = $("input:text, input:tel, input:email");
	inputFields.focus(function(){
		$(this).css("box-shadow", "0 0 4px #fc0303");
	});

	inputFields.blur(function() {
		$(this).css("box-shadow", "none");
	})


});