var app = angular.module('sgtApp', []);
console.log('app: ' + app);

app.provider('sgtData', function(){
    console.log('app.provider');

    //Create a variable to hold this
    var provider = this;

    //Create a variable to hold your api key but set it to an empty string
    this.apiKey = '';

    //Create a variable to hold the API url but set it to an empty string
    this.apiUrl = '';

    //Add the necessary services to the function parameter list
    this.$get = function($http, $q, $log){
        //return an object that contains a function to call the API and get the student data
        //Refer to the prototype instructions for more help
        return {
            call_api: function() {
                console.log('call_api: ' + provider.apiUrl + ', ' + provider.apiKey);
                var data = 'api_key=' + provider.apiKey;
                var defer = $q.defer();

                $http({
                    url:        provider.apiUrl,
                    method:     'post',
                    data:       data,
                    headers:    {'Content-Type': 'application/x-www-form-urlencoded'}
                }).success(function(response) {
                    $log.log('call_api: success');
                    defer.resolve(response);
                }).error(function() {
                    $log.log('call_api: failure');
                    defer.reject('HTTP request failed.');
                });

                return defer.promise;
            }
        };
    };
});

//Config your provider here to set the api_key and the api_url
app.config(function(sgtDataProvider) {
    console.log('app.config');
    sgtDataProvider.apiKey = '0vLZS4ajsP';
    sgtDataProvider.apiUrl = 'http://s-apis.learningfuze.com/sgt/get';
});

//Include your service in the function parameter list along with any other services you may want to use;
app.controller('ioController', function($log, sgtData){
    console.log('app.controller');

    //Create a variable to hold this, DO NOT use the same name you used in your provider
    var controller = this;

    //Add an empty data object to your controller, make sure to call it 'data'
    var data = {};

    //Add a function called getData to your controller to call the SGT API
    //Refer to the prototype instructions for more help
    this.getData = function() {
        console.log('getData');
        sgtData.call_api().then(
            function(data) {
                console.log('call_api succeeded');
                controller.data = data;
            },
            function(data) {
                console.log('call_api failed: ' + data);
            });

    }
});