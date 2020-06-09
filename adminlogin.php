<?php
include 'conn.php';
session_start();
$email=$_POST['email'];
$pass=$_POST['pwd'];
if($email=='' || $pass=='')
{
	header("location:adminindex.php");

}
$check="select auid from admins where email='$email' and password='$pass'";
$result = mysqli_query($conn,$check);
$row = mysqli_fetch_assoc($result);
$count = mysqli_num_rows($result);
if($count>0)
{
	$_SESSION['auid'] = $row['auid'];
	header("location:adminhome.php");

}
else
{
	echo "<script>
alert('invalid data');
window.location.href='adminindex.php';
</script>";
}
?>