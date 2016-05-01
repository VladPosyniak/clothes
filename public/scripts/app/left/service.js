authApp.factory('leftToken',function($rootScope){
	var token={};

	token.token='';

	token.selectid=function(token){
		this.token=token;
		this.broadcast();
	}

	token.broadcast = function() {
        $rootScope.$broadcast('leftTokenBroadcast');

    };

	return token;

   
}
);