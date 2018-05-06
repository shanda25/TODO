<?php
    $id = $_POST["id"];
    $status = $_POST["status"];
 
    $db = new mysqli("localhost", "root", "root", "toDoList");  
    $sql = "UPDATE tasks SET status=? WHERE id=?";
    $stmt = $db->prepare($sql);
    if ($status == "true") {
		$status1='completed';
	    $stmt->bind_param("si",$status1, $id);
    } else {
		$status1='incomplete';
	    $stmt->bind_param("si", $status1, $id);
    }
    $stmt->execute();

    $returnVal = $stmt->affected_rows;
    $stmt->close();
    $db->close();
    echo $returnVal;
?>
