authApp.factory('unlink',['$http',function($http) {
    return function (name,token) {
        return $http.post("authenticate/unlink",{name:name,token:token})
            .success(function (response) {
            	return response;
            });
    }
}
]);