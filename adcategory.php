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
      <li class="active"><a href="adcategory.php">Add/delete Category</a></li>
      <li><a href="adquestions.php">Add Questions</a></li>
        <li><a href="delquestions.php">Delete Questions</a></li>
        <li><a href="edcategory.php">Enable Category</a></li>
      <li><a href="addadmin.php">Add Admin</a></li>
      <li><a href="changeadpas.php">Change Password</a></li>
     
   
      
    </ul>

    <form method="post"><button name="logout" class="btn btn-danger navbar-btn pl-3">Logout</button></form>

  </div>
</nav>

<div class="container">
  <div class="row">
    <div class="col-sm-6" >
  <div class="panel panel-default">
    <div class="panel-heading">Add Category</div>
    <div class="panel-body">
    	
    	<form method="post">
  <div class="form-group">
    <label>Category Name:</label>
    <input type="text" class="form-control" name="categname" required>
  </div>
  <div class="form-group">
    <label>Duration(minutes):</label>
    <input type="number" min="1" class="form-control" name="duration" required>
  </div>
  <div class="form-group">
    <label>Number Of Questions:</label>
    <input type="number" min="1" class="form-control" name="lim" required>
  </div>
  

  <button name="adbtn" type="submit" class="btn btn-success">Add</button>
</form>
    </div>
  </div>
</div>
<?php
$check="select * from category order by catid";
$result = mysqli_query($conn,$check);

?>
    <div class="col-sm-6">

  <div class="panel panel-default">
    <div class="panel-heading">Delete Category</div>
    <div class="panel-body">
    	
    	<form method="post">
     <select name="selec"  style="height:40px; width: 150px;">

            <?php while($row = mysqli_fetch_array($result)):;?>

            <option value="<?php echo $row['catid'];?>"><?php echo $row['catname'];?></option>

            <?php endwhile;?>

        </select>

  <button name="delcat" type="submit" class="btn btn-success">Delete</button>
</form>
    </div>
  </div>
</div>
  </div>
</div>
 

<?php
if(isset($_POST["adbtn"]))
{
	$li=$_POST['lim'];
	$duration=$_POST['duration'];
	$categname=$_POST['categname'];
	$query="insert into category(catname,duration,lim,active) values('$categname','$duration','$li',0)";
	$query1="insert into category1(catname,duration,lim,active) values('$categname','$duration','$li',0)";

if(mysqli_query($conn,$query)==true && mysqli_query($conn,$query1)==true)
{
	echo "<script>
alert('successfully added');
window.location.href='adcategory.php';
</script>";
}

}
if(isset($_POST['delcat']))
{
	$dcat=$_POST['selec'];
	$delquery="delete from questions where catid='$dcat'";;
	$delquery1="delete from category where catid='$dcat'";
	if(mysqli_query($conn,$delquery)==true && mysqli_query($conn,$delquery1)==true)
{
	echo "<script>
alert('successfully deleted');
window.location.href='adcategory.php';
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