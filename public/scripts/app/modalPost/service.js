postsApp.factory('singlePost',['$http',function($http) {
    return function (id) {
        return $http.post("api/getPost",{PostId:id})
            .success(function (response) {
            	var json=response.data;
                return json;
            });
    }
}
]);


postsApp.factory('comments',['$http',function($http) {
    return function (id) {
        return $http.post("api/comments/getComments",{id:id})
            .success(function (response) {
            	var json=response.data;
                return json;
            });
    }
}
]);


postsApp.factory('create_comment',['$http',function($http) {
    return function (id,content,token) {
        return $http.post("api/comments/createComment",{id:id,content:content,token:token})
            .success(function (response) {
                var json=response.data;
                return json;
            });
    }
}
]);

postsApp.factory('delete_comment',['$http',function($http) {
    return function (id,token) {
        return $http.post("api/comments/deleteComment",{id:id,token:token})
            .success(function (response) {
                var json=response.data;
                return json;
            });
    }
}
]);


