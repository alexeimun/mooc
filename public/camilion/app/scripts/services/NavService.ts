///<reference path="../app.ts"/>

module Camilion {

    export class NavService {

        static $inject = ["$http", "$q","CommonService"];

        constructor(private $http: ng.IHttpService, private $q: ng.IQService,private cmnService:CommonService)
        {
        }

        getNavItems(data): ng.IPromise<string[]>
        {
            var def = this.$q.defer();

            this.$http.post('ccg/getnavitems',$.param(data)).then(response =>
            {
                def.resolve(response.data);
            }).catch(reason =>
            {
                def.reject(reason);
            });

            return def.promise;
        }

        getIcons(): ng.IPromise<string[]>
        {
            var def = this.$q.defer();

            this.$http.get('public/camilion/app/assets/fontawesome.json').then(response =>
            {
                def.resolve(response.data);
            }).catch(reason =>
            {
                def.reject(reason);
            });

            return def.promise;
        }

        sendForm(data: any): ng.IPromise<string>
        {
            var def = this.$q.defer();

            this.$http.post('ccg/constructnav', $.param(data)).then(response =>
            {
                def.resolve(response.data);
            }).catch(reason =>
            {
                def.reject(reason);
            });

            return def.promise;
        }
    }
}