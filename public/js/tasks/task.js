function addTask() {
    let tasksEl = document.getElementById("tasks");

    let taskNumber = tasksEl.childElementCount;

    let taskDescriptionEl =
        '<div class="row"><div class="col-sm-4">' +
        '<div class="form-group">' +
        ' <label class="label font-weight-bold" for="task-description">Task description</label>' +
        ' <input type="text" class="form-control" id="task-description" name="tasks[' +
        taskNumber +
        '][description]" placeholder="Enter task description" required>' +
        "</div>" +
        "</div>";

    taskDeadlineEl =
        '<div class="col-sm-2">' +
        '<div class="form-group date" data-provide="datepicker">' +
        '<label class="label font-weight-bold" for="task-deadline">Deadline</label>' +
        '<input type="text" class="form-control datepicker" name="tasks[' +
        taskNumber +
        '][deadline]" id="datepicker' +
        taskNumber +
        '" autocomplete="off">' +
        "</div>" +
        "</div></div>";

    taskDisabledEl =
        '<div class="col-sm-2">' +
        '<div class="form-group"><div class="form-check-inline">' +
        '<input type="hidden" name="tasks[' +
        taskNumber +
        '][disabled]" value="0" />' +
        '<input type="checkbox" class="form-check-input" id="disabled" name="tasks[' +
        taskNumber +
        '][disabled]" value="1">' +
        '<label class="form-check-label" for="disabled">Disabled</label>' +
        "</div>" +
        "</div></div>";

    let taskFields = taskDescriptionEl + taskDeadlineEl + taskDisabledEl;

    $("#tasks").append(taskFields);
}
