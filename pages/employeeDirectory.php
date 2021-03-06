<?php
session_start();
  /*
  Name: employeeDirectory.php

  This is a table of all entries in the employee information table, and their associated entries.
  */
  //Display table if password is "password"
  //Put all information for main page in here!!!!
function form(){
  //echo table header
  echo "
    <div class='navigation'>
      <div class='icon'>
        <i class='fa fa-bars fa-2x' aria-hidden='true'></i>
      </div>
      <div class='nav-items'>
        <a class='nav-item' href='./mainPage.php'>Home</a>
        <a class='nav-item' href='./employeeDirectory.php'>Employee Directory</a>
        <a class='nav-item' href='./entry.php?type=new'>Add User</a>
        <a class='nav-item' href='../index.php' class='logout'>Logout</a>
      </div>
      </div>
    <div class='site-wrap bg'>
      <h1>Employee Directory</h1>
      <div class='body-navigation-widget'>
        <h3>Table Navigation</h3>
        <nav>
          <a href='./mainPage.php'>
            <i class='fa fa-home' aria-hidden='true'></i><br/>Home</a>
          <a href='./entry.php?type=new'>
            <i class='fa fa-pencil' aria-hidden='true'></i><br/>Add Employee</a>
          <a href='./search.php'>
            <i class='fa fa-search' aria-hidden='true'></i><br/>Search Directory</a>
        </nav>
      </div>
      <div style='overflow-x:auto;'>
      <table bgcolor=#414141 border=1>
        <th>Employee Number</th>
        <th>Employee Name</th>
        <th>Employee Photo</th>
        <th>Date Joined</th>
        <th>Department</th>
        <th>Annual Salary</th>
        <th>Project Involved</th>
        <th>Modify / Edit</th>";

        //connect to SQL and populate all employees and photos
        $link = mysqli_connect("127.0.0.1:8889", "root", "root", "test") or die ("cannot connect");

        $sql = "SELECT * FROM employeeInformation";

        $result = mysqli_query($link, $sql) or die ("query failed" . mysqli_connect_error());

        while($info = mysqli_fetch_assoc($result))
          {
            $count++;

            $query = "SELECT image FROM EmployeePhotos WHERE EmployeeNumber = '$info[EmployeeNumber]';";

            $photo = mysqli_query($link, $query) or die("Query failed" .mysqli_connect_error());

            $row = mysqli_fetch_ASSOC($photo);

            //echo back as table
            echo "<tr>";
            echo "<td>$info[EmployeeNumber]</td>";
            echo "<td>$info[EmployeeName]</td>";
            echo "<td>";
            echo '<img src="data:image/jpeg;base64,'. base64_encode($row['image']) .'" alt="No Image" style="width:45px; height:45px;"" />';
            echo "</td>";
            echo "<td>$info[DateJoined]</td>";
            echo "<td>$info[Department]</td>";
            echo "<td>$$info[AnnualSalary]</td>";
            echo "<td>$info[Project]</td>";
            echo "<td style='background-color: #FFFFFF; padding:0;'><a href='./entry.php?type=modify&employee=$info[EmployeeNumber]'><div class='button' style='margin:0;'>Modify / Delete</div></a></td>";
            echo "</tr>";
          }
  echo "</table>
    </div><footer>	&copy; FRAMINGHAM STATE UNIVERSITY ALL RIGHTS RESERVED<br/>Developed by: Robert Bernier and Andrew Jung, Framingham State University</footer></div>";
}
//error if access is denied.
function error(){
  echo "
  <div class='login animation-fast'>
    <div class='outer'>
      <div class='container'>
        <i class='fa fa-thumbs-down fa-4x'></i>
        <p>You are not allowed to get into the system!</p><br/><a class='button' href='../index.php'>Return to Login</a>
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
  <title>Employee Directory</title>
  <link rel="stylesheet" href="../css/style.css"/>
  <link rel="stylesheet" href="../css/font-awesome.min.css">
  <link rel="stylesheet" href="../css/body-navigation-widget.css"/>
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
