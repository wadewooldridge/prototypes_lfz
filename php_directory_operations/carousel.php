<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <style>
        h3 {
            margin-left: 300px;
        }

        h3 img {
            width: 25px;
            height: 25px;
        }

        #image-div {
            position: relative;
            width: 800px;
            height: 600px;
            max-width: 800px;
            max-height: 600px;
            overflow: hidden;
        }

        #image-div img {
            width: 100%;
            height: auto;
            position: absolute;
            left: -100%;
            transition: left 1.0s;
        }

        #image-div img.shown {
            left: 0;
        }

        #image-div img.off-right {
            left: 100%;
        }

        .dot {
            display: inline-block;
            width: 25px;
            height: 25px;
            margin-right: 10px;
            border: 2px solid darkgreen;
            border-radius: 100%;
        }

        .dot.selected {
            background-color: green;
        }

    </style>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script>
        // Global data for the list of files.
        var gaFiles = [];
        var gaDotElements = [];
        var gaImgElements = [];
        var gCurrentFileIndex = 0;

        // Next image.
        function next_image() {
            console.log('next_image: ' + gCurrentFileIndex);

            if (gCurrentFileIndex < (gaFiles.length - 1)) {
                gaDotElements[gCurrentFileIndex].removeClass('selected');
                gaImgElements[gCurrentFileIndex].addClass('off-right');
                gCurrentFileIndex++;
            }
            gaDotElements[gCurrentFileIndex].addClass('selected');
            gaImgElements[gCurrentFileIndex].addClass('shown');
        }

        // Previous image.
        function prev_image() {
            console.log('prev_image: ' + gCurrentFileIndex);
            if (gCurrentFileIndex > 0) {
                gaDotElements[gCurrentFileIndex].removeClass('selected');
                gaImgElements[gCurrentFileIndex].removeClass('shown');
                gCurrentFileIndex--;
            }
            gaDotElements[gCurrentFileIndex].addClass('selected');
            gaImgElements[gCurrentFileIndex].removeClass('off-right');
        }

        // Dot clicked - scroll through to that picture.
        function dot_clicked() {
            var newIndex = parseInt(this.value);
            console.log('dot_clicked: ' + newIndex);
            while (gCurrentFileIndex < newIndex) {
                next_image();
            }
            while (gCurrentFileIndex > newIndex) {
                prev_image();
            }
        }

        // Display the files returned from the get_images.php server.
        function display_files(imageObject) {
            console.log('display_files');
            gaFiles = imageObject.files;

            for (var i = 0; i < gaFiles.length; i++) {
                var file = gaFiles[i];

                // Add the image element to the image-div.
                gaImgElements[i] = $('<img>').attr('src', file);
                if (i == 0) {
                    gaImgElements[i].addClass('shown');
                }
                $('#image-div').append(gaImgElements[i]);

                // Add the dot element to the dot-div.
                gaDotElements[i] = $('<div>').addClass('dot').val(i).click(dot_clicked);
                if (i == 0) {
                    gaDotElements[i].addClass('selected');
                }
                $('#dot-div').append(gaDotElements[i]);
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
            $('#prev-button').click(prev_image);
            $('#next-button').click(next_image);
            load_files();
        });
    </script>
</head>
<body>
<main>
    <h3><button id="prev-button"><img src="http://www.wpclipart.com/signs_symbol/arrows/round/button_arrow_green_left.png"></button>
        Images
        <button id="next-button"><img src="http://www.wpclipart.com/signs_symbol/arrows/round/button_arrow_green_right.png"></button>
    </h3>
    <div id="image-div">

    </div>
    <div id="dot-div">

    </div>
</main>
</body>
</html>