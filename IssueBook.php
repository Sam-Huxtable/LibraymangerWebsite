<?php
session_start();
error_reporting(E_ALL);
include('includes/config.php');
	echo '<script>alert($title)</script>';

if(isset($_POST['add'])){
	
	$title = $_POST['title'];
	$author = $_POST['author'];
	$published = $_POST['published'];
	$onLoan= 0;
	$onLoanId = $_POST['id'];
	
	$mysql = "SELECT BookName,Author,Published,OnLoan FROM librarybookstorage WHERE BookName=:title AND Author=:author AND Published=:published AND OnLoan=:onLoan";
	$query = $dbh->prepare($mysql);
	$query->bindParam(':title',$title,PDO::PARAM_STR);
	$query->bindParam(':author',$author,PDO::PARAM_STR);
	$query->bindParam(':published',$published,PDO::PARAM_STR);
	$query->bindParam(':OnLoan',$onLoan,PDO::PARAM_INT);

	$query->execute();
	if ($query->rowCount() >= 0) {
		$sql = "UPDATE librarybookstorage SET OnLoanId=:onLoanId, OnLoan=1 WHERE BookName=:title AND Author=:author AND Published=:published";;
		$query1 = $dbh->prepare($sql);
		$query1->bindParam(':title',$title,PDO::PARAM_STR);
		$query1->bindParam(':author',$author,PDO::PARAM_STR);
		$query1->bindParam(':published',$published,PDO::PARAM_STR);
		$query1->bindParam(':onLoanId',$onLoanId,PDO::PARAM_STR);
		$query1->execute();
		
		if ($query1->rowCount() > 0) {
			$_SESSION['msg']="Success";
			header('location:AdminHome.php');
		} else {
			$_SESSION['error']="Something went wrong. Please try again";
			header('location:IssueBook.php');
		}
	} else {
		$_SESSION['error']="Something went wrong. Please try again";
		header('location:IssueBook.php');
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
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title>Online Library Management System | Admin Dash Board</title>
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
 <!-- MENU SECTION END-->
    <div class="content-wrapper">
         <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">Issue a Book</h4>
                
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
							<div class="form-group"
								<label> User ID</label>
								<input class="form-control" type="text" name="id" required="required"/>
							</div>
							<button type="submit" name="add" class="btn btn-info">Submit </button>
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
