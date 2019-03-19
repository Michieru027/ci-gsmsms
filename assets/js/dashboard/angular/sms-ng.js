angular.module('angChart', ['ngRoute']).directive('chart', function () {
    return {
        restrict:'E',
        template:'<div></div>',
        transclude:true,
        replace:true,
        scope: '=',
        link:function (scope, element, attrs) {
            console.log('oo',attrs,scope[attrs.formatter])
            var opt = {
                chart:{
                    renderTo:element[0],
                    type:'line',
                    marginRight:130,
                    marginBottom:80
                },
                title:{
                    text:attrs.title,
                    x:-20 //center
                },
                subtitle:{
                    text:attrs.subtitle,
                    x:-20
                },
                yAxis:{
                    title:{
                        text:attrs.yname
                    },
                },
                legend:{
                    layout:'vertical',
                    align:'right',
                    verticalAlign:'top',
                    x:-10,
                    y:100,
                    borderWidth:0
                },
            }


            // Update when charts data changes
            scope.$watch(function (scope) {
                return JSON.stringify({
                    xAxis:{
                        categories:scope[attrs.xdata]
                    },
                    series:scope[attrs.ydata]
                });
            }, function (news) {
                console.log('ola')
//                if (!attrs) return;
                news = JSON.parse(news)
                if (!news.series)return;
                angular.extend(opt,news)
                console.log('opt.xAxis.title.text',opt)
                var chart = new Highcharts.Chart(opt);
            });
        }
    }
})