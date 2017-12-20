<?php

$routeResourceList = [
    'backstage' => [
        'Audit',
    ],
];

foreach ($routeResourceList as $moduleName => &$module) {
    foreach ($module as &$controllerName) {
        \McDanci\ThinkPHP\Route::resource(
            implode('/', ['v1', $moduleName, lcfirst($controllerName)]),
            implode('/', [$moduleName, implode('.', ['v1', $controllerName])])
        );
    }
}

/**
 * @todo
 */
return [
    //region TODO: Default

    '__pattern__' => [
        'name' => '\w+',
    ],
    '[hello]' => [
        ':id' => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],

    //endregion
];
