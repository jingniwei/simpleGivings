
<?
    $host  = $_SERVER['HTTP_HOST'];
    $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    $adminAuthenticate= "http://$host$uri/adminLoginAuthenticate.php";
    $homeURL= "http://$host$uri";
    //echo "$adminAuthenticate";
   
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Admin Login</title>
     <link rel="stylesheet" type="text/css" href="./stylesheets/custom.css">
     <link rel="stylesheet" type="text/css" href="./stylesheets/bootstrap.css">
     <link rel="stylesheet" type="text/css" href="./stylesheets/bootstrap_button.css">
  </head>
  <body>
    <header>
    <a href=<?echo "$homeURL";?>/>
    <img alt="simple givings logo" class="logo" src="images/logo5.png">
    </a>
    </header>

    <form method="post" action="<?echo($adminAuthenticate)?>">
    <input class="singlePasswordBox" size="55" name="password" type="password" placeholder="Enter Admin Password"/></br>
    <input class="centerMainButton" value="Enter" type="submit" name="submit"/>
    </form>

  </body>
  </html>
