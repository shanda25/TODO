$(document).ready(function() {
    loadAllTasks();  
    status();       
    statusin();
    $("#addTask").click(function() {
        var new_task = $('#description').val();
        if (new_task != '') {
                $.ajax({
                    type: "POST",
                    url: "addTask.php",
                    data: "description=" + new_task,
                    success: function(task) {
                        var jsonObj = JSON.parse(task);
                        addTaskToUI(jsonObj);
                    }
            }, "json");
    } else {
      alert ("addTask can't be empty");
    }
    })
})

// it will check the status of task completed/incompleted
function checkBoxStatus(checkbox,id) {
     if($(checkbox).prop("checked") == true) {
                changeStatus(checkbox.value, true);
                status();
                statusin();
            }
            else if($(checkbox).prop("checked") == false){  
                changeStatus(checkbox.value, false);
                 status();
                 statusin(); 
            }
}

// it will post the status of the task
function changeStatus(id, status) {
    $.ajax({
        url: 'changeStatus.php',
        type: 'POST',
        data: "id="+id+"&status="+status,
        success: function(data) {
        }
    });
}

// it will return the number of tasks completed
function status() {
    $.ajax({
    type: "GET",
    url: "status.php",
    success:function(data) {
        $("#task_completed").text(data);
    }
})
}

// it will return the incompleted tasks
function statusin() {
    $.ajax({
    type: "GET",
    url: "statusin.php",
    success:function(type) {
        $("#task_incompleted").text(type);
    }
})
}
 
// it will load all the tasks  
function loadAllTasks() {
    $.get("allTasks.php", function(tasks) {
    $(tasks).each(function(index,item) {
            addTaskToUI(item);
        })
    }, "json");
}

// it will add the tasks to index.html
function addTaskToUI(task) {
    if(task.status == 'incomplete') {
        var img = $("<p id='task_" + task.id + "'><input type='checkbox' value='"+task.id+"' onclick='checkBoxStatus(this,"+ task.id+")'><img src='../TODO/delete.png' height='20px' width='40px' onclick='deleteTask(" + task.id + ")'>" + task.description + "</p>");
} else {
      var img = $("<p id='task_" + task.id + "'><input type='checkbox' checked='checked' value='"+task.id+"' onclick='checkBoxStatus(this,"+ task.id+")'><img src='../TODO/delete.png' height='20px' width='40px' onclick='deleteTask(" + task.id + ")'>" + task.description + "</p>");
}
    $("#tasks").append(img);
}

// it will delete the tasks
function deleteTask(id) {
    $("#task_" + id).remove();
    $.ajax({
        type: "POST",
        url: "deleteTask.php",
        data: "id=" + id,
    })
    status();
    statusin();
}
