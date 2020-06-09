
<?php
include 'conn.php';
session_start();
if(!isset($_SESSION['uid'])){
      header("location:index.php");
      die();
  }
  if(!isset($_POST['takequiz']))
  {
   header("location:home.php"); 
  }
  $uid=$_SESSION['uid'];
$qqcid=$_POST['takequiz'];
$_SESSION['caid']=$qqcid;
  $q="select * from score where catid='$qqcid' and uid='$uid'";
  $rt = mysqli_query($conn,$q);
$count = mysqli_num_rows($rt);
if($count>0)
{
  echo "<script>
alert('test already taken');
window.location.href='home.php';
</script>";
  
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Quiz</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body onbeforeunload ='checkWH()'> 
  <script>
function checkRequest(event){
                event.preventDefault();
                event.returnValue = '';
                var __type= event.currentTarget.performance.navigation.type;
                if(__type === 1 || __type === 0){
                    // alert("Browser refresh button is clicked...");
                    document.getElementById('frm1').submit();
                }
                else if(__type ==2){
                    alert("Browser back button is clicked...");
                }
            }
            function checkWH(){
    if((window.outerWidth-screen.width) ==0 && (window.outerHeight-screen.height) ==0 )
    {
        alert('fullscreen');
    }
}

$(window).keypress(function(event){
    var code = event.keyCode || event.which;
    if(code == 122){
        setTimeout(function(){checkWH();},1000);
    }
});


</script>
<p id="demo" style="text-align: center;
  font-size: 30px;
  margin-top: 2px;"></p>
<div class="container">

  <div class="d-flex justify-content-center mb-3">
    <div class="p-2 bg-white col-sm-10"><div class="card" style="width: 100%;">
      <form method="post" action="generatescore.php" name="genscore" id="frm1">
  <?php

$list1="select * from category where catid='$qqcid'";
$r2=mysqli_query($conn,$list1);
$rw=mysqli_fetch_assoc($r2);
$duration=$rw['duration'];
$l=$rw['lim'];
$list="select * from questions where catid='$qqcid' order by rand() limit $l;";

if ($result = mysqli_query($conn,$list)) {

echo'<script>
var countdown ='.$duration.'* 60 * 1000;
var timerId = setInterval(function(){
  countdown -= 1000;
  var min = Math.floor(countdown / (60 * 1000));
  //var sec = Math.floor(countdown - (min * 60 * 1000));  // wrong
  var sec = Math.floor((countdown - (min * 60 * 1000)) / 1000);  //correct

  if (countdown <= 0) {
     alert("Time out!!");
     clearInterval(timerId);
     document.genscore.submit();
  } else {
     document.getElementById("demo").innerHTML ="Time Left: "+min + " : " + sec;
  }

}, 1000); //1000ms. = 1sec.
</script>';


  $cid=1;
    while ($row = mysqli_fetch_assoc($result)) {
      
        $ques=$row['question'];
        $op1 = $row['op1'];
        $op2 = $row['op2'];
        $op3 = $row['op3'];
        $op4 = $row['op4'];
        $qid= $row['qid'];
        echo '<div class="card-header">'
   .$cid.' '.$ques.'
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item">
  <input type="radio" name="check['.$qid.']" value="1" >'.$op1.'
</li>
    <li class="list-group-item">
  <input type="radio" name="check['.$qid.']" value="2">' .$op2.'
</li>
    <li class="list-group-item">
  <input type="radio" name="check['.$qid.']" value="3" >'.$op3.'
</li>
    <li class="list-group-item">
  <input type="radio" name="check['.$qid.']" value="4"> '.$op4.'
</li>
  </ul>';
        $cid++;
    }
    $result->free();
} 

?>


<div class="card-header">
    <button type="Submit" class="btn btn-primary">Submit</button>
  </div>
</div>
</form>

</div>
   
  </div>

</div>




</body>
</html>



