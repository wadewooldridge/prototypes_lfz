// Answer the questions here:

// - What do you think is going to happen?
//      I thought I would get a click message for each button.
// - What happened?
//      I did, once I put all of this in a document.ready function.
// - Why?
//      The event handler is associated with the list and not any specific button.

//========== Write your code below ===========//
$('document').ready(function() {
    /* Feature Set 1 - The lonely event listener. */
    var theList = $('#list');
    theList.on('click', 'button', function() {
        console.log('Click:', $(this).text());
    });

    /* Feature Set 2 - Bring a fried. */
    var newLi = $('<li>');
    var newButton = $('<button>').text('Delegated Button #5').css({'margin': '10px'});
    newLi.append(newButton);
    theList.append(newLi);

    /* Feature Set 3 - Now it's a party. */
    newLi = $('<li>');
    newButton = $('<button>').text('Delegated Button #6').css({'margin': '10px'});
    newLi.append(newButton);
    theList.append(newLi);

    /* Additional challenge - Open a tab and navigate to Google. */
    newLi = $('<li>');
    newButton = $('<button>').text('Google')
        .css({'margin-top': '10px', 'margin-left': '10px'})
        .attr('googler','true');
    newLi.append(newButton);
    theList.append(newLi);

    theList.on('click', '[googler="true"]', function() {
        console.log('Googler!');
        window.open('http://www.google.com', '_blank');
    });
});
