<?php
include 'conn.php';
session_start();
if(!isset($_SESSION['uid'])){
      header("location:index.php");
      die();
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Home</title>
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
      <a class="navbar-brand" href="index.php">Quiz</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="index.php">Home</a></li>
      <li><a href="score.php">Score</a></li>
      <li><a href="changepass.php">Change Password</a></li>
      </form></li>
      
    </ul>

    <form method="post"><button name="logout" class="btn btn-danger navbar-btn pl-3">Logout</button></form>
  </div>
</nav>


<div class="col-sm-10">
<div class="panel-group">
    <div class="panel panel-default">
      <div class="panel-heading">Topics</div>
      <div class="panel-body">
      	
      	<table class="table table-hover">
  <thead class="thead-light">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Category Name</th>
      <th scope="col">Duration(minutes)</th>
      <th scope="col">Take Quiz</th>
    </tr>
  </thead>
  <tbody>
    <?php
$cuid=$_SESSION['uid'];
$list="select * from category where catid not in (select catid from score where uid='$cuid') and active=1 order by catid desc";

if ($result = mysqli_query($conn,$list)) {
	$cid=1;
    while ($row = mysqli_fetch_assoc($result)) {
    	
    	$catid=$row['catid'];
        $catname = $row['catname'];
        $duration = $row['duration'];
 
        echo '<tr> 
                  <td>'.$cid.'</td> 
                  <td>'.$catname.'</td> 
                  <td>'.$duration.'</td> 
             		<td><form method="post" action="quiz.php"><button type="submit" name="takequiz" class="btn btn-primary" value='.$catid .'>Take Quiz</button></form></td>
              </tr>';
        $cid++;
    }
    $result->free();
} 

?>
    

   
  </tbody>
</table>

      </div>
    </div>

</div>
</div>
 <?php
 if(isset($_POST["logout"]))
{
   session_destroy();
   header("location:index.php");
}
?>


</body>
</html>
