<?php
/**
 * @copyright since 17:59 20/12/2017
 * @author <mc@dancis.info>
 */
namespace McDanci\ThinkPHP;

class Route extends \think\Route
{
    private static $rest = [
        'index' => ['get', '', 'main'],
        'create' => ['get', '/create', 'create'],
        'edit' => ['get', '/:id/edit', 'edit'],
        'read' => ['get', '/:id', 'read'],
        'save' => ['post', '', 'save'],
        'update' => ['put', '/:id', 'update'],
        'delete' => ['delete', '/:id', 'delete'],
    ];

    /**
     * 注册资源路由
     * @access public
     * @param string $rule 路由规则
     * @param string $route 路由地址
     * @param array $option 路由参数
     * @param array $pattern 变量规则
     * @return void
     * @todo
     */
    public static function resource($rule, $route = '', $option = [], $pattern = [])
    {
        if (is_array($rule)) {
            foreach ($rule as $key => $val) {
                if (is_array($val)) {
                    list($val, $option, $pattern) = array_pad($val, 3, []);
                }
                self::resource($key, $val, $option, $pattern);
            }
        } else {
            if (strpos($rule, '.')) {
                // 注册嵌套资源路由
                $array = explode('.', $rule);
                $last = array_pop($array);
                $item = [];
                foreach ($array as $val) {
                    $item[] = $val . '/:' . (isset($option['var'][$val]) ? $option['var'][$val] : $val . '_id');
                }
                $rule = implode('/', $item) . '/' . $last;
            }
            // 注册资源路由
            foreach (self::$rest as $key => $val) {
                if ((isset($option['only']) && !in_array($key, $option['only']))
                    || (isset($option['except']) && in_array($key, $option['except']))
                ) {
                    continue;
                }
                if (isset($last) && strpos($val[1], ':id') && isset($option['var'][$last])) {
                    $val[1] = str_replace(':id', ':' . $option['var'][$last], $val[1]);
                } elseif (strpos($val[1], ':id') && isset($option['var'][$rule])) {
                    $val[1] = str_replace(':id', ':' . $option['var'][$rule], $val[1]);
                }
                $item = ltrim($rule . $val[1], '/');
                $option['rest'] = $key;
                self::rule($item . '$', $route . '/' . $val[2], $val[0], $option, $pattern);
            }
        }
    }
}
