<?php
include 'conn.php';
session_start();
if(isset($_SESSION['uid'])){
      header("location:home.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Quiz</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
  <h2>Quiz</h2><br>
</div>

	<div class="container">
  <div class="row">
    <div class="col-sm-6" >
  <div class="panel panel-default">
    <div class="panel-heading">Login</div>
    <div class="panel-body">
    	
    	<form method="post" action="login.php">
  <div class="form-group">
    <label for="email">Email address:</label>
    <input type="email" class="form-control" name="email" required>
  </div>
  <div class="form-group">
    <label for="pwd">Password:</label>
    <input type="password" class="form-control" name="pwd" required>
  </div>

  <button type="submit" class="btn btn-success">Login</button>
</form>
    </div>
  </div>
</div>
    <div class="col-sm-6">

  <div class="panel panel-default">
    <div class="panel-heading">Signup</div>
    <div class="panel-body">
    	
    	<form method="post" action="signup.php">
    		 <div class="form-group">
    <label for="name">User Name:</label>
    <input type="text" class="form-control" name="name" required>
  </div>
  <div class="form-group">
    <label for="email">Email address:</label>
    <input type="email" class="form-control" name="email" required>
  </div>
  <div class="form-group">
    <label for="pwd">Password:</label>
    <input type="password" class="form-control" name="pwd" required>
  </div>

  <button type="submit" class="btn btn-success">Signup</button>
</form>
    </div>
  </div>
</div>
  </div>
</div>
 





</body>
</html>

