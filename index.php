<?php
	include_once("common.php");
?>
<!DOCTYPE html>
<html lang="en">
<!-- header -->
<head>
	<?php	bootstrap_header(); ?>
	<title>SENSE: SEcurity aNd SystEms</title>
	
	<style>
		#slideshow {
			position:relative;
			height:350px;
		}

		#slideshow IMG {
			margin: auto;
			width: 100%;
			position:absolute;
			top:0;
			left:0;
			z-index:8;
		}

		#slideshow IMG.active {
			z-index:10;
		}

		#slideshow IMG.last-active {
			z-index:9;
		}
	</style>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	
	<script>
		function slideSwitch() {
			var $active = $('#slideshow IMG.active');

			if ( $active.length == 0 ) $active = $('#slideshow IMG:last');

			var $next =  $active.next().length ? $active.next()
				: $('#slideshow IMG:first');

			$active.addClass('last-active');
				
			$next.css({opacity: 0.0})
				.addClass('active')
				.animate({opacity: 1.0}, 1000, function() {
					$active.removeClass('active last-active');
				});
		}

		function sliderheight(){
			divHeight = $('#slideshow IMG.active').height();
			$('#slideshow').css({'height' : divHeight});
		}
    		
		$(function() {
			setInterval( "slideSwitch()", 5000 );
			$(window).resize(sliderheight);			
			sliderheight();
		});	
	</script>

</head>
<!-- body -->
<body role="document">
<?php	navbar();	?>
<!-- main body -->
<div class="container theme-showcase" role="main">
<!--
	<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
	
	<ol class="carousel-indicators">
		<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
		<li data-target="#carousel-example-generic" data-slide-to="1"></li>
		<li data-target="#carousel-example-generic" data-slide-to="2"></li>
	</ol>
	
	<div class="carousel-inner" role="listbox">
		<div class="item active">
			<img src="images/mountain_us.jpg"/>
		</div>

		<div class="item">
			<img src="images/mountain_ms.jpg"/>
		</div>

		<div class="item">
			<img src="images/bird_s.jpg"/>
		</div>
	</div>

-->

	<div id="slideshow">
		<img src="images/mountain_us.jpg" alt="" class="active" />
		<img src="images/mountain_ms.jpg" alt="" />
		<img src="images/bird_s.jpg" alt="" />
	</div>

	<div class="page-header">
		<h1>Welcome!</h1>
	</div>

	<div class="bs-callout bs-callout-info">
	At SENSE Lab, we are a group of enthusiasts dedicated to research in security and systems. We build systems that will stand firmly in harsh and adversarial environments.
	</div>

	<div class="bs-callout bs-callout-info">
	SENSE Lab is located at EC528 and EC223A, Engineering Building III, on the National Yang Ming Chiao Tung University campus.
	</div>

</div><!-- container -->
<?php	footer();	?>
<?php	load_script();	?>
<script type="text/javascript" src="lib/holder/holder.min.js"></script>

<!-- Start of StatCounter Code for Default Guide -->
	<script type="text/javascript">
	var sc_project=10861407; 
	var sc_invisible=1; 
	var sc_security="148a1df5"; 
	var scJsHost = (("https:" == document.location.protocol) ?
	"https://secure." : "http://www.");
	document.write("<sc"+"ript type='text/javascript' src='" +
	scJsHost+
	"statcounter.com/counter/counter.js'></"+"script>");
	</script>
	<noscript><div class="statcounter"><a title="web analytics"
	href="http://statcounter.com/" target="_blank"><img
	class="statcounter"
	src="//c.statcounter.com/10861407/0/148a1df5/1/" alt="web
	analytics"></a></div></noscript>
<!-- End of StatCounter Code for Default Guide -->

</body>
</html>
