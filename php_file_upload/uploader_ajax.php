<!doctype html>
<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script>
        // Handle submit button.
        function onSubmitButton() {
            console.log('onSubmitButton');
            var formElement = $('#file-upload-form')[0];

            $.ajax({
                method: 'post',
                dataType: 'json',
                url: 'file_handler.php',
                data: new FormData(formElement),
                processData: false,
                contentType: false,
                success: function(result) {
                    debugger;
                    if (result.success) {
                        console.log('AJAX Success function called: success');

                    } else {
                        console.log('AJAX Success function called: errors:');
                        for (var i = 0; i < result.errors.length; i++) {
                            console.log(i + ': ' + result.errors[i]);
                        }
                    }
                },
                error: function(result) {
                    console.log('AJAX error function called: ' + result)
                }

            });

        }

        // Document ready - set up button handlers.
        $(document).ready(function () {
            console.log('Document: ready');
            $('#submit-button').click(onSubmitButton);
        });
    </script>
</head>
<body>
	<form id="file-upload-form" action="file_handler.php" method="post" enctype="multipart/form-data">
		<label for="upload_file">File to Upload:</label>
		<input type="file" name="upload_file" id="upload_file">
		<br><br>
		<label for="description">Description:</label>
		<input type="text" name="description" id="description">
		<br><br>
		<button type="button" id="submit-button">Submit</button>
	</form>
</body>
</html>