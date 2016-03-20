postsApp.directive('posts',function(){
    return {
        resrtict: "E",
        scope: {
        },
        templateUrl: 'scripts/app/posts/template.html',
        controller:'postsController',
    }
}
);