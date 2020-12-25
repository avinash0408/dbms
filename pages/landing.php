
<?php
session_start();
    
$arr=$_SESSION['arr'] ;
  if(isset($_POST['submit'])){
    $roomie_id= $_POST['roomie_id'];
    $hostel= $_POST['hostel'];
    echo $hostel;
    echo $roomie_id;
    $you_=$arr['Student_ID'];
    echo $you;
  }

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
      if($row['Student_ID']!=$arr['Student_ID']){
       $roomies[$i]=$row['Student_ID'];
       $i=$i+1;
      }
   }
   if(isset($_POST['accept'])){
    echo $_POST['mate_id'];
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
      <select name="hostel" class="form-control" required>
        <option selected>Pick an Hostel</option>
        <?php foreach ($array as $num) : ?>
        <option ><?= htmlspecialchars($num) ?></option>
        <?php endforeach ?>
      </select>
    </div>
    <div class="form-control">
        <datalist id="suggestions">
            <?php foreach ($roomies as $num) :?>
        <option ><?= htmlspecialchars($num) ?></option>
        <?php endforeach ?>
        </datalist>
        <input  autoComplete="off" name="roomie_id" placeholder="search for roomie with id.."list="suggestions"/>     
    
  </div>
  <input type="submit" name="submit"  value="submit" />
  <input type="button" value="press" onClick="myF()">
  <input type="button" value="prev page" onClick="document.location.href='main_land.php'">
   </form>
   </div>
</div>

<script>
 function myF(){
  Snackbar.show({text: 'Example notification text.'});
 }
 
!function(a,b){"use strict";"function"==typeof define&&define.amd?define([],function(){return a.Snackbar=b()}):"object"==typeof module&&module.exports?module.exports=a.Snackbar=b():a.Snackbar=b()}(this,function(){var a={};a.current=null;var b={text:"Default Text",textColor:"#FFFFFF",width:"auto",showAction:!0,actionText:"Dismiss",actionTextAria:"Dismiss, Description for Screen Readers",alertScreenReader:!1,actionTextColor:"#4CAF50",showSecondButton:!1,secondButtonText:"",secondButtonAria:"Description for Screen Readers",secondButtonTextColor:"#4CAF50",backgroundColor:"#323232",pos:"bottom-left",duration:5e3,customClass:"",onActionClick:function(a){a.style.opacity=0},onSecondButtonClick:function(a){},onClose:function(a){}};a.show=function(d){var e=c(!0,b,d);a.current&&(a.current.style.opacity=0,setTimeout(function(){var a=this.parentElement;a&&
// possible null if too many/fast Snackbars
a.removeChild(this)}.bind(a.current),500)),a.snackbar=document.createElement("div"),a.snackbar.className="snackbar-container "+e.customClass,a.snackbar.style.width=e.width;var f=document.createElement("p");if(f.style.margin=0,f.style.padding=0,f.style.color=e.textColor,f.style.fontSize="14px",f.style.fontWeight=300,f.style.lineHeight="1em",f.innerHTML=e.text,a.snackbar.appendChild(f),a.snackbar.style.background=e.backgroundColor,e.showSecondButton){var g=document.createElement("button");g.className="action",g.innerHTML=e.secondButtonText,g.setAttribute("aria-label",e.secondButtonAria),g.style.color=e.secondButtonTextColor,g.addEventListener("click",function(){e.onSecondButtonClick(a.snackbar)}),a.snackbar.appendChild(g)}if(e.showAction){var h=document.createElement("button");h.className="action",h.innerHTML=e.actionText,h.setAttribute("aria-label",e.actionTextAria),h.style.color=e.actionTextColor,h.addEventListener("click",function(){e.onActionClick(a.snackbar)}),a.snackbar.appendChild(h)}e.duration&&setTimeout(function(){a.current===this&&(a.current.style.opacity=0,
// When natural remove event occurs let's move the snackbar to its origins
a.current.style.top="-100px",a.current.style.bottom="-100px")}.bind(a.snackbar),e.duration),e.alertScreenReader&&a.snackbar.setAttribute("role","alert"),a.snackbar.addEventListener("transitionend",function(b,c){"opacity"===b.propertyName&&"0"===this.style.opacity&&("function"==typeof e.onClose&&e.onClose(this),this.parentElement.removeChild(this),a.current===this&&(a.current=null))}.bind(a.snackbar)),a.current=a.snackbar,document.body.appendChild(a.snackbar);getComputedStyle(a.snackbar).bottom,getComputedStyle(a.snackbar).top;a.snackbar.style.opacity=1,a.snackbar.className="snackbar-container "+e.customClass+" snackbar-pos "+e.pos},a.close=function(){a.current&&(a.current.style.opacity=0)};
// Pure JS Extend
// http://gomakethings.com/vanilla-javascript-version-of-jquery-extend/
var c=function(){var a={},b=!1,d=0,e=arguments.length;"[object Boolean]"===Object.prototype.toString.call(arguments[0])&&(b=arguments[0],d++);for(var f=function(d){for(var e in d)Object.prototype.hasOwnProperty.call(d,e)&&(b&&"[object Object]"===Object.prototype.toString.call(d[e])?a[e]=c(!0,a[e],d[e]):a[e]=d[e])};d<e;d++){var g=arguments[d];f(g)}return a};return a});
//# sourceMappingURL=snackbar.min.js.map
</script>


</body>

</html>