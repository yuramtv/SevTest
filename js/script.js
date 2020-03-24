(function(){

    var app = angular.module('MyApp',[]);

    app.controller('TestController', function($scope, $http){

        $scope.myrequest = function() {
            $http({
                method: 'GET',
                url: '../req/myreq.php?key=1'
            }).then(function successCallback(response) {

                if(response == "") {
                    $scope.ip = "Ошибка: пустой AJAX - ответ";
                    $scope.myclass = 'alert alert-danger';
                }
                switch (response.data.result){
                    default:
                        $scope.ip = "ошибка";
                        $scope.myclass = 'alert alert-danger';
                        break;
                    case true:
                        $scope.ip = response.data.ip;
                        $scope.myclass = 'alert alert-success';
                        break;
                    case false:
                        $scope.ip = response.data.error;
                        $scope.myclass = 'alert alert-danger';
                        break;
                }
            }, function errorCallback(response) {
                $scope.ip = response.data;
                $scope.myclass = 'alert alert-danger';

            });
        };
        $scope.bannerClose = function() {
            $scope.ip = null;
            $scope.error = null;

        };
    });
})();
