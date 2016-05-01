profileApp.factory('getSelf',['$http',function($http) {
    return function (token) {
        return $http.post("api/getUser/getself",{token:token})
            .success(function (response) {
            	var json=response.data;
                return json;
            });
    }
}
]);

profileApp.factory('getUserById',['$http',function($http){
	return function (id) {
	    return $http.post("api/getUser/id",{id:id})
	        .then(function (response) {
	            var json=response.data;
	            return json;
	        });
	}
}
]);