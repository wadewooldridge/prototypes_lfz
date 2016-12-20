/* Feature Set 1 - No return value. */
function myMessage() {
    console.log("Feature Set 1 console message.");
}

function add(num1, num2) {
    console.log(num1, "+", num2, "=", num1+num2);
}

/* Feature Set 2 - Return values. */
function add2(num1, num2) {
    return num1 + num2;
}

var add2Result = add2(321, 654);

/* Feature Set 3 - Handling events on elements. */
function flipCard(element) {
    $(element).hide();
}