<?php
session_start();
    $arr=$_SESSION['arr'] ;
    $connection=new mysqli('localhost','root','','hostel');
    $rol_no=$arr['Student_ID'];
    $noti_q="SELECT * FROM NOTICES AS N WHERE N.student_id=0 OR N.student_id='$rol_no'";
    $result_n=mysqli_query($connection,$noti_q);
    if(isset($_POST['submit'])){
      $s_name=$arr['full_name'];
      $roll=$arr['Student_ID'];
      $room_no=406;
      $msg=$_POST['msg'];
      $sql=$connection->prepare("INSERT INTO COMPLAINTS(Student_ID,Subject) 
      VALUES('$roll','$msg')");
      $sql->execute();
      //echo 'Data inserted successfully';
      $sql->close();
      $connection->close();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Page</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/landing.css" type="text/css">
</head>
<body>
<nav class="navbar">
  <!--brand image-->
  <a href="#" class="brand">
                <img src="https://image.flaticon.com/icons/svg/753/753354.svg" alt="logo">
           </a>
  <!--toggler-->
  <button class="toggler">
                <span class="line"></span>
                <span class="line"></span>
                <span class="line"></span>
            </button>

  <div class="nav-list-container">
    <ul class="nav-list">
    <li><a href="main_land.php">Home</a></li>
                    <li><a href="profile.php">Profile</a></li>
                    <li><a href="#">Settings</a></li>
                    <li><a href="#">Contact Us</a></li>
                    <li><a href="index.php">Log Out</a></li>
    </ul>
  </div>
</nav>
<main>
    <div style="text-align:centre;">
        <!-- just to make scrolling effect possible -->
      <h2 class="myH2">Welcome, <?php echo $arr['full_name']?></h2>
      <h4>Notifications</h4>
  </div>
  <div>
      <?php 
      $count=0;
      foreach($result_n as $a){ ?>
       <a href="landing.php?variable=<?php echo $arr?>"> <?php echo ++$count.". ".$a['Subject']?></a>;
      <?php }?>
      </div>
      
			
			
    </div>
    <div class="complaint">
    
    <!-- <button class="open-button fas fa-comments" aria-hidden="true" onclick="openForm()">Chat</button> -->
<script>var flag=true; </script>
<div id="toggle"class="chat" onclick="classList.toggle('active'); function fun_toggle(){ flag? openForm() : closeForm();} fun_toggle();">
      <div class="background"></div>
      <svg class="chat-bubble" width="100" height="100" viewBox="0 0 100 100">
        <g class="bubble">
          <path class="line line1" d="M 30.7873,85.113394 30.7873,46.556405 C 30.7873,41.101961
          36.826342,35.342 40.898074,35.342 H 59.113981 C 63.73287,35.342
          69.29995,40.103201 69.29995,46.784744" />
          <path class="line line2" d="M 13.461999,65.039335 H 58.028684 C
            63.483128,65.039335
            69.243089,59.000293 69.243089,54.928561 V 45.605853 C
            69.243089,40.986964 65.02087,35.419884 58.339327,35.419884" />
        </g>
        <circle class="circle circle1" r="1.9" cy="50.7" cx="42.5" />
        <circle class="circle circle2" cx="49.9" cy="50.7" r="1.9" />
        <circle class="circle circle3" r="1.9" cy="50.7" cx="57.3" />
      </svg>
    </div>
    <div class="chat-popup" id="myForm">
  <form action="main_land.php" class="form-container" method="POST">
    <h1>Complaint</h1>
    <textarea placeholder="Type your issue.." name="msg" required></textarea>

    <button type="submit" class="btn" name="submit">Send</button>
   
  </form>
</div>
    </div> 
    </main>

<!-- Jquery needed -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="../main.js"></script>
    <script >
      function openForm(){
  flag=false;
 document.getElementById("myForm").style.display = "block";

}

function closeForm() {
  flag=true;
  document.getElementById("myForm").style.display = "none";
}
    const toggler = document.querySelector('.navbar > .toggler'),
  navListContainer = document.querySelector('.navbar > .nav-list-container');

/*when toggler button is clicked*/
toggler.addEventListener(
  "click",
  () => {
    //convert hamburger to close
    toggler.classList.toggle('cross');
    //make nav visible
    navListContainer.classList.toggle('nav-active');
  },
  true
);

</script>

</body>

</html>