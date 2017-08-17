$(function() {

	$('.lw_titulo').click(function (e) {
		e.preventDefault();

		var loc = "_" + this.id;
		
		if(this.id == 'lwOfer'){
			if($('.'+loc).hasClass('_viewNone')){

				$("."+loc).removeClass("_viewNone");
				$("."+loc).addClass("_view");

				$("._lwProm").removeClass("_view");
				$("._lwProm").addClass("_viewNone");

			}

			$('#lwOfer').addClass("active");
			$('#lwProm').removeClass("active");
		}

		if(this.id == 'lwProm'){
			if($('.'+loc).hasClass('_viewNone')){

				$("."+loc).removeClass("_viewNone");
				$("."+loc).addClass("_view");

				$("._lwOfer").removeClass("_view");
				$("._lwOfer").addClass("_viewNone");

			}

			$('#lwProm').addClass("active");
			$('#lwOfer').removeClass("active");
		}
		
	});

	$('.dropdown span').click(function (e) {
		e.preventDefault();
		if($('.dropdown-content').hasClass('_active')){
			$('.prod_link span').removeClass("_act");
			$('.dropdown-content').removeClass("_active");
		} else {
			$('.prod_link span').addClass("_act");
			$('.dropdown-content').addClass("_active");
		}
	});


	/*
    var div = $(".dropdown-content"); // seleciona a div específica
    $("body").on("click", function (e) {
        if (div.has(e.target).length || e.target == div[0]){
        	return;
        } else {
        	if($('.dropdown-content').hasClass('_active')){
				$('.dropdown-content').removeClass("_active");
			}
        }
    });
    */

});