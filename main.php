<?php
session_start();
error_reporting(0);
include('includes/config.php');
?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Online Library Management System | </title>
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
					<h2 class="header-line">User Home</h2>
				</div>
			</div>
			<div class="row"/>
				<div class="col-md-3 col-sm-3 col-xs-6">
                    <div class="alert alert-info back-widget-set 
						<p class="fa fa-bars fa-5x"></p>
						<?php
							$id = $_SESSION['studentID'];
							$sql = "SELECT BookName from librarybookstorage WHERE OnLoanId=:id";
							$query = $dbh -> prepare($sql);
							$query->bindParam(':sid',$sid,PDO::PARAM_STR);
							$query->execute();
							$results=$query->fetchAll(PDO::FETCH_OBJ);
							$issuedbooks=$query->rowCount();
						?>
						<h2> Number of books issued:</h2>
						<h1> <?php echo htmlentities($issuedbooks);?></h1> 
					</div>
				</div>
			</div>
		</div>
	</div>
	
</body>					