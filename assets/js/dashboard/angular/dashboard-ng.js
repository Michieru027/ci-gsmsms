/**
 * Created by EC_Jerome on 18/12/2018.
 */
var dashboardApp  =   angular.module('dashboardAppController', ['ngSanitize']);
dashboardApp.controller('dashboardAppController', function($scope, $http, $interval){
    $scope.loader           =   true;
    $scope.content,
        $scope.notif      =   false;
    var promise;

    getSmsData  =   function(){
        $http({
            method: 'GET',
            url: base_url()+'dashboard/process_api_sms',
            dataType: 'json',
            headers:{
                "Content-Type": "application/json"
            }
        }).then(function(response){
            if(response.data.status == 'success'){
                $scope.notif_class      =   'alert-success';
                $scope.notif_badge      =   'badge-success';
                if(response.data.total_data > 0){
                    $scope.notif_header     =   'Success';
                    $scope.notif_content    =   'A total of '+response.data.total_data+' SMS from API has been successfully saved in database.';
                }else{
                    $scope.notif_header     =   'Info';
                    $scope.notif_content    =   'There are no new SMS data from API to be saved.';
                }
                $scope.new_sms          =   response.data.total_data;
                $scope.total_sms        =   response.data.total_sms;
                $scope.opened_sms       =   response.data.sms_read;
                $scope.unread_sms       =   response.data.sms_unread;
                $scope.notif            =   true;
            }else{
                $scope.notif_class      =   'alert-danger';
                $scope.notif_badge      =   'badge-danger';
                $scope.notif_header     =   'Error';
                $scope.notif_content    =   response.data.msg;
                $scope.notif            =   true;
                $interval.cancel(promise);
            }
            $scope.loader   =   false;
            $scope.content  =   true;
        })
    }

    promise     =   $interval(getSmsData, 4000);
})

