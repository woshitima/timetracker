$('#timerbutton').on('click', function (event) {
    event.preventDefault();
    let state = $(this).val();
    if (state == "start") {
        $(this).prop('value', 'stop');
    } else {
        $(this).prop('value', 'start');
    }

    $.ajax(
        {
            type: "POST",
            url: "tracker/test",
            dataType: 'json',
            data:
                {
                    "state": state
                },
            success: function (data) {
                $("#timertable").empty();
                $.each(data, function (index, value) {
                    console.log("start time" + ": " + value['start_time']);
                    console.log("end time" + ": " + value['end_time']);
                    $("#timertable").append("<tr><td>" + value['start_time'] + " <> </td><td>" + value['end_time'] + "</td></tr>");
                });
            }
        });
});