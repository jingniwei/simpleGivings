
<?  include('dbconn.php');
    $host  = $_SERVER['HTTP_HOST'];
    $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    $homeURL= "http://$host$uri";
    //echo "$homeURL";
?>
 <?
    $subject= $_POST['subject'];
    $message= $_POST['message'];
    $mail_group= $_POST['mail_group'];
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
    <fieldset>
    <?
    echo "Mail Group: $mail_group<br>";
    echo "Subject:$subject<br>";
    echo "Message: $message<br>";
    $data=getEmail($mail_group);
    $email_list=$data['email_list'];
    $full_name_list=$data['full_name_list'];
    $first_name_list=$data['first_name_list'];
    $num_row=$data['num_row'];
    
    // echo "$email_list[0]";
    // echo "$full_name_list[0]";
    // echo "$first_name_list[0]";

    sendMail($num_row, $email_list, $first_name_list, $subject, $message);
    sendStatus($num_row, $full_name_list, $email_list, $mail_group);
    ?>

  </fieldset>
    </div>
    </body>
  </html>

  <?
  function getEmail($mail_group){
    if(strcmp($mail_group, "Guardian")==0){
      $query = "SELECT firstname, lastname, email FROM `sg_membership` WHERE member_type=\"guardian\"";
    }
    elseif(strcmp($mail_group, "Educator")==0){
      $query = "SELECT firstname, lastname, email FROM `sg_membership` WHERE member_type=\"educator\"";
    }
    elseif(strcmp($mail_group, "All Members")==0){
      $query = "SELECT firstname, lastname, email FROM `sg_membership` WHERE 1";
    }

    $dbc=connectToDB();
    $result=performQuery($dbc, $query);
    $num_row=mysqli_num_rows ($result);
 
    while( $row = mysqli_fetch_array($result, MYSQLI_ASSOC))
    {
      $email_element= $row['email'];
      $name_element= $row['firstname'].' '.$row['lastname'];
      $firstname_element= $row['firstname'];

      $email_list []= "$email_element";
      $full_name_list [] = "$name_element";
      $first_name_list[]= "$firstname_element";

    }

    $data = array('email_list' =>  $email_list, 'full_name_list' => $full_name_list, 'first_name_list'=>$first_name_list, 'num_row'=>$num_row );

    return $data;

    //print_r($query);
    // print_r($email_list);
    // echo "<br>Full Name List";
    // print_r($full_name_list); 
    // echo "<br>First Element";
    // print_r($first_name_list);
    // echo"$email_list[0]";
    // echo"$full_name_list[0]";
    // echo"$first_name_list[0]";
   }


   function sendMail($count, $email_list, $firstname, $subject, $message ){

    for ($i=($count-1); $i >= 0; $i--) { 
      $text= "Hi $firstname[$i], ".$message;
      $email= $email_list[$i];
      mail($email_list[$i], $subject, $text);

      // echo "$email<br>";
      // echo "$subject<br>";
      // echo "$text<br>";
      // echo "$count<br>";

    }
    
   }

   function sendStatus($num_row, $full_name_list, $email_list, $member_type){
    
    echo "<p>You've sent a total of $num_row emails";
    echo "<p>Here is the list of people you emailed:</p>";
    for ($i=0; $i <$num_row ; $i++) { 
      $t= $full_name_list[$i].'  '.$email_list[$i];
      echo "<p>$t</p>";
    }
    echo "</fieldset>";

    

   }
  


  ?>