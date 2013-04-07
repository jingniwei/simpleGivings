<?php
function connectToDB(){
	$dbc= @mysqli_connect("cslab.bc.edu", "weijc", "T3W8vrSEQR9CWJyh", "weijc") or
					die("Connect failed: ". mysqli_connect_error());
					
// 	$dbc= @mysqli_connect("cslab.bc.edu", "weijc", "sunnie", "wfb2007") or
// 					die("Connect failed: ". mysqli_connect_error());
	return ($dbc);
}
function disconnectFromDB($dbc, $result){
	mysqli_free_result($result);
	mysqli_close($dbc);
}

function performQuery($dbc, $query){
	//echo "My query is >$query< <br />";
	$result = mysqli_query($dbc, $query) or die("bad query".mysqli_error($dbc));
	return ($result);
}
?>