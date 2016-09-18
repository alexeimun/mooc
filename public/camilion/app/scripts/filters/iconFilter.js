///<reference path="../../../../../typings/main/ambient/angular/index.d.ts"/>
var Camilion;
(function (Camilion) {
    function IconFilter() {
        return function (items, model) {
            var fItems = [];
            if (items) {
                items.map(function (item, ind) {
                    //console.log(item);
                    if (item.id.startsWith(model)) {
                        fItems.push(item);
                    }
                    else if (item.id.indexOf(model) != -1) {
                        //console.log(item.name);
                        fItems.push(item);
                    }
                    //else if(item.hasOwnProperty('keywords')) {
                    //    //console.log(ind);
                    //    if(item.keywords) {
                    //        let flag = true;
                    //        item.keywords.map(keyword =>
                    //        {
                    //            if(flag) {
                    //                if(keyword.indexOf(model) != -1) {
                    //                    fItems.push(item);
                    //                    flag = false;
                    //                }
                    //            }
                    //        });
                    //    }
                    //}
                });
            }
            //console.count('+++++++++++++++++++++++++++++++++');
            //console.log(fItems);
            //console.log('=================================');
            //fItems = fItems.sort(function (a, b)
            //{
            //    return (a.id > b.id) ? 1 :((b.id > a.id) ? -1 :0);
            //});
            return fItems;
        };
    }
    Camilion.IconFilter = IconFilter;
})(Camilion || (Camilion = {}));
//# sourceMappingURL=iconFilter.js.map