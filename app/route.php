<?php
use McDanci\ThinkPHP\Route;
use McDanci\ThinkPHP\Config;

Route::rule([
    'v1/backstage/Audit/main' => 'backstage/v1.Audit/main', // TODO: What?
    'v1/backstage/Audit/getOverview' => 'backstage/v1.Audit/getOverview',
    'v1/backstage/Audit/listReason' => 'backstage/v1.Audit/listReason',
    'v1/backstage/Audit/setStatus' => 'backstage/v1.Audit/setStatus',
    'v1/backstage/Audit/exportExcel' => 'backstage/v1.Audit/exportExcel',
]);

//region Resource

$routeResourceList = [
    'backstage' => [
        'Audit',
    ],
];

foreach ($routeResourceList as $moduleName => &$module) {
    foreach ($module as &$controllerName) {
        Route::resource(
            implode('/', ['v1', $moduleName, lcfirst($controllerName)]),
            implode('/', [$moduleName, implode('.', ['v1', $controllerName])])
        );
    }
}

// TODO
//Route::controller('v1/backstage/main', 'Backstage/v1.Main');

//endregion

/**
 * @todo
 */
return [
    //region TODO: Default
    ':v/:m/:c/:a' => ':m/:v.:c/:a',
    ':v/:m/:c$' => ':m/:v.:c/' . Config::get(NAME_ACTION_DEFAULT),

    '__pattern__' => [
        'name' => '\w+',
    ],
    '[hello]' => [
        ':id' => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],

    //endregion
];
