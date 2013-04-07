<?
    $host  = $_SERVER['HTTP_HOST'];
    $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    $signUpURL="http://$host$uri/signup.php";
    $routeURL="http://$host$uri/adminlogin.php";
    $forgotPasswordURL= "http://$host$uri/passwordReset.php";
    //echo($routeURL);//debug
  ?>
<!DOCTYPE html>
<html lang="en">
  <head>
  	<meta charset="utf-8">
    <title>Welcome</title>
    <link rel="stylesheet" type="text/css" href="./stylesheets/custom.css">
    <link rel="stylesheet" type="text/css" href="./stylesheets/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="./stylesheets/bootstrap_button.css">
  </head>
  <body>
  <div id="container">
    <form method= "post" action="<?echo($routeURL);?>">
    <input class="right_side_button" value="Admin Login" type="submit" name="admin_login" />
    </form>
    <form method= "post" action="<?echo($forgotPasswordURL);?>">
    <input class="right_side_button" value="Reset Password" type="submit" name="password_reset" />
    </form>
    <img class="home_page_logo" src="images/logo5.png" alt="simple givings logo">
    <br>
    <br>
    <br>
  </div>
  <div id="site_info1">
    <p class="main">Simple Givings believes in social justice, 
      love, kindness. You know, the good stuff!  
      In underserved neighborhoods across the country, many families need 
      a hand to provide their children with school supplies, winter clothing
       and other essentials. We're glad you're here to help!</p>
  	<p class="main">Sign up to recieve news, and information on how you 
      can sponsor a child.</p>
  	<form method= "post" action ="<?echo "$signUpURL";?>"> 
  	<input class="main_button" value="Sign me up! " type="submit" name="sign_up" />
  	</form>
  </div>
  </body>
</html>
