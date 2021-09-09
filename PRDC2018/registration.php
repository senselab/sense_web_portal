<!DOCTYPE html>
<html lang="en">
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

	<title>PRDC 2018</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Access-Control-Allow-Origin" content="*">
	<META HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE">
	<META HTTP-EQUIV="EXPIRES" CONTENT="0">
	<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">	
    <!-- <link href="stylesheets/styles.css" rel="stylesheet" type="text/css" /> -->
    <link href="stylesheets/style.css" rel="stylesheet" type="text/css" />
    <link href="stylesheets/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.css" />
    <link href="PRDC.ico" rel="shortcut icon" />
	<script>
	
  		$.ajaxSetup ({
            // Disable caching of AJAX responses
            cache: false
        });	
	
        $(function(){
            $("#header").load("header.html");
            $("#navigation").load("navigation.html");
            <?php
                $contentURL = 'https://prdc2018.cs.nctu.edu.tw/PRDC2018/registration/registration.php';
                $echoStr = '$("#content").load("';
                print($echoStr . $contentURL . '?onlyintro=1")');
            ?>
        });
    </script>
</head>
<body>

<!--main-->
<div id="container">
	<div id="header"></div>
	<div id="navigation"></div>
	<div id="content">
       
    </div><!--/content-->
    <div id="footer">
        <p>Copyright &copy; PRDC 2018</p>
    </div>
</div><!--/container-->
</body>
</html>