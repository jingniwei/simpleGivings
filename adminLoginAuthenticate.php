<?
	$host  = $_SERVER['HTTP_HOST'];
    $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    $adminLoginURL= "http://$host$uri/adminlogin.php";
    $adminPageURL= "http://$host$uri/adminpage.php";
	$userinput= sha1($_POST['password']);
	// $input= ($_POST['password']);
	// echo "userinput:$input";
	$key= "1785ed6ccf537856a2e5d0935a1ffb2dde2d3ab5";
	$compare=strcmp($userinput, $key);
  	if ($compare!=0){ 
      header("Location:$adminLoginURL");
      }
  	else{
      header("Location:$adminPageURL");
 	}
?>