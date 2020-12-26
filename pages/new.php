<?php
session_start();
$arr=$_SESSION['arr'];
$rol_no=$arr['Student_ID'];
$connection=new mysqli('localhost','root','','hostel');
    $q1="SELECT * FROM room_requests WHERE sender_id='$rol_no' AND flag!='0'";
    $q1_res=mysqli_query($connection,$q1);
    $notif=array();
    $sub=array();
    foreach($q1_res as $a){
      $sub['sender']=$a['receiver_id'];
      $dum= $sub['sender'];
      $q1_1="SELECT * FROM STUDENTS WHERE Student_ID='$dum'";
      $q1_1_res=mysqli_fetch_array(mysqli_query($connection,$q1_1));
      $sub['sender_name']=$q1_1_res['full_name'];
      if($a['flag']==1)
      $sub['msg']=$q1_1_res['full_name']." has accepted your room request";
      else
      $sub['msg']=$q1_1_res['full_name']." has rejected your room request";
      array_push($notif,$sub);
    }
    $q1="SELECT * FROM NOTICES WHERE student_id='$rol_no'";
    $q1_res=mysqli_query($connection,$q1);
    foreach($q1_res as $a){
      $sub['sender']=$a['Admin_ID'];
      $dum= $sub['sender'];
      $q1_1="SELECT * FROM Admin WHERE Admin_ID='$dum'";
      $q1_1_res=mysqli_fetch_array(mysqli_query($connection,$q1_1));
      $sub['sender_name']=$q1_1_res['Fname']." ".$q1_1_res['Lname'];
      $sub['msg']=$a['Subject'];
      array_push($notif,$sub);
    }
    if(isset($_POST['clear'])){
      $sender=$_POST['sender'];
      echo $sender;
    }
//echo $arr['name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<?php foreach($notif as $not){ ?>
<div aria-live="polite" aria-atomic="true" class="d-flex justify-content-center align-items-center" style="min-height: 200px;">

  <!-- Then put toasts within -->
  <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" style="opacity:2">
    <div class="toast-header">
      <strong class="mr-auto"><?php echo $not['sender_name']?></strong>
      <form action="new.php" method="post">
      <small><input type="hidden" name="sender"><?php echo $not['sender']?></small>
      <button type="submit" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close" name="clear">
        <span aria-hidden="true">&times;</span>
      </button> 
      </form>
    </div>
    <div class="toast-body">
    <?php echo $not['msg']?>
    </div>
  </div>
</div>
<?php }?>
</body>
</html>