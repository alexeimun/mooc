///<reference path="../app.ts"/>
var Camilion;
(function (Camilion) {
    var NavService = (function () {
        function NavService($http, $q, cmnService) {
            this.$http = $http;
            this.$q = $q;
            this.cmnService = cmnService;
        }
        NavService.prototype.getNavItems = function (data) {
            var def = this.$q.defer();
            this.$http.post('ccg/getnavitems', $.param(data)).then(function (response) {
                def.resolve(response.data);
            }).catch(function (reason) {
                def.reject(reason);
            });
            return def.promise;
        };
        NavService.prototype.getIcons = function () {
            var def = this.$q.defer();
            this.$http.get('public/camilion/app/assets/fontawesome.json').then(function (response) {
                def.resolve(response.data);
            }).catch(function (reason) {
                def.reject(reason);
            });
            return def.promise;
        };
        NavService.prototype.sendForm = function (data) {
            var def = this.$q.defer();
            this.$http.post('ccg/constructnav', $.param(data)).then(function (response) {
                def.resolve(response.data);
            }).catch(function (reason) {
                def.reject(reason);
            });
            return def.promise;
        };
        NavService.$inject = ["$http", "$q", "CommonService"];
        return NavService;
    }());
    Camilion.NavService = NavService;
})(Camilion || (Camilion = {}));
//# sourceMappingURL=NavService.js.map