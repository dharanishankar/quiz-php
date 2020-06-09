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
      <li class="active"><a href="adquestions.php">Add Questions</a></li>
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
    <div class="col-sm-10" >
  <div class="panel panel-default">
    <div class="panel-heading">Add Questions</div>
    <div class="panel-body">
      <?php
$check="select * from category order by catid";
$result = mysqli_query($conn,$check);

?>
      <form method="post">
        <div class="form-group">
    <label>Category Name:</label>
          <select name="selec"  style="height:30px; width: 150px;">

            <?php while($row = mysqli_fetch_array($result)):;?>

            <option value="<?php echo $row['catid'];?>"><?php echo $row['catname'];?></option>

            <?php endwhile;?>

        </select>
        </div>
  <div class="form-group">
    <label>Question:</label>
    <input type="text" class="form-control" name="ques" required>
  </div>
  <div class="form-group">
    <label>Option 1:</label>
    <input type="text" class="form-control" name="op1" required>
  </div>
  <div class="form-group">
    <label>Option 2:</label>
    <input type="text" class="form-control" name="op2" required>
  </div>
<div class="form-group">
    <label>Option 3:</label>
    <input type="text" class="form-control" name="op3" required>
  </div>
<div class="form-group">
    <label>Option 4:</label>
    <input type="text" class="form-control" name="op4" required>
  </div>
  <div class="form-group">
    <label>Answer:</label>
    <input type="number" min="1" max="4" class="form-control" name="ans" required>
  </div>



     

  <button name="adques" type="submit" class="btn btn-success">Add</button>
</form>
    </div>
  </div>
</div>
   
  </div>
</div>
 

<?php
 if(isset($_POST["logout"]))
{
   session_destroy();
   header("location:adminindex.php");
}

if(isset($_POST["adques"]))
{
  $catid=$_POST['selec'];
  $question=$_POST['ques'];
  $op1=$_POST['op1'];
  $op2=$_POST['op2'];
  $op3=$_POST['op3'];
  $op4=$_POST['op4'];
  $answer=$_POST['ans'];
 
  $query="insert into questions(catid,question,op1,op2,op3,op4,ans) values('$catid','$question','$op1','$op2','$op3','$op4','$answer')";
 

if(mysqli_query($conn,$query)==true)
{
  echo "<script>
alert('successfully added');
window.location.href='adquestions.php';
</script>";
}

}
?>


</body>
</html>