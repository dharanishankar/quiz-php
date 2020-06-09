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
      <a class="navbar-brand" href="adminindex.php">Quiz</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="adminindex.php">score</a></li>
      <li><a href="adcategory.php">Add/delete Category</a></li>
      <li><a href="adquestions.php">Add Questions</a></li>
        <li><a href="delquestions.php">Delete Questions</a></li>
        <li><a href="edcategory.php">Enable Category</a></li>
      <li><a href="addadmin.php">Add Admin</a></li>
      <li><a href="changeadpas.php">Change Password</a></li>
      
    </ul>

    <form method="post"><button name="logout" class="btn btn-danger navbar-btn pl-3">Logout</button></form>
  </div>
</nav>
<?php
$check="select * from category1 order by catid desc";
$result = mysqli_query($conn,$check);

?>

<center>
<form method="post">
 
    <select name="selec"  style="height:40px; width: 150px;">

            <?php while($row = mysqli_fetch_array($result)):;?>

            <option value="<?php echo $row['catname'];?>"><?php echo $row['catname'];?></option>

            <?php endwhile;?>

        </select>
        <button type="submit" name="sel" class="btn btn-danger navbar-btn pl-3">submit</button>
</form>
</center>

 <?php
 if(isset($_POST["sel"]))
 {
  $categname=$_POST['selec'];
  echo '<div class="d-flex justify-content-center">
    <div class=" bg-white col-sm-10 ">
    
<div class="panel-group">
    <div class="panel panel-default">
      <div class="panel-heading">Topics</div>
      <div class="panel-body">
    <table class="table table-hover">
  <thead class="thead-light">
    <tr>
      <th scope="col">#</th>
      <th scope="col">User Name</th>
      <th scope="col">Category Name</th>
      <th scope="col">Score</th>
    </tr>
  </thead>
  <tbody>';
  

$list="select * from score where catname='$categname' order by score desc";

if ($result = mysqli_query($conn,$list)) {
  $cid=1;
    while ($row = mysqli_fetch_assoc($result)) {
      $uid=$row['uid'];
      $un="select name from users where uid='$uid'";
      $re=mysqli_query($conn,$un);
      $row1 = mysqli_fetch_assoc($re);
        $catname = $row['catname'];
        $score = $row['score'];
        $uname=$row1['name'];
        echo '<tr> 
                  <td>'.$cid.'</td> 
                  <td>'.$uname.'</td> 
                  <td>'.$catname.'</td> 
                <td>'.$score.'</td>
              </tr>';
        $cid++;
    }
    $result->free();
} 

  echo'</tbody>
</table>
    </div>
    
  </div>
  </div>
  </div>
  </div>';
  
 }
 if(isset($_POST["logout"]))
{
   session_destroy();
   header("location:adminindex.php");
}
?>


</body>
</html>


