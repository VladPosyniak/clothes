main.directive('switcher',function($compile){
        return {
            resrtict: "E",
            scope: {
            },
            templateUrl: 'scripts/app/switcher/template.html',
            //controller:'switcher',
            link: function($scope){
                $(document).ready(function() {
                    $("ul.switcher li").click(function () {
                        creat($(this).attr('id'),$scope,$compile);
                    });
                },false);
            }
        }
    }
);


function creat(object,$scope,$compile){

    var other=$('#sub_activity');
    var activ= $('#main_activity');

    if(object==="activity"){
        other.attr('hidden','hidden');
        activ.removeAttr('hidden');

    }else {
        var element = $(document.getElementsByTagName(object));
        activ.attr('hidden','hidden');
        other.removeAttr('hidden');

        for(var i=0;i<3;i++){
            if(other.children(i)){
                other.children(i).attr('hidden','hidden');
            }
        }

        if (document.getElementsByTagName(object)[0] == undefined) {
            other.append($compile("<" + object + "></" + object + ">")($scope));
        }
        else {
            element.removeAttr('hidden');
        }
    }
}