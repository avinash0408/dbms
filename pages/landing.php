<?php
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



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Welcome <?php echo $arr['full_name']; ?>...</h1>
    <h3>Choose an Hostel</h3>
    <div style="width:25%" class="input-group">
  <select class="custom-select" id="inputGroupSelect04" aria-label="Example select with button addon">
    <option selected>Choose...</option>
    <?php foreach ($array as $num) : ?>
    <option><?= htmlspecialchars($num) ?></option>
    <?php endforeach ?>
  </select>
</div>
</body>
</html>