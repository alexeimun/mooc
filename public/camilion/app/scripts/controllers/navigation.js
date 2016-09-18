///<reference path="../app.ts"/>
var Camilion;
(function (Camilion) {
    var NavController = (function () {
        function NavController($scope, navService, cmnService) {
            this.$scope = $scope;
            this.navService = navService;
            this.cmnService = cmnService;
            this.layouts = [];
            $scope.selected = '';
            cmnService.getLayouts().then(function (data) {
                $scope.layouts = data;
                $scope.layout = data[0];
                navService.getNavItems({ 'LAYOUT': $scope.layout.value }).then(function (data) {
                    $scope.filterNav(data);
                    $scope.navItems = data;
                });
            });
            navService.getIcons().then(function (data) {
                $scope.nodes = data;
            });
            $scope.filterNav = function (node, index, sub) {
                index = index || 1;
                sub = sub || 0;
                angular.forEach(node, function (node) {
                    if (node.hasOwnProperty('nodes')) {
                        $scope.filterNav(node.nodes, index * (10 + sub), sub + 1);
                    }
                    else
                        node.nodes = [];
                    node.options.icon = node.options.icon.replace('fa fa-', '');
                    node.id = index + sub;
                    index++;
                });
            };
            $scope.visible = function (item) {
                var visible = true;
                //if($scope.query && $scope.query.length > 0) {
                //    if(item.title.indexOf($scope.query) != -1) {
                //        return true;
                //    }
                //    else {
                //        visible = false;
                //        angular.forEach(item.nodes, (v, i) =>
                //        {
                //            if(v.nodes.hasOwnProperty('title') && v.nodes.title.indexOf($scope.query) != -1) {
                //                visible = true;
                //            }
                //        });
                //    }
                //}
                return visible;
            };
            $scope.findNodes = function () {
            };
            $scope.ridNode = function (scope) {
                if (confirm("¿Esta seguro que desea eliminar este nodo?"))
                    scope.remove();
            };
            $scope.toggle = function (scope) {
                scope.toggle();
            };
            $scope.moveLastToTheBeginning = function () {
                var a = $scope.data.pop();
                $scope.data.splice(0, 0, a);
            };
            $scope.newSubItem = function (scope) {
                var nodeData = scope.$modelValue;
                nodeData.nodes.push({
                    id: nodeData.id * 10 + nodeData.nodes.length,
                    label: nodeData.label + '.' + (nodeData.nodes.length + 1),
                    nodes: []
                });
            };
            $scope.collapseAll = function () {
                $scope.$broadcast('angular-ui-tree:collapse-all');
            };
            $scope.expandAll = function () {
                $scope.$broadcast('angular-ui-tree:expand-all');
            };
            $scope.sendForm = function () {
                var data = { NODES: $scope.navItems, LAYOUT: $scope.layout.value };
                navService.sendForm(data).then(function (data) {
                });
                //console.log(data);
            };
            $scope.changeLayout = function () {
                console.log($scope.layout);
            };
        }
        NavController.$inject = ['$scope', 'NavService', 'CommonService'];
        return NavController;
    }());
    Camilion.NavController = NavController;
})(Camilion || (Camilion = {}));
//# sourceMappingURL=navigation.js.map