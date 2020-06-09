<?php
include 'conn.php';
session_start();
if(!isset($_SESSION['uid'])){
      header("location:index.php");
      die();
  }
  $caid=$_SESSION['caid'];
  $uid=$_SESSION['uid'];
  $categname="select catname from category where catid='$caid'";
  $res = mysqli_query($conn,$categname);
   $row = mysqli_fetch_assoc($res);
   $canam=$row['catname'];
  if(!isset($_POST['check']))
{
	$score="insert into score(uid,score,catid,catname) values('$uid',0,'$caid','$canam')";
	mysqli_query($conn,$score);
}
  $c=0;
if(isset($_POST['check']))
{
	
	foreach($_POST['check'] as $x => $x_value) {
    $answer="select ans from questions where qid='$x'";
    $result = mysqli_query($conn,$answer);
    $row = mysqli_fetch_assoc($result);
    if($x_value==$row['ans'])
    {
    	$c++;
    }
}
$score="insert into score(uid,score,catid,catname) values('$uid','$c','$caid','$canam')";
	mysqli_query($conn,$score);
}
echo "<script>
alert('Successfully submitted!!');
window.location.href='home.php';
</script>";

?>