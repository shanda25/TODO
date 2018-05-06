<?php
 
    $db = new mysqli("localhost", "root", "root", "toDoList");
    
    $sql = "select * from tasks where status='completed'";
   
    $result = mysqli_query($db, $sql);
    
   // Return the number of rows in result set
   $rowcount=mysqli_num_rows($result);
   echo $rowcount;
?>

    

  
  
   


