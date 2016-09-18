<?php

    return [
        'css' => [
            'camilion/app/css/style.css',
            'angular-ui-tree/dist/angular-ui-tree.min.css',
            //'angular-ui-select/dist/select.min.css',
        ],
        'js' => [
            //---------Library load--------------
            'angular/angular.min.js',
            //----------Modules-----------------
            'angular-sanitize/angular-sanitize.min.js',
            'angular-route/angular-route.min.js',
            'angular-ui-tree/dist/angular-ui-tree.min.js',
            //'angular-ui-select/dist/select.min.js',
            //----------Services----------------
            'camilion/app/scripts/services/CommonService.js',
            'camilion/app/scripts/services/TableService.js',
            'camilion/app/scripts/services/NavService.js',
            //----------Directives----------------
            'camilion/app/scripts/directives/Typeahead.js',
            //----------Filters----------------
            'camilion/app/scripts/filters/iconFilter.js',
            //----------Controllers--------------
            'camilion/app/scripts/controllers/main.js',
            'camilion/app/scripts/controllers/navigation.js',
            //-------------------App--------------
            'camilion/app/scripts/app.js',
        ],
    ];