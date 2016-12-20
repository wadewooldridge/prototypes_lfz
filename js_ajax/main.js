//Create GLOBAL variable below here on line 2
var gSavedResult = null;
var gaMovies = null;
var gThirdImage = null;
var gThirdImageURL = null;

$(document).ready(function(){
    $('button').click(function(){
        console.log('click initiated');
        $.ajax({
            dataType: 'json',
            url: 'http://ax.itunes.apple.com/WebObjects/MZStoreServices.woa/ws/RSS/topMovies/json',
            success: function(result) {
                console.log('AJAX Success function called, with the following result:', result);
                gSavedResult = result;
                gaMovies = result.feed.entry;
                gThirdImage = gaMovies[0]['im:image'][2];
                gThirdImageURL = gThirdImage.label;
                console.log('gaThirdImageURL: ' + gThirdImageURL);

                addImagesToMain(result);
            }
        });
        console.log('End of click function');
    });
});

function addImagesToMain() {
    console.log('addImagesToMain');
    var movies = gaMovies;
    var mainElem = $('#main');
//    mainElem.css('display', 'inline-block');

    for (var i = 0; i < movies.length; i++) {
        var movie = movies[i];
        var imgURL = movie['im:image'][2].label;
        var title = movie['im:name'].label;

        console.log('movies[' + i + ']: title: ' + title + ', imgURL: ' + imgURL);

        var figureElem = $('<figure>').css({display: 'inline-block', border: '2px solid darkgreen'});
        var imgElem = $('<img>').attr('src', imgURL);
        var titleElem = $('<figcaption>').text(title);
        figureElem.append(imgElem);
        figureElem.append(titleElem);
        mainElem.append(figureElem);
    }
}