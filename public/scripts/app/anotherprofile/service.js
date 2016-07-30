profileApp.factory('getUser',['$http',function($http) {
    return function (token,id) {
        return $http.post("api/getUser/profile",{token:token,id:id})
            .success(function (response) {
            	var json=response.data;
                return json;
            });
    }
}
]);

profileApp.factory('getPhotos',['$http',function($http) {
    pack=0;
    return function (token,id,pack) {
        return $http.post("api/getUser/getPhotos",{token:token,id:id,pack:pack})
            .success(function (response) {
                var json=response.data;
                pack+=1;
                return json;
            });
    }
}
]);



postsApp.factory('useridbroadcast',function($rootScope){
	var useridbroadcast={};

	useridbroadcast.id=null;

	useridbroadcast.selectid=function(id){
		this.id=id;
		this.broadcast();
	}

	useridbroadcast.broadcast = function() {
        $rootScope.$broadcast('useridbroadcast');

    };

	return useridbroadcast;

   
}
);