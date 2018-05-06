<?php
    header('Content-type: application/json');

    $db = new mysqli("localhost", "root", "root", "toDoList");

    $sql = "select * from tasks"; // select all the tasks from the database

    $stmt = $db->prepare($sql);

    $stmt->bind_result($id, $desc, $status);

    $stmt->execute();

    $tasks = array();
    while($stmt->fetch()) {
        $task = (array("id"=>$id, "description"=>$desc, "status"=>$status));
        $tasks[] = $task;
    }
     echo json_encode($tasks);
?>

    

  
  
   


