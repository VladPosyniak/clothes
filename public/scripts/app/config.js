postsApp.config(['$locationProvider',
    function($locationProvider) {
        $locationProvider.html5Mode(true);
    }]);

authApp.config(function($authProvider) {
	$authProvider.loginUrl = '/api/authenticate';
    });

