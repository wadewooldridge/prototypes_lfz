<!doctype html>
<html>
<head>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
    // onSubmit: handle the click and make the AJAX call.
    function onSubmit() {
        console.log('onSubmit');
        var title = $('#title').val();
        var details = $('#details').val();
        var timestamp = $('#timestamp').val();
        var user_id = $('#user_id').val();
        console.log('onSubmit: ' + title + ', ' + details + ', ' + timestamp + ', ' + user_id);

        $.ajax({
            data: {
                title: title,
                details: details,
                timestamp: timestamp,
                user_id: user_id,
                return_json: true   // Special flag to return JSON instead of just displaying result.
            },
            url: 'index_insert.php',
            method: 'post',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $('#return-status').text('AJAX success, and back-end success');
                    $('#return-data').text('Affected rows: ' + response.affected_rows);
                } else {
                    $('#return-status').text('AJAX Success, but back-end failure');
                    $('#return-data').text(response.message);
                }
            },
            error: function(response) {
                var message = 'AJAX failure: ' + response;
                console.log(message);
                $('#return-status').text('AJAX Failure');
                $('#return-data').html(message);
            }
        });

    }

    // Document ready: set up the click handler.
    $(document).ready(function() {
        console.log('Document ready');
        $('#submit-button').click(onSubmit);
    });
</script>
</head>
<body>
<form>
    <hr>
    <label for="title">Title:</label>
    <br>
    <input type="text" name="title" id="title">
    <br>
    <label for="details">Details:</label>
    <br>
    <textarea name="details" id="details"></textarea>
    <br>
    <label for="timestamp">Timestamp:</label>
    <br>
    <input type="text" name="timestamp" id="timestamp">
    <br>
    <label for="user_id">User ID:</label>
    <br>
    <input type="number" name="user_id" id="user_id">
    <br>
    <hr>
</form>
<button class="btn btn-primary" id="submit-button">Submit</button>
<hr>
<div>
    <h3 id="return-status"></h3>
    <div id="return-data"></div>
</div>

<?php

?>

</body>
</html>
