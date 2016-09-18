///<reference path="../../../../../typings/main/ambient/angular/index.d.ts"/>

module Camilion {

    export function Typeahead(): ng.IDirective
    {
        return {
            restrict : 'AEC',
            scope : {
                items : '=',
                prompt : '@',
                title : '@',
                subtitle : '@',
                model : '=',
                onSelect : '&'
            },
            link : (scope: any, elem, attrs) =>
            {
                scope.onBlur = () =>
                {
                    scope.available = true;
                }
                scope.onFocus = () =>
                {
                    scope.available = false;
                }
                scope.handleSelection = (selectedItem) =>
                {
                    scope.model = selectedItem;
                    scope.current = 0;
                    scope.selected = true;
                    scope.available = false;

                    setTimeout(() =>
                    {
                        scope.onSelect();
                    }, 200);
                };
                scope.isCurrent = (index) =>
                {
                    return scope.current == index;
                };
                scope.setCurrent = (index) =>
                {
                    scope.current = index;
                };
            },
            templateUrl : 'public/camilion/app/scripts/templates/templateurl.html'
        }
    }
}