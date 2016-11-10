var app = angular.module('sgtApp', []);

app.provider('sgtData', function(){
    //Create a variable to hold this

    //Create a variable to hold your api key but set it to an empty string

    //Create a variable to hold the API url but set it to an empty string


    //Add the necessary services to the function parameter list
    this.$get = function(){
        //return an object that contains a function to call the API and get the student data
        //Refer to the prototype instructions for more help

    };
});

//Config your provider here to set the api_key and the api_url


//Include your service in the function parameter list along with any other services you may want to use
app.controller('ioController', function(){
    //Create a variable to hold this, DO NOT use the same name you used in your provider

    //Add an empty data object to your controller, make sure to call it 'data'


    //Add a function called getData to your controller to call the SGT API
    //Refer to the prototype instructions for more help

});