<?php
/*
Name: insertEmployee.php

grabs post data from entry.php and inserts it all for a new employee
*/

session_start();

function form(){
	//grab post data from new employee form
	$employeename = $_POST['employeename'];
	$datejoined = $_POST['datejoined'];
	$department = $_POST['department'];
	$annualsalary = $_POST['annualsalary'];
	$project = $_POST['project'];

	//php upload
	$link = mysqli_connect("127.0.0.1:8889", "root", "root", "test") or die("cannot connect" .mysqli_connect_error());

	//insert new valules into employee information.
	$query = "INSERT INTO EmployeeInformation VALUES ('', '$employeename', '$datejoined', '$department', '$annualsalary', '$project')";
	$result = mysqli_query($link, $query) or die("query failed" . mysqli_connect_error());

	//get employee information to collect most reecently generated employee number for image insert.
	 $query = "SELECT * FROM EmployeeInformation WHERE EmployeeNumber = ( SELECT MAX(EmployeeNumber) FROM EmployeeInformation ) ;";
     $result = mysqli_query($link, $query) or die ("query failed" . mysqli_connect_error());
     $info = mysqli_fetch_assoc($result);

     $currentEmployeeName = $info[EmployeeName];
     $currentEmployeeNumber = $info[EmployeeNumber];

     //grab photo information and insert under employee number (current employee Number)
	$len = count($_FILES['image']['name']);
	$_FILES['image']['tmp_name'];

	if(isset($_FILES['image']) && $_FILES['image']['size'] > 0)
	{
		$tmpName = $_FILES['image']['tmp_name'];
		//read the file
		$fp = fopen($tmpName, 'r');
		$data = fread($fp, filesize($tmpName));
		$data = addslashes($data);
		fclose($fp);

		$query = "INSERT INTO EmployeePhotos VALUES ('', '$currentEmployeeNumber', '$data')";
		$result = mysqli_query($link, $query) or die("photo upload failed" . mysqli_connect_error());

	}
	else
	{

		$error = "IMAGE FAILED TO UPLOAD";

	}

	mysqli_close();

  	echo "
		<div class='login animation-fast'>
    	<div class='outer'>
     	 <div class='container'>
      	  <i class='fa fa-thumbs-up fa-4x'></i>
       		 <p>Employee $currentEmployeeName (# $currentEmployeeNumber) Created Sucessfully.</p><br/><a class='button' href='./employeeDirectory.php'>Return to Employee Directory</a>
     	</div>
    	</div>
  		</div>
  		";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Home Page</title>
  <link rel="stylesheet" href="../css/style.css"/>
  <link rel="stylesheet" href="../css/font-awesome.min.css">
  <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Lato"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class="bg">
  <?php
  if(empty($_SESSION['username']) && empty($_SESSION['password'])){
    $_SESSION['username'] = $_POST['username'];
    $_SESSION['password'] = $_POST['password'];
  }
  if($_SESSION['password'] == "1234" && $_SESSION['username'] == "Framingham"){
    form();
  }else {
    error();
  }
   ?>
</body>
</html>
