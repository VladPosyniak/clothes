postsApp.factory('getPosts',['$http',function($http){
    return $http.get("api/getPosts")
        .then(function (response) {
            var json=response.data;
            return json;
        });
}
]);


postsApp.factory('postid',function($rootScope){
	var postid={};

	postid.id=0;

	postid.selectid=function(id){
		this.id=id;
		this.broadcast();
	}

	postid.broadcast = function() {
        $rootScope.$broadcast('postidBroadcast');

    };

	return postid;

   
}
);



postsApp.factory('getUserById',['$http',function($http){
	return function (id) {
	    return $http.post("api/getUser/id",{id:id})
	        .then(function (response) {
	            var json=response.data;
	            return json;
	        });
	}
}
]);



postsApp.factory('like',['$http',function($http){
	return function (id,token) {
	    return $http.post("api/like",{idpost:id,token:token})
	        .then(function (response) {
	            var json=response.data;
	            return json;
	        });
	}
}
]);

postsApp.factory('dislike',['$http',function($http){
	return function (id,token) {
	    return $http.post("api/dislike",{idpost:id,token:token})
	        .then(function (response) {
	            var json=response.data;
	            return json;
	        });
	}
}
]);


