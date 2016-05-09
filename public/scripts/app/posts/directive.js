postsApp.directive('posts',function(){
    return {
        resrtict: "E",
        scope: {
        	poststype:"@poststype"
        },
        templateUrl: 'scripts/app/posts/template.html',
        controller:'postsController',
    }
}
);