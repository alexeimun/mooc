///<reference path="../../../../typings/main/ambient/angular/index.d.ts"/>
///<reference path="../../../../typings/main/ambient/angular-route/index.d.ts"/>
///<reference path="controllers/main.ts"/>
///<reference path="controllers/navigation.ts"/>
///<reference path="services/CommonService.ts"/>
///<reference path="services/TableService.ts"/>
///<reference path="services/NavService.ts"/>
///<reference path="directives/Typeahead.ts"/>
///<reference path="filters/iconFilter.ts"/>

module Camilion {

    export var Gcc: ng.IModule;

    export class app {

        static create(): ng.IModule
        {
            return angular.module('camilionApp',
                //Injection dependencies
                ['ngRoute', 'ui.tree']).
                //Routes
                config(["$routeProvider", (routeProvider: angular.route.IRouteProvider) =>
                {
                    routeProvider.when('/', {
                        templateUrl : 'public/camilion/app/partials/main.html',
                        controller : 'MainController',
                        controllerAs : 'vm'
                    }).when('/navigation', {
                        templateUrl : 'public/camilion/app/partials/nav.html',
                        controller : 'NavController',
                    }).otherwise({
                        redirectTo : '/'
                    });
                }]).run(function ($http)
                {
                    $http.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';
                }).
                //Services
                service('CommonService', CommonService).
                service('TableService', TableService).
                service('NavService', NavService)
                //Directives
                .directive('typeahead', Typeahead)
                //Filters
                .filter('iconFilter', IconFilter)
                //Controllers
                .controller('MainController', MainController).
                controller('NavController', NavController)
        }
    }
    export function init()
    {
        Gcc = app.create();
    }
}
Camilion.init();
