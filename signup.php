<?php
include 'conn.php';
$user=$_POST['name'];
$pass=$_POST['pwd'];
$email=$_POST['email'];
if($email=='' || $pass=='' || $user=='')
{
	header("location:index.php");

}
else
{
	$insert="insert into users(name,email,password) values('$user','$email','$pass')";
if (mysqli_query($conn,$insert) === TRUE) {
    echo "<script>
alert('signup success!! click ok and login');
window.location.href='index.php';
</script>";
} else {
    echo "<script>
alert('email already exist');
window.location.href='index.php';
</script>";
};
}

?>