<?php
   // this function will delete the task 
    $db = new mysqli("localhost", "root", "root", "toDoList");
    $sql = "delete from tasks where id = ?";

    $stmt = $db->prepare($sql);

    $stmt->bind_param("i", $_REQUEST["id"]);

    $stmt->execute();

    $returnVal = $stmt->affected_rows;
    $stmt->close();
    $db->close();
    echo $returnVal;
?>





