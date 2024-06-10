<?php
	include_once("common.php");

	$jsonlist = array( 'faculty', '0', 
		'2010', '2011', '2012', '2013', '2014', '2015', '2016', '2017', '2018', '2019',
		'2020', '2021', '2022', '2023' );

	$db = array();
	foreach($jsonlist as $j) {
		$members = json_decode(file_get_contents("members/$j.json"), $associative = true);
		reset($members);
		while(($k = key($members)) != null) {
			$db[$k] = $members[$k];
			next($members);
		}
	}

	if (rand(0,1)==0) {
		$faculty = array(
			"吳育松", "黃俊穎"
		);
	}
	else {
		$faculty = array(
			"黃俊穎", "吳育松"
		);		
	}

	$current = array(
		
		"黃秉為", "李亭萱", "張睿安", "蘇志東", "陳彥瑋", "陳允觀", # 2023

		"蔡品緣",  "廖昱瑋", "韓明洋", "賴俊宇", "張均聖",
		"陳楷蓉", "許心華", "黃建學", "洪佳瑜", "江信燁", "李宣穎", "歐陽詮",	# 2022
		"謝旻紜", "莊舜勛",
		"范家慈",
		"徐曼妮", "高瑋哲", "蔡旻哲", "杜萬珩", "吳苡瑄", "張智諺",		# 2021
		
		"郭宗儀", 
		"吳旻杰",
		
	);

	$alumni = array(
		
		"Sanoop Mallissery" , #2023
		"張秉洋", "林柏均", #2022

		"朱彥瑜", "戴宏諺", #2021

		"陳冠廷2020",

		"朱詠田", "許晉瑋", "黃冠璋", "黃思淳",
		"陳廷宇", "趙彬智", "莊秉璿", "邱鈺雯", "張禾金", "謝立德",	# 2019
		"黃振宏", "蔡坤哲", "陳徹", "江昆逸",
		"李泓暐", "呂翰漳", "鮑俊安", "彭珮婷", "巫政葳", "林宗毅", "林煒淳",
		"郎宇傑", "黃德賢", "藍建元", "邱肇珩",
		"盛宇航", "詹家鴻", "賴文揚", "陳冠廷",
		"鐘彥杰", "黃昭銘", "鄭允真", "連培知", "楊凱均", "林國宣",
		"蔡孟谷", "鄭炳忠", "謝智皓", "盧威寰",
		"林仲儀", "汪欣誼", "王威擎", "黃冠智",
		"黃靖宇", "吳佩禎", "許嘉鋒", "薛淑文", "鍾興璇", "高端廷",

		"陳業良", "李穎欣", "洪聿昕", "黃俊魁", "舒俊維", "Ken Chang", // 2015-2017
		"王亮鈞", "Patrick Ngai", "林東岳", "王傑民", "張培軒", // 2014-2016
		"伍立鈞", "林威勝", "盧炫宏", "邱奕斌", // 2013-2015
		"呂峻權", "張佑嘉", "蘇育暄", "鄭又瑞", "陳義永", // 2012-2014
		"呂松澤", "蔡孟儒", "蔡宗翰", "許晏峻", // 2011-2013
		"石　穎", "孫培耕", "賴敘方", "黃俊祺", // 2010-2012
		/*,
		// undergraduate project students
		"蔡傳資", "胡喬峰", "李汶洋", "陳業良", // 2014
		"古耕竹", "孫羽柔", "李唯民", "林東岳", "王傑民", "王永慶", "謝閔凱", "鄧子瑋", "陳思頴", "黃冠智", "Joel Rosales", "Marissa Mathurin", // 2013
		"林晉平", "張逸", "蘇庭昱", // 2012
		"余其龍", "曹文豪", "梁嘉碧", "高宏任", "黃泰順", // 2011
		"張庭瑋", "李韻立", "胡　悅" // 2010
		 */
	);

	function rinfo($name, $field) {
		global $db;
		if(key_exists($name, $db) == False) {
			if(strstr($field, "name") != false) return $name;
			if($field == "class") return "FIXME";
			return null;
		}
		if(key_exists($field, $db[$name])) return $db[$name][$field];
		return null;
	}

	function render_member(&$list) {
		for($i = 0; $i < sizeof($list); $i++) {
			if($i % 3 == 0) {
				echo "\n" . '<!-- begin row --><div class="row">' . "\n";
			}
			echo '<!-- #'. $i .' --><div class="col-md-4 col-sm-6 col-xs-12"><div class="media">' . "\n";
			$m = $list[$i];
			# ================================?>
<div class="media-left">
	<img class="media-object" src="members/photos/<?= (($r = rinfo($m, 'photo')) != null)? $r : "pumpkin_1.jpg" ?>" alt="" width="96">
</div>
<div class="media-body">
<?php
	if(($r = rinfo($m, 'ename')) != null) echo "<h5 class='media-heading'>$r</h5>\n";
	if(($r = rinfo($m, 'cname')) != null) echo "<h5 class='media-heading'>$r</h5>\n";
?><small>
<?php
	$from = rinfo($m, 'from');
	$to = rinfo($m, 'to');
	# year
	if($from != null && $to != null && $to > 0) echo "$from&mdash;$to";
	else if($from != null) echo "$from&mdash;";
	# class: phd, master, under
	if(($r = rinfo($m, 'class')) != null) echo "<br/>$r";
	# now with
	if(($r = rinfo($m, 'with')) != null) echo "<br/>Now with $r";
?>
</small></br>
<ul class="pagination pagination-sm margin-v4px">
<?php
	if(($r = rinfo($m, 'phone')) != null)
		echo "<li><span class='fa fa-phone' data-toggle='tooltip' data-placement='bottom' title='$r'></span></li>\n";
	if(($r = rinfo($m, 'email')) != null)
		echo "<li><a href='mailto:$r'><span class='fa fa-envelope-o'></span></a></li>\n";
	if(($r = rinfo($m, 'link')) != null)
		echo "<li><a href='$r' target='_blank'><span class='fa fa-link'></span></a></li>\n";
?>
</ul>
</div>
<?php		# ================================
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
