<?php
echo "Hey";
    if(isset($_POST['submit'])){
        $name=$_POST['name'];
        $phone=$_POST['phone'];
        $connection=new mysqli("localhost",'root','','do');
        $q="INSERT INTO testers VALUES('$phone','$name')";
        $result=$connection->prepare($q);
        $result->execute();
        $connection->close();


        
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="new.php" method="POST">
    <input type="text" name="name" placeholder="full name" required>
    <input type="text" placeholder="phone" name="phone" required> 
    <input type="submit" name="submit" value="submit">
    </form>
</body>
</html>