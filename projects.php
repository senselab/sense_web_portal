<?php
	include_once("common.php");

	$projects = array(
		"2017_fusion",
		"sdn",
		"2014_mdm",
		"2014_microapp",
		"nimble",
		"eagleeye",
		"2013_vmteleport",
		"2017_nicble",
		"2018_hypersweep"
	);
?>
<!DOCTYPE html>
<html lang="en">
<!-- header -->
<head>
<?php	bootstrap_header(); ?>
<title>Projects - SENSE: SEcurity aNd SystEms</title>
</head>
<!-- body -->
<body role="document">
<?php	navbar("projects");	?>
<!-- main body -->
<div class="container theme-showcase" role="main">

<?php
	// permutation
	$n = sizeof($projects);
	$n2 = $n / 2;
	for($i = 0; $i < $n2; $i++) {
		$f = rand() % $n;
		$t = rand() % $n;
		if($f == $t)
			$t = ($t + 1) % $n;
		$tmp = $projects[$f];
		$projects[$f] = $projects[$t];
		$projects[$t] = $tmp;
	}
	//
	for($i = 0; $i < sizeof($projects); $i++) {
		echo '<div class="well">';
		$fn = "projects/" . $projects[$i] . ".php";
		include($fn);
		echo '</div>' . "\n";
	}
?>

<!-- template
<div class="well"><?php include("projects/template.php"); ?></div>
-->

</div><!-- container -->
<?php	footer();	?>
<?php	load_script();	?>
</body>
</html>
