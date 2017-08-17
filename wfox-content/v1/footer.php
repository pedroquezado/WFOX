	<div id="wfox-footer">
		<p>Blog modelo construído para <a href="#">WFOX</a> por <a href="#">@pedro_quezado</a>.</p>
		<p><a href="#">De volta ao topo</a></p>
	</div>
	<script>
	var slideIndex = 0;
	carousel();

	function carousel() {
	    var i;
	    var x = document.getElementsByClassName("dl-slide");
	    for (i = 0; i < x.length; i++) {
	      x[i].style.display = "none"; 
	    }
	    slideIndex++;
	    if (slideIndex > x.length) {slideIndex = 1} 
	    x[slideIndex-1].style.display = "block"; 
	    setTimeout(carousel, 10000); // 10 SEGUNDOS
	}
	</script>
</body>
</html>
