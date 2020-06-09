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
      <li><a href="addadmin.php">Add Admin</a></li>
      <li class="active"><a href="changeadpas.php">Change Password</a></li>
     
   
      
    </ul>

    <form method="post"><button name="logout" class="btn btn-danger navbar-btn pl-3">Logout</button></form>

  </div>
</nav>


  <div class="container">
  <div class="row align-items-center">
  
    <div class="col-sm-6">

  <div class="panel panel-default">
    <div class="panel-heading">Change Password</div>
    <div class="panel-body">
      
      <form method="post">
         <div class="form-group">
    <label for="name">Old Password:</label>
    <input type="password" class="form-control" name="oldpass" required>
  </div>
  <div class="form-group">
    <label for="email">New Password:</label>
    <input type="password" class="form-control" name="newpass" required>
  </div>
  <div class="form-group">
    <label for="pwd">Confirm Password:</label>
    <input type="password" class="form-control" name="conpass" required>
  </div>

  <button type="submit" name="change" class="btn btn-success">Change</button>
</form>
    </div>
  </div>
</div>
  </div>
</div>
 <?php
 if(isset($_POST["change"]))
{
   $old=$_POST['oldpass'];
   $newpas=$_POST['newpass'];
   $conpas=$_POST['conpass'];
   $userid=$_SESSION['auid'];
   if($newpas==$conpas)
   {
    $pq="select password from admins where auid='$userid'";
    $result = mysqli_query($conn,$pq);
    $row = mysqli_fetch_assoc($result);
    if($old==$row['password'])
    {
      $cp="update admins set password='$newpas' where auid='$userid'";
      if(mysqli_query($conn,$cp)==TRUE)
      {
        echo '<script>alert("password changed successfully")</script>'; 
      }
      else
      {
        echo '<script>alert("Error.please try later")</script>'; 
      }
      
    }
    else
    {
      echo '<script>alert("please check your old password")</script>'; 
  
    }
   }
   else
   {
    echo '<script>alert("password mismatch")</script>'; 
   }
}
?>


<?php
 if(isset($_POST["logout"]))
{
   session_destroy();
   header("location:adminindex.php");
}
?>
</body>
</html>