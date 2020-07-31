<?php
session_start();
error_reporting(0);
include('includes/config.php');
?>
<!DOCTYPE html>
<style>
table {
  width:100%;
}
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
th, td {
  padding: 15px;
  text-align: left;
}
#t01 tr:nth-child(even) {
  background-color: #eee;
}
#t01 tr:nth-child(odd) {
 background-color: #fff;
}
#t01 th {
  background-color: black;
  color: white;
}
</style>
<html xmlns="http://www.w3.org/1999/xhtml">
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
					<h4 class="header-line">ADMIN DASHBOARD</h4>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3 col-sm-3 col-xs-6">
                    <div class="alert alert-info back-widget-set 
						<p class="fa fa-bars fa-5x"></p>
						<?php
							$id = $_SESSION['studentID'];
							$sql = "SELECT BookName from librarybookstorage";
							$query = $dbh -> prepare($sql);
							$query->bindParam(':sid',$sid,PDO::PARAM_STR);
							$query->execute();
							$results=$query->fetchAll(PDO::FETCH_OBJ);
							$totalbooks=$query->rowCount();
						?>
						<h2> Total Number of Books:</h2>
						<h1> <?php echo htmlentities($totalbooks);?></h1> 
					</div>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-6">
                    <div class="alert alert-info back-widget-set 
						<p class="fa fa-bars fa-5x"></p>
						<?php
							$sql = "SELECT BookName from librarybookstorage WHERE OnLoan=1";
							$query = $dbh -> prepare($sql);
							$query->execute();
							$results=$query->fetchAll(PDO::FETCH_OBJ);
							$onLoanBooks=$query->rowCount();
						?>
						<h2> Number of books on loan:</h2>
						<h1> <?php echo htmlentities($onLoanBooks);?></h1> 
					</div>
				</div>
		</div>
			<div class="container">
				<div class="row pad-botm">
					<div class="col-md-12">
						<h4 class="header-line">Book List</h4>
					</div>
				</div>
				<div>
					<table border="1" cellspacing="5" cellpadding="5" width="100%" bgcolor="#809080">
						<thead     bgcolor= "#5AA8CC" color="#5AA8CC">
							<tr>
								<th>Title</th>
								<th>Author</th>
								<th>Published</th>
								<th>On Loan</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$result = $dbh->prepare("SELECT BookName,Author,Published,OnLoan from librarybookstorage");
								$result->execute();
								for($i=0; $row = $result->fetch(); $i++){
							?>
							<tr>
								<td><label><?php echo $row['BookName']; ?></label></td>
								<td><label><?php echo $row['Author']; ?></label></td>
								<td><label><?php echo $row['Published']; ?></label></td>
								<td><label><?php if($row['OnLoan'] == 0) {echo "No";} else {echo "Yes";} ?></label></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
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
