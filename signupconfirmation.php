<?
    $host  = $_SERVER['HTTP_HOST'];
    $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    $homeURL="http://$host$uri/index.php";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>hi you!</title>
     <link rel="stylesheet" type="text/css" href="./stylesheets/custom.css">
     <link rel="stylesheet" type="text/css" href="./stylesheets/bootstrap.css">
     <link rel="stylesheet" type="text/css" href="./stylesheets/bootstrap_button.css">
  </head>
  <body>
    <div id="container">
    <header>
    <a href= <?echo "$homeURL";?>><img alt="simple givings logo" class="logo" src="images/logo5.png"></a>
    </header>
    <p class= "main">Thank you for signing for for Simple Givings!</p>
    </div>
  </body>
  </html>