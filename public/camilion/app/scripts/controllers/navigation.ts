///<reference path="../app.ts"/>

module Camilion {

    export class NavController {

        static $inject = ['$scope', 'NavService', 'CommonService'];
        query: string;
        layouts: string[] = [];
        layout: string;
        navItems: string;

        constructor(private $scope: any, private navService: NavService, private cmnService: CommonService)
        {
            $scope.selected = '';
            cmnService.getLayouts().then(data=>
            {
                $scope.layouts = data;
                $scope.layout = data[0];

                navService.getNavItems({'LAYOUT' : $scope.layout.value}).then((data: any) =>
                {
                    $scope.filterNav(data);
                    $scope.navItems = data;
                });
            });

            navService.getIcons().then(data =>
            {
                $scope.nodes = data;
            });

            $scope.filterNav = (node, index, sub)=>
            {
                index = index || 1;
                sub = sub || 0;
                angular.forEach(node, function (node)
                {
                    if(node.hasOwnProperty('nodes')) {
                        $scope.filterNav(node.nodes, index * (10 + sub), sub + 1);
                    }
                    else node.nodes = [];

                    node.options.icon = node.options.icon.replace('fa fa-', '');
                    node.id = index + sub;
                    index++;
                });
            };

            $scope.visible = (item): boolean =>
            {
                let visible = true;

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
            $scope.findNodes = ()=>
            {

            };
            $scope.ridNode = (scope)=>
            {
                if(confirm("¿Esta seguro que desea eliminar este nodo?"))
                    scope.remove();
            };

            $scope.toggle = (scope)=>
            {
                scope.toggle();
            };

            $scope.moveLastToTheBeginning = ()=>
            {
                var a = $scope.data.pop();
                $scope.data.splice(0, 0, a);
            };

            $scope.newSubItem = (scope)=>
            {
                var nodeData = scope.$modelValue;
                nodeData.nodes.push({
                    id : nodeData.id * 10 + nodeData.nodes.length,
                    label : nodeData.label + '.' + (nodeData.nodes.length + 1),
                    nodes : []
                });
            };

            $scope.collapseAll = ()=>
            {
                $scope.$broadcast('angular-ui-tree:collapse-all');
            };

            $scope.expandAll = ()=>
            {
                $scope.$broadcast('angular-ui-tree:expand-all');
            };

            $scope.sendForm = (): void=>
            {
                let data = {NODES : $scope.navItems, LAYOUT : $scope.layout.value};

                navService.sendForm(data).then((data: any)=>
                {

                });
                //console.log(data);
            }
            $scope.changeLayout = (): void=>
            {
                console.log($scope.layout);
            }
        }
    }
}