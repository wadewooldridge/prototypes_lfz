/**
 *  Angular Services Test App.
 *  by Wade Wooldridge
 */

var app = angular.module('GammaApp', []);
app.controller('GammaController', function($http, $log) {
    var self = this;
    this.searchText = '';
    this.searchStatus = null;
    this.searchResults = [];

    this.getUrl = function () {
        // Replace any spaces with plus signs for the URL.
        var temp = this.searchText.replace(/ /g, '+');
        var url = 'https://itunes.apple.com/search?term=' + temp + '&callback=JSON_CALLBACK';
        $log.log('getUrl: "' + url + '"');
        return url;
    };

    this.startSearch = function() {
        $log.log('startSearch: "' + this.searchText + '"');
        self.searchResults = [];

        $http({
            url: self.getUrl(),
            method: 'jsonp'
        }).then(
            function(response) {
                $log.log('startSearch: success');
                self.searchStatus = 'Search successful: ' + response.data.resultCount + ' items returned';
                self.searchResults = response.data.results;
            },
            function(response) {
                $log.log('startSearch: failure');
                self.searchStatus = 'Search failed: ' + response.statusText;
            }
        );
    };

});
