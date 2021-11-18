<?php
	include_once("common.php");

	$faculty = array(
		"吳育松", "chunying"
	);

	$current = array(
		"張秉洋", "朱雁瑜", "林柏均", "戴宏諺",
		"陳廷宇", "趙彬智", "莊秉璿", "邱鈺雯",
		"黃振宏", "蔡坤哲", "陳徹", "郭宗儀", "江昆逸", "孔憲文",
		"吳旻杰",
		"張禾金",
		"謝立德",
		"Sanoop Mallissery",
		"李泓暐"
	);

	$alumni = array(
		"呂翰漳",
		"鮑俊安",
		"彭珮婷",
		"巫政葳",
		"林宗毅",
		"林煒淳",
		"郎宇傑", "黃德賢", "藍建元", "邱肇珩",

		"盛宇航", "詹家鴻", "賴文揚", 	"陳冠廷",


		"鐘彥杰", "黃昭銘", "鄭允真", "連培知", "楊凱均",
		"林國宣",

		"蔡孟谷",
		"鄭炳忠",
		"謝智皓",
		"盧威寰",
		
		"林仲儀",
		"汪欣誼",
		"王威擎",
		"黃冠智",
		"黃靖宇",
		"吳佩禎",
		"許嘉鋒",
		"薛淑文",
		"鍾興璇",
		"高端廷",

		// 2015-2017
		"陳業良",
		"李穎欣",
		"洪聿昕",
		"黃俊魁",
		"舒俊維",
		"Ken Chang",
		// 2014-2016
		"王亮鈞",
		"Patrick Ngai",
		"林東岳",
		"王傑民",
		"張培軒",
		// 2013-2015
		"伍立鈞",
		"林威勝",
		"盧炫宏",
		"邱奕斌",
		// 2012-2014
		"呂峻權",
		"張佑嘉",
		"蘇育暄",
		"鄭又瑞",
		"陳義永",
		// 2011-2013
		"呂松澤",
		"蔡孟儒",
		"蔡宗翰",
		"許晏峻",
		// 2010-2012
		"石　穎",
		"孫培耕",
		"賴敘方",
		"黃俊祺" /*,
		// undergraduate project students
		// 2014
		"蔡傳資",
		"胡喬峰",
		"李汶洋",
		"陳業良",
		// 2013
		"古耕竹",
		"孫羽柔",
		"李唯民",
		"林東岳",
		"王傑民",
		"王永慶",
		"謝閔凱",
		"鄧子瑋",
		"陳思頴",
		"黃冠智",
		"Joel Rosales",
		"Marissa Mathurin",
		// 2012
		"林晉平",
		"張逸",
		"蘇庭昱",
		// 2011
		"余其龍",
		"曹文豪",
		"梁嘉碧",
		"高宏任",
		"黃泰順",
		// 2010
		"張庭瑋",
		"李韻立",
		"胡　悅"*/
	);

	function render_member(&$list) {
		for($i = 0; $i < sizeof($list); $i++) {
			if($i % 3 == 0) {
				echo "\n" . '<!-- begin row --><div class="row">' . "\n";
			}
			echo '<!-- #'. $i .' --><div class="col-md-4 col-sm-6 col-xs-12"><div class="media">' . "\n";
			$fn = "members/profiles/" . $list[$i] . "/index.php";
			include($fn);
			echo '</div></div>' . "\n";
			if($i % 3 == 2) {
				echo '<!-- end row --></div>';
			}
		}

		if($i % 3 != 0) {
			echo '<!-- end row --></div>';
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<!-- header -->
<head>
<?php	bootstrap_header(); ?>
<title>Members - SENSE: SEcurity aNd SystEms</title>
<style>
img.media-object {
	margin-bottom: 24px;
}
</style>
</head>
<!-- body -->
<body role="document">
<?php	navbar("members");	?>
<!-- main body -->
<div class="container theme-showcase" role="main">
<!-- XXX: put content here -->
<div class="page-header">
<h3>Group Leaders</h3>
</div>

<!-- faculty -->
<?php	render_member($faculty); ?>

<div class="page-header">
<h3>Current Students</h3>
</div>

<!-- current -->
<?php	render_member($current); ?>

<div class="page-header">
<h3>Alumni</h3>
</div>

<!-- alumni -->
<?php	render_member($alumni); ?>

</div>
<?php	footer();	?>
<?php	load_script();	?>
<script type="text/javascript" src="lib/jquery.lazyload.min.js"></script>
<script type="text/javascript"><!--
/* activate tooltips */
$(function () {
	$('[data-toggle="tooltip"]').tooltip();
	$('img.lazyload').lazyload();
})
// -->
</script>
</body>
</html>
