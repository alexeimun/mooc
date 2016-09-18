///<reference path="../../../../../typings/main/ambient/angular/index.d.ts"/>
var Camilion;
(function (Camilion) {
    var CommonService = (function () {
        function CommonService($http, $q) {
            this.$http = $http;
            this.$q = $q;
        }
        CommonService.prototype.getLayouts = function () {
            var def = this.$q.defer();
            this.$http.get('ccg/resolvelayouts').then(function (response) {
                def.resolve(response.data);
            }).catch(function (reason) {
                def.reject(reason);
            });
            return def.promise;
        };
        CommonService.$inject = ["$http", "$q"];
        return CommonService;
    }());
    Camilion.CommonService = CommonService;
})(Camilion || (Camilion = {}));
//# sourceMappingURL=CommonService.js.map