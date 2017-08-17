	<div class="n_w">
		<div id="vip-footer">
			<p>WFOX © 2017</p>
			<p>Por Pedro Quezado</p>
		</div>
	</div>
	<script>
	/*var slideIndex = 0;
	carousel();

	function carousel() {
	    var i;
	    var x = document.getElementsByClassName("slider-glow");
	    var dots = document.getElementsByClassName("demo");
	    for (i = 0; i < x.length; i++) {
	      x[i].style.display = "none"; 
	    }
	    slideIndex++;
	    for (i = 0; i < dots.length; i++) {
		    dots[i].className = dots[i].className.replace(" w3-white", "");
		}
	    if (slideIndex > x.length) {slideIndex = 1}
	    if (n < 1) {slideIndex = x.length}
	    x[slideIndex-1].style.display = "block";
		dots[slideIndex-1].className += " w3-white";
	    setTimeout(carousel, 10000); // 10 SEGUNDOS
	}*/

	var slideIndex = 1;
	showDivs(slideIndex);

	function plusDivs(n) {
	  showDivs(slideIndex += n);
	}

	function currentDiv(n) {
	  showDivs(slideIndex = n);
	}

	function showDivs(n) {
	  var i;
	  var x = document.getElementsByClassName("slider-glow");
	  var dots = document.getElementsByClassName("glob-line");
	  if (n > x.length) {slideIndex = 1}    
	  if (n < 1) {slideIndex = x.length}
	  for (i = 0; i < x.length; i++) {
	     x[i].style.display = "none";  
	  }
	  for (i = 0; i < dots.length; i++) {
	     dots[i].className = dots[i].className.replace(" glob-active", "");
	  }
	  x[slideIndex-1].style.display = "block";  
	  dots[slideIndex-1].className += " glob-active";
	}
	</script>
</body>
</html>
