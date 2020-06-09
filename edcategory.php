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
      <li><a href="adminindex.php">score</a></li>
      <li><a href="adcategory.php">Add/delete Category</a></li>
      <li><a href="adquestions.php">Add Questions</a></li>
        <li><a href="delquestions.php">Delete Questions</a></li>
        <li class="active"><a href="edcategory.php">Enable Category</a></li>
      <li><a href="addadmin.php">Add Admin</a></li>
      <li><a href="changeadpas.php">Change Password</a></li>
      

      
    </ul>

    <form method="post"><button name="logout" class="btn btn-danger navbar-btn pl-3">Logout</button></form>
  </div>
</nav>

<?php
$check="select * from category order by catid desc";
$result = mysqli_query($conn,$check);

?>

<center>
<form method="post">
 
    <select name="selec"  style="height:40px; width: 150px;">

            <?php while($row = mysqli_fetch_array($result)):;?>

            <option value="<?php echo $row['catid'];?>"><?php echo $row['catname'];?></option>

            <?php endwhile;?>

        </select>
        <button type="submit" name="sel" class="btn btn-danger navbar-btn pl-3">Enable</button>
        <button type="submit" name="sel1" class="btn btn-danger navbar-btn pl-3">Disable</button>
</form>
</center>


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
      <th scope="col">Enabled/Disabled</th>
    </tr>
  </thead>
  <tbody>
    <?php
$list="select * from category order by catid desc";

if ($result = mysqli_query($conn,$list)) {
  $cid=1;
    while ($row = mysqli_fetch_assoc($result)) {
      
      $active=$row['active'];
        $catname = $row['catname'];
        $duration = $row['duration'];
        if($active==1)
        {
          $a="Enabled";
        }
        else
        {
          $a="Disabled";
        }
        echo '<tr> 
                  <td>'.$cid.'</td> 
                  <td>'.$catname.'</td> 
                  <td>'.$duration.'</td> 
                 <td>'.$a.'</td> 
              </tr>';
        $cid++;
    }
    $result->free();
} 

?>

<?php
if(isset($_POST["sel"]))
{
  $caid=$_POST['selec'];

  $edquery="update category set active=1 where catid='$caid'";
  if(mysqli_query($conn,$edquery)==TRUE)
  {
    echo "<script>
alert('successfully enabled');
window.location.href='edcategory.php';
</script>";
} else {
    echo "<script>
alert('Not enabled');
window.location.href='edcategory.php';
</script>";
}
  }

if(isset($_POST["sel1"]))
{
  $caid=$_POST['selec'];

  $edquery="update category set active=0 where catid='$caid'";
  if(mysqli_query($conn,$edquery)==TRUE)
  {
    echo "<script>
alert('successfully disabled');
window.location.href='edcategory.php';
</script>";
} else {
    echo "<script>
alert('Not disabled');
window.location.href='edcategory.php';
</script>";
}
  }
if(isset($_POST["logout"]))
{
   session_destroy();
   header("location:adminindex.php");
}


?>


</body>
</html>


