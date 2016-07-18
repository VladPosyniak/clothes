main.factory('getTags',['$http',function($http){
    return function(){
	    return $http.post("api/getTags")
	        .then(function (response) {
	            var json=response.data;
	            return json;
	        });
		}
	}
]);
