<?php
	function bootstrap_header() {
		/* from: http://getbootstrap.com/examples/theme/ */
?>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<!--<link rel="icon" href="favicon.ico"/>-->
<!-- bootstrap -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous"/>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous"/>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<link href="lib/theme/ie10-viewport-bug-workaround.css" rel="stylesheet"/>
<!-- font awesome -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<!-- custom bootstrap theme -->
<link href="lib/theme/theme.css" rel="stylesheet">
<link href="lib/theme/callout.css" rel="stylesheet">
<link href="lib/custom.css" rel="stylesheet">
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<?php
	}

	function footer() {
?>
<footer class="footer">
	<div class="container">
	<hr/>
<p class="text-muted">&copy; 2008-2019
Laboratory of SEcurity aNd SystEms <br/>
Department of Computer Science, National Chiao Tung University<br/></p>
	</div>
</footer>
<?php
	}

	function load_script() {
?>
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<!--<script src="lib/theme/docs.min.js"></script>-->
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="lib/theme/ie10-viewport-bug-workaround.js"></script>
<?php
	}

	function navbar($active = "home") {
?>
<!-- Fixed navbar -->
<nav class="navbar navbar-inverse navbar-fixed-top">
<div class="container">
<div class="navbar-header">
	<!-- for mobile toggle button -->
	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
		<span class="sr-only">Toggle navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	</button>
      <!--<a class="navbar-brand" href="#">SENSE Group</a>-->
	<a class="navbar-brand" href="#"><img src="images/sense_s.png"/></a>
</div>
<div id="navbar" class="navbar-collapse collapse">
	<ul class="nav navbar-nav">
	<li<?= $active == "home" ? ' class="active"' : '' ?>><a href="index.php">Home</a></li>
	<li<?= $active == "members" ? ' class="active"' : '' ?>><a href="members.php">Members</a></li>
	
	<li<?= $active == "pubs" ? ' class="active"' : '' ?>><a href="pubs.php">Publications</a></li>
	<!--<li<?= $active == "courses" ? ' class="active"' : '' ?>><a href="#courses">Courses</a></li>-->
	<li class="dropdown">
	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Services<span class="caret"></span></a>
		<ul class="dropdown-menu">
		<!--<li role="separator" class="divider"></li>
		<li class="dropdown-header">Courses</li>-->
		<!-- <li><a href="https://codesensor.tw/">CodeSensor</a></li> -->
		<!--<li><a href="#">Another action</a></li>
		<li><a href="#">Something else here</a></li>
		<li role="separator" class="divider"></li>
		<li class="dropdown-header">External resources</li>
		<li><a href="#">Separated link</a></li>
		<li><a href="#">One more separated link</a></li>-->
		</ul>
	</li>
	</ul>
</div><!--/.nav-collapse -->
</div>
</nav>
<?php
	}
?>
