<!doctype html>
<html>
<head>
</head>
<body>
	<form id="file_upload" action="file_handler.php" method="post" enctype="multipart/form-data">
        <label for="upload_file">File to Upload:</label>
		<input type="file" name="upload_file" id="upload_file">
        <br><br>
        <label for="description">Description:</label>
        <input type="text" name="description" id="description">
        <br><br>
        <button type="submit">Submit</button>
	</form>
</body>
</html>