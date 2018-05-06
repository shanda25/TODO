<?php
    $userName = "root";
    $password = "root";
    $dbName = "toDoList";
    $server = "localhost";
    
    $db = new mysqli("localhost", "root", "root", "toDoList");

    $sql = "insert into tasks(description, status) values(?, ?)";

    $stmt = $db->prepare($sql);

    $defaultStatus = "incomplete";
    $stmt->bind_param("ss", $_REQUEST["description"], $defaultStatus);

    $stmt->execute();
    $newId = $db->insert_id;
    $db->close();

    $db = new mysqli($server, $userName, $password, $dbName);
    $sql = "select * from tasks where id=?";
    $selectTaskStmt = $db->prepare($sql);

    $selectTaskStmt->bind_param("i", $newId);
    $selectTaskStmt->bind_result($id, $desc, $status);
    $selectTaskStmt->execute();
    $selectTaskStmt->fetch();

    $task = (array("id" =>$newId, "description"=>$desc, "status"=>$status));
    
    echo json_encode($task);
?>
