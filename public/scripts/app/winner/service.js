main.factory('getWinner',['$http',function($http){
	return $http.post("api/getWinner")
	    .then(function (response) {
	        var json=response.data;
	        return json;
	    });
	}
]);
