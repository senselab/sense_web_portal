<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <title>PRDC 2018</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Access-Control-Allow-Origin" content="*">
    <link href="stylesheets/style.css" rel="stylesheet" type="text/css" />
    <link href="stylesheets/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.css" />
    <link href="PRDC.ico" rel="shortcut icon" />
    <script src='https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit'></script>
    <script>
        $(function(){
            $("#header").load("header.html");
            // $("#navigation").load("navigation.html");
            <?php
                // $contentURL = 'https://senselab.tw/PRDC2018/registration/registration.php';
                // $contentURL = 'https://sense.cs.nctu.edu.tw/PRDC2018/registration/registration.php';
                $contentURL = 'https://prdc2018.cs.nctu.edu.tw/PRDC2018/registration/registration.php';
                $echoStr = '$("#content").load("';
                if(isset($_SERVER['REQUEST_METHOD']) && 'GET' == $_SERVER['REQUEST_METHOD']){
                    // 0. err msg handling
                    if( isset($_GET['err']) )
                    {
                        $contentURL = $contentURL . '?err=' . $_GET['err'];
                        if( isset($_GET['msg']) ){
                            $contentURL = $contentURL . '?&msg=' . $_GET['msg'];
                        }
                    }
                    // 2. revisit via token, show order details
                    if( isset($_GET['reftoken']) ){
                        $contentURL = $contentURL . '?reftoken=' . $_GET['reftoken'];
                    }
                    // 3. return from ESUN, judge if payment succeed
                    if( isset($_GET['DATA']) ){
                        $data = $_GET['DATA'];
                        $contentURL = $contentURL . '?DATA=' . $data;
                    }
                }            
                print($echoStr . $contentURL . '")');
            ?>
        });
        var _captchaTries = 0;
        function onloadCallback() {
            _captchaTries++;
            if (_captchaTries > 9)
                return;
            if ($('.g-recaptcha').length > 0) {
                grecaptcha.render("recaptcha", {
                    sitekey: '6Lc29loUAAAAAPzUY2krx47_v8KUwpsA0Hv-ckiP',
                });
                return;
            }
            window.setTimeout(onloadCallback, 1000);
        }
    </script>

    <script src="https://s3-us-west-2.amazonaws.com/ieeeshutpages/gdpr/settings.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.js"></script>
    <script>
        window.addEventListener("load", function(){
        window.cookieconsent.initialise(json)
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