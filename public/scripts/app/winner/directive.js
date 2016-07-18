main.directive('winner',function(){
    return {
        resrtict: "E",
        scope: {
        },
        templateUrl: 'scripts/app/winner/template.html',
        controller:'winnerController'
    }
}
);