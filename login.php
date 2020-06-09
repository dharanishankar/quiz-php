<?php
include 'conn.php';
session_start();
$email=$_POST['email'];
$pass=$_POST['pwd'];
if($email=='' || $pass=='')
{
	header("location:index.php");

}
$check="select uid from users where email='$email' and password='$pass'";
$result = mysqli_query($conn,$check);
$row = mysqli_fetch_assoc($result);
$count = mysqli_num_rows($result);
if($count>0)
{
	$_SESSION['uid'] = $row['uid'];
	header("location:home.php");

}
else
{
	echo "<script>
alert('invalid data');
window.location.href='index.php';
</script>";
}
?>