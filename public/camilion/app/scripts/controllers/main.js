///<reference path="../app.ts"/>
var Camilion;
(function (Camilion) {
    var MainController = (function () {
        function MainController(tableService, cmnService) {
            var _this = this;
            this.tableService = tableService;
            this.cmnService = cmnService;
            this.data = {
                TABLE_NAME: '',
                LAYOUT: 'main',
                PREFIX: 't_',
                SINGULAR: '',
                FIELDS: [],
                TABLE: ''
            };
            //Definition block
            cmnService.getLayouts().then(function (data) {
                _this.layouts = data;
                _this.data.LAYOUT = data[0];
            });
            tableService.getTables().then(function (resp) {
                _this.tables = resp;
                _this.data.TABLE_NAME = resp[0];
                _this.changeSingular();
            });
            tableService.getallTableFields().then(function (tables) {
                tables[_this.data.TABLE_NAME] = tables[_this.data.TABLE_NAME].map(function (item) {
                    item.typeselect = _this.tasteType(item.Type);
                    return item;
                });
                _this.fields = tables;
            }).catch(function (reason) {
                console.log("something went wrong!", reason);
            });
        }
        MainController.prototype.changeSingular = function () {
            this.data.SINGULAR = this.data.TABLE_NAME.substr(this.data.PREFIX.length, this.data.TABLE_NAME.length - this.data.PREFIX.length - 1).replace('_', '');
        };
        MainController.prototype.clearData = function (field) {
            delete field['textSelect'];
            delete field['linkTable'];
            delete field['valueSelect'];
        };
        MainController.prototype.sendForm = function () {
            var _this = this;
            this.data.TABLE = this.data.TABLE_NAME.substring(this.data.PREFIX.length);
            this.data.FIELDS = this.fields[this.data.TABLE_NAME].map(function (item) {
                if (!item.hasOwnProperty('typeselect'))
                    item.typeselect = _this.tasteType(item.Type);
                return item;
            });
            this.tableService.sendForm(this.data).then(function (response) {
                // success function
            }, function (response) {
                console.log(response, 'error');
            });
        };
        MainController.prototype.changeLayout = function () {
            console.log(this.data.LAYOUT);
        };
        MainController.prototype.tasteType = function (type) {
            var t = 'Text';
            if (type.indexOf('(') > -1) {
                var variable = {
                    typo: type.split('(')[0],
                    length: type.split('(')[1].split(')')[0]
                };
                switch (variable.typo) {
                    case 'varchar':
                        if (variable.length <= 15) {
                            t = 'Text';
                        }
                        else if (variable.length < 150) {
                            t = 'Text';
                        }
                        else {
                            t = 'Textarea';
                        }
                        break;
                    case 'integer':
                    case 'int':
                    case 'tinyint':
                    case 'smallint':
                    case 'bigint':
                        if (variable.length < 2) {
                            t = 'Skip';
                        }
                        if (variable.length < 15) {
                            t = 'Text';
                        }
                        else {
                            //befero Select
                            t = 'Skip';
                        }
                        break;
                    case 'bit':
                    case 'binary':
                        t = 'Skip';
                        break;
                }
            }
            else {
                switch (type) {
                    case 'datetime':
                        t = 'Skip';
                        break;
                    case 'date':
                        t = 'Skip';
                        break;
                }
            }
            return t;
        };
        MainController.$inject = [
            "TableService",
            "CommonService"
        ];
        return MainController;
    }());
    Camilion.MainController = MainController;
})(Camilion || (Camilion = {}));
//# sourceMappingURL=main.js.map