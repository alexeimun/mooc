///<reference path="../../../../../typings/main/ambient/angular/index.d.ts"/>
var Camilion;
(function (Camilion) {
    function Typeahead() {
        return {
            restrict: 'AEC',
            scope: {
                items: '=',
                prompt: '@',
                title: '@',
                subtitle: '@',
                model: '=',
                onSelect: '&'
            },
            link: function (scope, elem, attrs) {
                scope.onBlur = function () {
                    scope.available = true;
                };
                scope.onFocus = function () {
                    scope.available = false;
                };
                scope.handleSelection = function (selectedItem) {
                    scope.model = selectedItem;
                    scope.current = 0;
                    scope.selected = true;
                    scope.available = false;
                    setTimeout(function () {
                        scope.onSelect();
                    }, 200);
                };
                scope.isCurrent = function (index) {
                    return scope.current == index;
                };
                scope.setCurrent = function (index) {
                    scope.current = index;
                };
            },
            templateUrl: 'public/camilion/app/scripts/templates/templateurl.html'
        };
    }
    Camilion.Typeahead = Typeahead;
})(Camilion || (Camilion = {}));
//# sourceMappingURL=Typeahead.js.map