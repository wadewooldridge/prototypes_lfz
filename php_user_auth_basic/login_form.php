<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHP User Authentication Prototype</title>

    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script>
        // gLoginStatus - global object to keep track of current login status.
        var gLoginStatus = {
            loggedIn: false,
            username: null,
            name: null,
            userLevel: null
        };

        // clearLoginStatus - Clear out the global gLoginStatus
        function clearLoginStatus() {
            gLoginStatus.loggedIn = false;
            gLoginStatus.username = null;
            gLoginStatus.name = null;
            gLoginStatus.userLevel = null;
        }

        // displayCheckStatusResults - log to #status-results and console.log().
        function displayCheckStatusResults(text) {
            console.log('displayCheckStatusResults: ' + text);
            $('#status-results').text(text);
        }

        // checkStatusAjaxFailed - handle failure.
        function checkStatusAjaxFailed(response) {
            displayCheckStatusResults('Check status AJAX failed: ' + response.message);
        }

        // loginAjaxSucceeded - AJAX succeeded; check returned data.
        function checkStatusAjaxSucceeded(response) {
            // AJAX worked, but check success status from the server.
            if (response.success) {
                displayCheckStatusResults('Check status AJAX succeeded: server success, username = ' +
                    response.username + ', name = ' + response.name + ', userLevel = ' + response.userLevel);
            }
            else {
                displayCheckStatusResults('Check status AJAX succeeded: server failure: ' + response.message);
            }
        }

        // doCheckStatus - start the AJAX request.
        function doCheckStatus(username) {
            console.log('doCheckStatus: ' + username);
            $.ajax({
                url: 'login_handler.php',
                method: 'post',
                dataType: 'json',
                cache: false,
                data: {
                    username: username
                },
                success: checkStatusAjaxSucceeded,
                failure: checkStatusAjaxFailed
            });
        }

        // displayLoginResults - log to #login-results and console.log().
        function displayLoginResults(text) {
            console.log('displayLoginResults: ' + text);
            $('#login-results').text(text);
        }

        // loginAjaxFailed - handle failure.
        function loginAjaxFailed(response) {
            displayLoginResults('Login AJAX failed: ' + response.message);
            clearLoginStatus();
        }

        // loginAjaxSucceeded - AJAX succeeded; check returned data.
        function loginAjaxSucceeded(response) {
            // AJAX worked, but check success status from the server.
            if (response.success) {
                displayLoginResults('Login AJAX succeeded: server success, userId = ' + response.userId +
                    ', username = ' + response.username + ', name = ' + response.name + ', userLevel ' + response.userLevel);
                gLoginStatus.loggedIn = true;
                gLoginStatus.username = response.username;
                gLoginStatus.name = response.name;
                gLoginStatus.userLevel = response.userLevel;
            }
            else {
                displayLoginResults('Login AJAX succeeded: server failure: ' + response.message);
                clearLoginStatus();
            }
        }

        // doLogin - start the AJAX request.
        function doLogin(username, password) {
            console.log('doLogin: ' + username + ' / ' + password);
            $.ajax({
                url: 'login_handler.php',
                method: 'post',
                dataType: 'json',
                cache: false,
                data: {
                    username: username,
                    password: password
                },
                success: loginAjaxSucceeded,
                failure: loginAjaxFailed
            });
        }

        // displayLogoutResults - log to #logout-results and console.log().
        function displayLogoutResults(text) {
            console.log('displayLogoutResults: ' + text);
            $('#logout-results').text(text);
        }

        // logoutAjaxFailed - handle failure.
        function logoutAjaxFailed(response) {
            displayLogoutResults('Logout AJAX failed: ' + response.message);
            clearLoginStatus();
        }

        // logoutAjaxSucceeded - AJAX succeeded; check returned data.
        function logoutAjaxSucceeded(response) {
            // AJAX worked, but check success status from the server.
            if (response.success) {
                displayLogoutResults('Logout AJAX succeeded: server success: ' + response.message);
            }
            else {
                displayLogoutResults('Logout AJAX succeeded: server failure: ' + response.message);
            }
            clearLoginStatus();
        }

        // doLogout - start the AJAX request.
        function doLogout(username, password) {
            console.log('doLogout: ' + username + ' / ' + password);
            $.ajax({
                url: 'login_handler.php',
                method: 'post',
                dataType: 'json',
                cache: false,
                data: {},
                success: logoutAjaxSucceeded,
                failure: logoutAjaxFailed
            });
        }

        // onLogInButton - click handler.
        function onLogInButton(event) {
            console.log('onLogInButton');
            var username = $('#username').val();
            var password = $('#password').val();
            if (!username || !password) {
                displayLoginResults('Please specify a username and password.');
            } else {
                displayLoginResults('Starting login.');
                doLogin(username, password);
            }
        }

        // onCheckStatusButton - click handler.
        function onCheckStatusButton(event) {
            console.log('onCheckStatusButton');
            var username = $('#username').val();
            if (!username) {
                displayCheckStatusResults('Please specify a username.');
            } else {
                displayCheckStatusResults('Starting status check.');
                doCheckStatus(username);
            }
        }

        function onLogOutButton(event) {
            console.log('onLogOutButton');
            displayLogoutResults('Starting logout.');
            doLogout();
        }

        // Document ready - set up the click handlers.
        $(document).ready(function () {
            console.log('Document ready');
            $('#log-in-button').click(onLogInButton);
            $('#check-status-button').click(onCheckStatusButton);
            $('#log-out-button').click(onLogOutButton);
        });
    </script>
</head>
<body class="col-xs-12">
<h3>Please log in:</h3>
<form>
    <label for="username">Username:</label>
    <br>
    <input type="text" id="username" name="username">
    <br>
    <label for="password">Password:</label>
    <br>
    <input type="text" id="password" name="password">
    <br>
    <br>
</form>
<button class="btn btn-primary" id="log-in-button">Log In</button>
<hr>
<h4>Login Results:</h4>
<div id="login-results">

</div>
<hr>
<h3>Check Login Status:</h3>
<button class="btn btn-warning" id="check-status-button">Check Status</button>
<hr>
<h4>Status Results:</h4>
<div id="status-results">

</div>
<hr>
<h3>Log out when you are finished:</h3>
<button class="btn btn-danger" id="log-out-button">Log Out</button>
<hr>
<h4>Logout Results:</h4>
<div id="logout-results">

</div>
</body>
</html>

