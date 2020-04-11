$(function() {

$('#text').blur(function(event){
	$(this).css({"background-color":"blue"})
})

$('#phone').change(function(event){
	$(this).css({"background-color":"red"})
})

$('#email').blur(function(event){
	$(this).css({"background-color":"green"})
})

});