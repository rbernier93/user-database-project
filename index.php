<?php
session_start();
session_unset();
 ?>
<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <title>Advanced Web Database </title>
    <link rel="stylesheet" href="css/style.css"/>
    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="./css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>-->
  </head>
  <body class="bg">
    <div class="login animation-fast">
    <div class="outer">
      <div class="container">
      <!--Login Page-->
      <table>
        <form action="./pages/mainPage.php" method="post">
          Username:<br/>
          <input type="text" name="username"><br/>
          Password:<br/>
          <input type="password" name="password"><br/>
            <button type="submit">Submit</button>
            <button type="reset">Reset</button>
          </form>
          <p>
            Hint: Username: Framingham, Password: 1234
          </p>
      </table>
      </div>
    </div>
    </div>
  </body>

</html>
