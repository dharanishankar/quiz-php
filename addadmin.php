<?php
include 'conn.php';
session_start();
if(!isset($_SESSION['auid'])){
      header("location:adminindex.php");
      die();
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

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="adminindex.php">Quiz</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="adminindex.php">score</a></li>
      <li><a href="adcategory.php">Add/delete Category</a></li>
      <li><a href="adquestions.php">Add Questions</a></li>
        <li><a href="delquestions.php">Delete Questions</a></li>
        <li><a href="edcategory.php">Enable Category</a></li>
      <li class="active"><a href="addadmin.php">Add Admin</a></li>
      <li><a href="changeadpas.php">Change Password</a></li>
     
   
      
    </ul>

    <form method="post"><button name="logout" class="btn btn-danger navbar-btn pl-3">Logout</button></form>

  </div>
</nav>

<div class="container">
  <div class="row">
    <div class="col-sm-6" >
  <div class="panel panel-default">
    <div class="panel-heading">Admin Login</div>
    <div class="panel-body">
      
      <form method="post">
  <div class="form-group">
    <label for="email">Email address:</label>
    <input type="email" class="form-control" name="email" required>
  </div>
  <div class="form-group">
    <label for="pwd">Password:</label>
    <input type="password" class="form-control" name="pwd" required>
  </div>

  <button type="submit" name="adadmin" class="btn btn-success">Add</button>
</form>
    </div>
  </div>
</div>

<?php
 if(isset($_POST["logout"]))
{
   session_destroy();
   header("location:adminindex.php");
}
if(isset($_POST["adadmin"]))
{
  $email=$_POST['email'];
  $password=$_POST['pwd'];
  $insert="insert into admins(email,password) values('$email','$password')";
if (mysqli_query($conn,$insert) === TRUE) {
    echo "<script>
alert('new admin added successfully');
window.location.href='adminhome.php';
</script>";
} else {
    echo "<script>
alert('admin email already exist');
window.location.href='addadmin.php';
</script>";
};
}
?>


</body>
</html>