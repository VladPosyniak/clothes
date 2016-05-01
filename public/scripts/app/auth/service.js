authApp.factory('unlink',['$http',function($http) {
    return function (name,token) {
        return $http.post("api/authenticate/unlink",{name:name,token:token})
            .success(function (response) {
            	return response;
            });
    }
}
]);