// Window load event
$(function() {

 // Multiple event handling
 var imgList = document.getElementsByClassName('mediaphoto');


 imgList.forEach(function(img) {
 	img.addEventListener("mouseover", function(e) {
 		e.target.style.display = "none";
 	})

 	img.addEventListener("mouseout", function(e) {
 		e.target.style.display = 'inline';
 	})
 });
 
});