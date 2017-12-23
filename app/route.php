<?php
use McDanci\ThinkPHP\Route;
use McDanci\ThinkPHP\Config;

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
