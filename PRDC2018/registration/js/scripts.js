
$(document).ready(function(){/* activate sidebar */
	$('#sidebar').affix({
	  offset: {
		top: 235
	  }
	});

	/* activate scrollspy menu */
	var $body   = $(document.body);
	var navHeight = $('.navbar').outerHeight(true) + 10;

	$body.scrollspy({
		target: '#leftCol',
		offset: navHeight
	});

	/* smooth scrolling sections */
	$('a[href*=#]:not([href=#])').click(function() {
		if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
		  var target = $(this.hash);
		  target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
		  if (target.length) {
			$('html,body').animate({
			  scrollTop: target.offset().top - 50
			}, 1000);
			return false;
		  }
		}
	});

	/* check required attr for ieee member num in registration */
	$("#reg_type").change(function(){
		var opt_selected = $("#reg_type option:selected").attr("value");
		if(0 == opt_selected || 2 == opt_selected ||  4 == opt_selected || 6 == opt_selected){
			$("#member_num").attr("required", "required");
		}
		else{
			$("#member_num").removeAttr("required");
		}
	});

	$('.confirm').click(function(){
		console.log('confirming entry ' + $(this).data('orderid'));
		$('#form_' + $(this).data('orderid')).submit();
	});


	$('.unconfirm').click(function(){
		$('#targetForm').val($(this).data('orderid'));
		$('#myModal').modal();
	});

	$('#unconfirm_btn').click(function(){
		if("ec428" == $('#unconfirm_passcode').val()){
			console.log('unconfirming entry ' + $('#targetForm').val());
			$('#form_' + $('#targetForm').val()).submit();
		}
		else{
			alert('Invalid Passcode!');
		}
	});

});
