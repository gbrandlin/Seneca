
<?php session_start();?>

<?php
require('sennecaconnect.php');

 

if(isset($_SESSION['isActive']) && $_SESSION['isActive'] === true ){
	header("Location: ./seneca.php");
	exit;
}


if(isset($_POST['user']) && isset($_POST['password'])) {

$userPost = $_POST['user'];
$passwordPost = $_POST['password'];



if($res = pg_query($db, "SELECT * FROM users WHERE username='$userPost'")){ //jobs? where employeeid = employee id
	if($row = pg_fetch_assoc($res)) {

    //add a query to save the fk_employee of the one who logs in. 

		if($row['username'] == $userPost && $row['password'] == $passwordPost) { // employee id or email and password
			$_SESSION['isActive'] = true;
			$_SESSION['user'] = $row['pk_user'];//id num
            $result = pg_query($db, "SELECT * FROM  employeeview WHERE username = '$userPost'");
            $rowD = pg_fetch_assoc($result);
            $_SESSION['fk_emp']=$rowD['pk_employee'];

			session_regenerate_id(true);

			header("Location: ./seneca.php");  // server side redirects
			exit;
		}
        
		
	}
}



}







?>
<ons-progress-circular indeterminate></ons-progress-circular>