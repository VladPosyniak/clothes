main.controller('winnerController',['$scope','getWinner','comments',winnerController]);


    function winnerController($scope,getWinner,comments) {
    	getWinner.then(function(data){
                $scope.comments=[];
                data=data[0];
                if(data!=undefined){
        
                    if(data.tag){
                        data.taglist = data.tag.split(',');
                    }
                
                    var reg = /(,).*/;

                    if(reg.test(data.images)){
                        data.imagesArr=data.images.split(',');
                    }
                    else{
                        data.imagesArr=[data.images];
                    }

                    $scope.post=data;
                    comments($scope.post.id).success(function(data){
                    $scope.comments.push(data[0]);
                    });
                }
                
            });
        /*
            
        */
    }

