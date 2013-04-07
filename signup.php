<?
error_reporting(0);
include('dbconn.php');
if(isset($_POST['submit']))
		formhandler();
?>
<?
    $host  = $_SERVER['HTTP_HOST'];
    $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    $homeURL="http://$host$uri/index.php";
    //echo "$homeURL";//debug
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  	<meta charset="utf-8">
    <title>Sign Up</title>
     <link rel="stylesheet" type="text/css" href="./stylesheets/custom.css">
     <link rel="stylesheet" type="text/css" href="./stylesheets/bootstrap.css">
     <link rel="stylesheet" type="text/css" href="./stylesheets/bootstrap_button.css">
  </head>
  <body>
  	<header>
  	<a href= <?echo "$homeURL";?>><img alt="simple givings logo" class="logo" src="images/logo5.png"></a>
  	</header>
	<div id= "container_signup">
	<?
	//print_r($_POST);//debug
		displayform();
	?>
	</div>

  </body>
</html>
<?
	function formhandler(){
		$firstname= $_POST['firstname'];
		$lastname= $_POST['lastname'];
		$email= $_POST['email'];
		$password=sha1($_POST['password']);
		$repassword =sha1($_POST['re-password']); 
		$member_type= $_POST['member_type'];

		$formfilled=formfilledValidation($firstname, $lastname,$email, $password, $repassword, $member_type);
		if($formfilled){
			$emailcheck=emailValidation($email);	
			if($emailcheck){
				$passwordcheck=passwordValidation($password, $repassword);		
			}
		}
		
		if($passwordcheck && $emailcheck){
		insertValidMember($firstname,$lastname, $email, $password, $member_type);
		//header("Location:http://cslab.bc.edu/~weijc/simplegivings/signupconfirmation");
		$host  = $_SERVER['HTTP_HOST'];
    	$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$confirmURL="http://$host$uri/signupconfirmation.php";
		//echo("$confirmURL");//debug
		header("Location:$confirmURL");

		}
	}

	function passwordValidation($password, $repassword){
		if(strcmp($password, $repassword)!=0){
			invalidPasswordhandler();
			return 0;
		}
		return 1;
	}

	function emailValidation($email){
		$query= "SELECT * FROM `sg_membership` WHERE email = '$email'";
		$dbc=connectToDB();
		$result=performQuery($dbc, $query);
		$num_row=mysqli_num_rows ($result);

		if($num_row>0){
			invalidEmailhandler();
			return 0;
		}
		return 1;

		//disconnectFromDB($dbc, $result);
		
	}
?>

<?
function formfilledValidation($firstname,$lastname, $email, $password, $repassword, $member_type){
	$emptyfieldlist='';
	//echo "checking filled form: $name,$email, $password, $repassword, $member_type";//debug
	//if name field is not filled
	if(empty($firstname)){
			$emptyfieldlist="first name";
	}
	if(empty($lastname)){
		if (empty($emptyfieldlist)){
			$emptyfieldlist="last name";
		}
		else
			$emptyfieldlist=$emptyfieldlist.", last name";
	}

	//if email field is not filled
	if(empty($email)){
		if (empty($emptyfieldlist)){
			$emptyfieldlist="email";
		}
		else
			$emptyfieldlist=$emptyfieldlist.", email";
	}
	//if password field is not filled

	if(strcmp('da39a3ee5e6b4b0d3255bfef95601890afd80709',$password)==0){
		if (empty($emptyfieldlist)){
			$emptyfieldlist="password";
		}
		else
			$emptyfieldlist=$emptyfieldlist.", password";
	}
	//if repassword field is not filled
	if(strcmp('da39a3ee5e6b4b0d3255bfef95601890afd80709', $password)==0){
		if (empty($emptyfieldlist)){
			$emptyfieldlist="re-enter password";
		}
		else
			$emptyfieldlist=$emptyfieldlist.", re-enter password";
	}
	//if member field is not filled
	if(empty($member_type)){
		if (empty($emptyfieldlist)){
			$emptyfieldlist="member type";
		}
		else
			$emptyfieldlist=$emptyfieldlist.", member type";
	}
	//check if any of the fields were filled
	if(empty($emptyfieldlist)){
		return 1;
	}else{
		invalidFilledformhandler($emptyfieldlist);
		return 0;
	}
	
}

?>
<?
function invalidFilledformhandler($emptyfieldlist){
	echo("<fieldset><p>Please complete the $emptyfieldlist field(s)</p></fieldset>");
}
?>

<?
function invalidPasswordhandler(){
	?>
	<fieldset>
	<p>Password does not match, try again</p>
	</fieldset>
<?
}
?>
<?
function invalidEmailhandler(){

	?>
	<fieldset>
	<p>This email has already been registered. <br> <a href="http://cslab.bc.edu/~weijc/simplegivings/sorry">forgot your password?</a></p>
	</fieldset>
<?
}
?>
<?
	function displayform(){
		$firstname= $_POST['firstname'];
		$lastname= $_POST['lastname'];
		$email= $_POST['email'];
		$member_type=$_POST['member_type'];
?>	
		<h1>Sign Up</h1>
		<form method="post"> 
			<input class="textbox" size="55" value="<?echo"$firstname"?>" name="firstname" type="text" placeholder="FirstName"/><br>
			<input class="textbox" size="55" value="<?echo"$lastname"?>" name="lastname" type="text" placeholder="LastName"/><br>
			<input class="textbox" size="55" value="<?echo"$email"?>" name="email" type="text" placeholder="Email Address"/><br>
			<input class="textbox" size="55" name="password" type="password" placeholder="Password"/><br>
			<input class="textbox" size="55" name="re-password" type="password" placeholder="Re-enter Password"/><br>
			<?	
			$guardian=!strcmp($member_type, 'guardian');
			$educator=!strcmp($member_type, 'educator');
			if($educator){
				echo"<input type=radio checked=\"checked\" name=\"member_type\" value=\"educator\">I am an educator<br>";	
				echo"<input type=radio name=\"member_type\" value=\"guardian\">I am a guardian<br>";
			}
			elseif ($guardian) {
			 	echo"<input type=radio checked=\"checked\" name=\"member_type\" value=\"guardian\">I am a guardian<br>";
				echo"<input type=radio name=\"member_type\" value=\"educator\">I am an educator<br>";	
			}
			else{
				echo"<input type=radio name=\"member_type\" value=\"educator\">I am an educator<br>";
				echo"<input type=radio name=\"member_type\" value=\"guardian\">I am a guardian<br>";
			}
			?>
			<p>You will be notified once we're up and running!</p>
			<input class="main_button" value="Sign me up" type="submit" name="submit" />
		</form>

<?
}
?>
<?
function insertValidMember($firstname, $lastname, $email, $password, $member_type){
	$dbc=connectToDB();
	$query= "INSERT INTO sg_membership (firstname,lastname, email, password, time_registered, member_type)
			 VALUES ('$firstname', '$lastname', '$email', '$password', now(), '$member_type')";
	//echo "$query";
	$userid=performQuery($dbc, $query);
	//disconnectFromDB($dbc, $result);
}
?>
