<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <style>
        img {
            width: 100%;
            height: auto;
            margin-bottom: 2em;
        }
    </style>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script>
        // Global data for the list of files.
        var gaFiles = null;

        // Handle the click on an image.
        function handle_click() {
            console.log('handle_click');
            var src = $(this).attr('src');
            $('#image-modal-img').attr('src', src);
            $('#modal-header-p').text(src);
            $('#image-modal').modal();
        }

        // Display the files returned from the get_images.php server.
        function display_files(imageObject) {
            console.log('display_files');
            gaFiles = imageObject.files;

            for (var i = 0; i < gaFiles.length; i++) {
                var file = gaFiles[i];

                var imgElem = $('<img>').attr('src', file);
                imgElem.click(handle_click);
                var contElem = $('<div>').addClass('col-xs-3');
                contElem.append(imgElem);
                $('#image-div').append(contElem);
            }
        }

        // Load files from the get_images.php server.
        function load_files() {
            $.ajax({
                dataType: 'json',
                url: 'get_images.php',
                success: function(result) {
                    console.log('AJAX call succeeded:', result);
                    display_files(result);
                },
                error: function(result) {
                    console.log('AJAX call failed: ' + result);
                }
            });
        }

        $(document).ready(function(){
            console.log('Document: ready');
            load_files();
        });
    </script>
</head>
<body>
<main>
    <h3>Images:</h3>
    <div class="col-xs-12" id="image-div">

    </div>
    <div id="image-modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="modal-header-p"></h3>
                </div>
                <div class="modal-body">
                    <img src="" id="image-modal-img">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
</main>
</body>
</html>