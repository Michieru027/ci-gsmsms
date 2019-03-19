<div ng-app="smsChart">
    <div ng-view></div>
    <script>
        function MainCtrl($scope, $http){
            var data = {'xData': <?php echo json_encode($json_chart_data['yData']) ?>,
                'yData':[{
                    'name': 'Total Received',
                    'data': <?php echo json_encode($json_chart_data['xData']) ?>
                }]
            }

            $scope.lineChartYData = data.yData
            $scope.lineChartXData = data.xData
        }

        angular.module('smsChart',['angChart'], function( $routeProvider, $locationProvider ){
            $routeProvider.when('/',{
                template: '<chart title="SMS Data Receive Chart" xData="lineChartXData" yData="lineChartYData" xName="Month" yName="Hit"></chart>',
                controller: MainCtrl
            })
        })
    </script>
</div>