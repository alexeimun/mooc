///<reference path="../../../../typings/main/ambient/angular/index.d.ts"/>
///<reference path="../../../../typings/main/ambient/angular-route/index.d.ts"/>
///<reference path="controllers/main.ts"/>
///<reference path="controllers/navigation.ts"/>
///<reference path="services/CommonService.ts"/>
///<reference path="services/TableService.ts"/>
///<reference path="services/NavService.ts"/>
///<reference path="directives/Typeahead.ts"/>
///<reference path="filters/iconFilter.ts"/>
var Camilion;
(function (Camilion) {
    var app = (function () {
        function app() {
        }
        app.create = function () {
            return angular.module('camilionApp', 
            //Injection dependencies
            ['ngRoute', 'ui.tree']).
                //Routes
                config(["$routeProvider", function (routeProvider) {
                    routeProvider.when('/', {
                        templateUrl: 'public/camilion/app/partials/main.html',
                        controller: 'MainController',
                        controllerAs: 'vm'
                    }).when('/navigation', {
                        templateUrl: 'public/camilion/app/partials/nav.html',
                        controller: 'NavController'
                    }).otherwise({
                        redirectTo: '/'
                    });
                }]).run(function ($http) {
                $http.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';
            }).
                //Services
                service('CommonService', Camilion.CommonService).
                service('TableService', Camilion.TableService).
                service('NavService', Camilion.NavService)
                .directive('typeahead', Camilion.Typeahead)
                .filter('iconFilter', Camilion.IconFilter)
                .controller('MainController', Camilion.MainController).
                controller('NavController', Camilion.NavController);
        };
        return app;
    }());
    Camilion.app = app;
    function init() {
        Camilion.Gcc = app.create();
    }
    Camilion.init = init;
})(Camilion || (Camilion = {}));
Camilion.init();
//# sourceMappingURL=app.js.map