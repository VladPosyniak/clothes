postsApp.factory('singlePost',['$http',function($http) {
    return function (id) {
        return $http.post("getPost",{PostId:id})
            .success(function (response) {
            	var json=response.data;
                return json;
            });
    }
}
]);