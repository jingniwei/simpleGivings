
<?
    $host  = $_SERVER['HTTP_HOST'];
    $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    $homeURL= "http://$host$uri";
    //echo "$homeURL";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Admin</title>
     <link rel="stylesheet" type="text/css" href="./stylesheets/custom.css">
     <link rel="stylesheet" type="text/css" href="./stylesheets/bootstrap.css">
     <link rel="stylesheet" type="text/css" href="./stylesheets/bootstrap_button.css">
  </head>
  <body>

    <header>
    <a href=<?echo "$homeURL";?>/><img alt="simple givings logo" class="logo" src="images/logo5.png"></a>
    </header>
    <div class="container">
    <p class= "main">Send Mail to Members</p>
    <form method="POST" id="mailing_list" action="mail_handler.php">
    <p>Select Mailing Group</p>
    <select name= "mail_group">
    <option values="educator">Educator</option>
    <option values="guardian">Guardian</option>
    <option values="all">All Members</option>
    </select>
    
    <input name="subject" class="textbox_wide700" type="text" placeholder="Subject" size="100" value=""/><br>
    <textarea name="message" rows="6" cols="100" placeholder="Message"></textarea><br>
    <input class="main_button" value="Send" type="submit" name="submit"/>



    </form>

    </div>
  </body>
  </html>