<?php
session_start();
error_reporting(0);
include('includes/config.php');

if(isset($_POST['remove'])){
	
	$title = $_POST['title'];
	$author = $_POST['author'];
	$published = $_POST['published'];
	$onLoan= 0;
	$onLoanId = 0;
	
	$sql = "DELETE FROM librarybookstorage 
	WHERE BookName=:title AND Author=:author AND Published=:published;";	
	$query = $dbh->prepare($sql);
	$query->bindParam(':title',$title,PDO::PARAM_STR);
	$query->bindParam(':author',$author,PDO::PARAM_STR);
	$query->bindParam(':published',$published,PDO::PARAM_STR);
	$query->execute();
	if ($query->execute()) {
		$_SESSION['msg']="Success";
		header('location:AdminHome.php');
	} else {
		$_SESSION['error']="Something went wrong. Please try again";
		header('location:removeBook.php');
	}
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title> Add Books </title>
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
<?php include('includes/AdminHeader.php');?>
 
 
    <div class="content-wra
		<div class="content-wrapper">
			<div class="container">
				<div class="row pad-botm">
					<div class="col-md-12">
						<h4 class="header-line">Remove a Book</h4>
                
					</div>
				<div class="row"
					<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3"">
						<div class="panel panel-info">
							<div class="panel-heading"> Input Information </div>
						<div class="panel-body">
							<form role="form" method="post">
							<div class="form-group"
								<label> Title </label>
								<input class="form-control" type="text" name="title" required="required"/>
							</div>
							<div class="form-group"
								<label> Author </label>
								<input class="form-control" type="text" name="author" required="required"/>
							</div>
							<div class="form-group"
								<label> Published</label>
								<input class="form-control" type="text" name="published" required="required"/>
							</div>
							<button type="submit" name="remove" class="btn btn-info">Remove </button>
						</div>
					</div>
				</div>
			</div>
		</div>
    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY  -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>

</body>
</html>