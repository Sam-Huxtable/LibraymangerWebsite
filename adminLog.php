<?php 
session_start();
include('includes/config.php');
include('includes/header.php');
if(isset($_POST["Login"])){
	$email=$_POST["idemail"];
	$password= $_POST["password"];
	$mysql = "SELECT email,password,userid FROM Admininfo WHERE Email=:email AND password=:password";
	$query = $dbh -> prepare('SELECT email,password,userid FROM userinfo WHERE Email=:email AND password=:password');
	$query-> bindParam(':email', $email, PDO::PARAM_STR);
	$query-> bindParam(':password', $password, PDO::PARAM_STR);
	$query-> execute();
	$results=$query->fetchAll(PDO::FETCH_OBJ);
	
	if($query->rowCount() > 0) 
	{
		foreach ($results as $result) {
			$_SESSION['studentID']=$result->userid;
		}	
		echo "<script type='text/javascript'> document.location ='adminHome.php'; </script>";	} else {
			echo "<script>alert('Invalid Details');</script>";	
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="description" content="Library Management" />
	<meta name="keywords" content="php" />
	    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	 <meta name="author" content="Samuel Huxtable">
	 
	<title> Library Management </title>
	
	   <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>

<body>
	
	<div class="content-wrapper">
	<div class="container">
	<div class="row pad-botm">
	<div class="col-md-12">
	<h2 class="header-line">LOGIN</h2>
	</div>
	</div>
	
	<!---Login Form-->
	<div class="row">
		<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3" >
			<div class="panel panel-info">
				<div class="panel-heading">
					ADMIN LOGIN FORM
				</div>
				<div class="panel-body">
					<form role="form" method="post">
						<div class="form-group">
							<label>Email</label>
							<input class="form-control" type="text" name="idemail" required autocomplete="off" />
						</div>
						<div class="form-group"/>
							<label>Password</label>
							<input class="form-control" type="text" name="password" required autocomplete="off"/>
						</div>
	
					<button type="submit" name="Login" class="btn btn-info">Submit Login Info</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	
</body>
</html>