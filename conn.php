<?php
$conn=mysqli_connect('localhost','username','yourpassword','quizdata');
if(!$conn)
{
	die("please check your connection".mysql_error());
}

?>