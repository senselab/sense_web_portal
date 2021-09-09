<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <title>PRDC 2018</title>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <META HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE">
      <META HTTP-EQUIV="EXPIRES" CONTENT="0">
      <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
      <link href="style.css" rel="stylesheet" type="text/css" />
      <link href="images/PRDC.ico" rel="shortcut icon" />
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <style type="text/css">
         <!--
            .STYLE2 {font-family: Arial, Helvetica, sans-serif}
            -->
      </style>

      <link type="text/css" href="./program_files/program1111.css" rel="StyleSheet">
      <link rel="StyleSheet" type="text/css" href="./program_files/program.css">


      <script>
         $.ajaxSetup ({
                    // Disable caching of AJAX responses
                    cache: false
                });
                
                $(function(){
                    $("#header").load("header.html");
                    $("#navigation").load("navigation.html");
                });

         $(document).ready(function() {
            //$("#contentxx").click( function(){$("a").removeAttr("href");} );
            $("#contentxx").click( function(e){e.preventDefault();} );
            $("p:contains('View')").empty();
          });       
      </script> 
   </head>
   <body>
      <div id="container">
         <div id="header"></div>
         <div id="navigation"> </div>
         <div id="content">

            <?php include('program_content.html'); ?>

         </div>
         <div id="footer">
            <p>Copyright &copy; PRDC 2018</p>
         </div>
      </div>
   </body>
</html>