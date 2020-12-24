<?php
  if(isset($_POST['submit'])){
    echo $_POST['roomie_id'];
  
  }
session_start();
    

    $arr=$_SESSION['arr'] ;
    //echo $arr['name'];
    $curr_year = date("Y"); 
    $curr_month=date("m");
    #echo $curr_month;
    $curr_year=substr($curr_year,2,4);
    $stu_year=$arr['Student_ID'];
    $stu_year=substr($stu_year,1,2);
    $batch=(int)$curr_year-(int)$stu_year;
    if($curr_month>7) $batch=$batch+1;
    $connection=new mysqli('localhost','root','','hostel');
    $check="SELECT *  FROM HOSTELS WHERE Batch='$batch'";
    $result=mysqli_query($connection,$check);
   // $array=mysqli_fetch_array($result_mail);
   $i=0;
   $array=array();
    while($row = mysqli_fetch_array($result)) {
       // print_r($row);
        $array[$i]=$row['Hostel_name'];
        $i=$i+1;
    }
    $i=0;
    $roomate_q="SELECT * FROM STUDENTS WHERE Student_ID LIKE '_$stu_year%'";
    $rresult=mysqli_query($connection,$roomate_q);
    $roomies=array();
    while($row = mysqli_fetch_array($rresult)) {
      // print_r($row);
       $roomies[$i]=$row['Student_ID'];
       $i=$i+1;
   }
  


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <link rel="stylesheet" href="../css/add_hostel.css">
</head>
<body>
<div>
    <h1>Welcome <?php echo $arr['full_name']; ?>...</h1>
    <div class="form">
    <form action="landing.php" method="POST">
        <div style="width:25%" class="form-control">
      <select class="form-control">
        <option selected>Pick an Hostel</option>
        <?php foreach ($array as $num) : ?>
        <option><?= htmlspecialchars($num) ?></option>
        <?php endforeach ?>
      </select>
    </div>
    <div class="form-control">
        <datalist id="suggestions">
            <?php foreach ($roomies as $num) : ?>
        <option name="roomie-id"><?= htmlspecialchars($num) ?></option>
        <?php endforeach ?>
        </datalist>
        <input  autoComplete="on" name="roomie_id" placeholder="search for roomie with id.."list="suggestions"/>     
    </div>
  </div>
  <input type="submit" name="submit"  value="submit"/>
  <input type="button" value="prev_page" onClick="document.location.href='main_land.php'">
   </form>
</div>
</body>

</html>