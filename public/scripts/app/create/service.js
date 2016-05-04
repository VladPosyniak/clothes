postsApp.factory('create',['$http',function($http) {
    return function (title,content,token) {
        return $http.post("api/createPost",{title:name,content:content,token:token})
            .success(function (response) {
            	return response;
            });
    }
}
]);