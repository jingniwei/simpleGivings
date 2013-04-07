
<?  include('dbconn.php');
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
    <title>Password Reset</title>
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

    <form method="post">
    <input class="singlePasswordBox" size="55" name="email" type="text" placeholder="Enter Email"/></br>
    <input class="centerMainButton" value="Reset Password" type="submit" name="submit"/>
    </form>
    <?
        if(isset($_POST['submit'])){
          passwordReset_Handler();
        }
    ?>

  </body>
  </html>

<?
function passwordReset_Handler(){
    $email=$_POST['email'];
    $subject="Password Reset on your Simple Givings Account";
    
    if(emailValidation($email)==1){
      $newpassword=genpassword();
      $message="Here is your new password for your Simple Givings Account: $newpassword";
      $mail_status=mail($email, $subject, $message);
      echo "<fieldset>";
      echo "<p>We've sent you a new password, check your email $email </p><br>";
      //echo "$email, $subject, $message <br>";
      //echo "$mail_status"//debug;

      echo "</fieldset><br>";

      //insert new password into database
      insertNewPassword($email, $newpassword);



    }else{
      echo "<fieldset>";
      echo "<p>We don't have your email address on file, try again or Signup for an account!</p>";
      echo "</fieldset><br>";
    }

}

function genpassword(){
    $alphanumeric= array ('A','B','C','D','E','F','G','H','J','K','L','M','N','P','Q','R','S','T','U','V','W','X','Y','Z','2','3','4','5','6','7','8','9', '$');
    $newpassword="";

    for ($i=0; $i <6 ; $i++) { 
      $index= rand(0,32);
      //echo "$index<br>";
      $newletter= $alphanumeric[$index];
      $newpassword=$newpassword.$newletter;
    }
    // echo"new password:";
    // print_r($newpassword);
    return $newpassword;
}

function emailValidation($email){
    $query= "SELECT * FROM `sg_membership` WHERE email = '$email'";
    $dbc=connectToDB();
    $result=performQuery($dbc, $query);
    $num_row=mysqli_num_rows ($result);

    if($num_row==1){
      return 1;
    }
    else{
      return 0;
    }
    //disconnectFromDB($dbc, $result);
  }

function insertNewPassword($email, $newpassword){
    $encriptpass= sha1($newpassword);
    $query="Update `sg_membership` SET  `password` =  '$encriptpass' WHERE email= '$email'";
    //echo "$query";
    $dbc=connectToDB();
    $result=performQuery($dbc, $query);
    

}
?>