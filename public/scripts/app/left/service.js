authApp.factory('auth_update',function($rootScope){
	var token={};

	token.token='';
	token.id='';

	token.selectid=function(token,id){
		this.token=token;
		this.id=id;

        $rootScope.id=data.id;
        $rootScope.token=data.token;

		console.log(id,token);
		this.broadcast();
	}

	token.broadcast = function() {
        $rootScope.$broadcast('auth_updateBroadcast');

    };

	return token;

   
}
);