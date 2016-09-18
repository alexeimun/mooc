///<reference path="../../../../../typings/main/ambient/angular/index.d.ts"/>

module Camilion {

    export class CommonService {

        static $inject = ["$http", "$q"];

        constructor(private $http: ng.IHttpService, private $q: ng.IQService)
        {
        }

        getLayouts(): ng.IPromise<string[]>
        {
            var def = this.$q.defer();

            this.$http.get('ccg/resolvelayouts').then(response =>
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