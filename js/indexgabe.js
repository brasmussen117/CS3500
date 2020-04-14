// Window load event
 window.addEventListener("load", function() {
 	
var heading = document.getElementById('indexheading');
var heading2 = document.getElementById('indexheading2');

 heading.addEventListener("click", function (e) {
 	console.log(e);
 	console.log(e.target);
 	e.target.style.backgroundColor = 'red';
 })
 heading2.addEventListener("click", function (e) {
 	console.log(e);
 	console.log(e.target);
 	e.target.style.backgroundColor = 'red';
 })

document.getElementById("figcaption").innerHTML="Best place on earth... Colorado Springs";
 
})