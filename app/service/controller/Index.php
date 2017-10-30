<?php
/**
 * @copyright since 10:05 30/10/2017
 * @author <mcdanci@users.noreply.github.com>
 */
namespace app\service\controller;

use think\Cache;
use think\Config;
use think\Controller;
use think\Db;

/**
 * Application Service Status
 * @package app\service\controller
 */
class Index extends Controller
{
    use \Fmnii\Controller\Convention;

    /**
     * Current Database
     * @return array
     * @throws \Exception
     * @throws \think\exception\PDOException
     */
    private static function currentDatabase()
    {
        $ret = [];

        foreach (Config::get('database.db_list') as $dbId => &$dsnDb) {
            $curr = Db::connect($dsnDb)->query('SHOW DATABASES');
            if (is_array($curr)) {
                foreach ($curr as &$db) {
                    $ret[$dbId][] = $db['Database'];
                }
            } else {
                $ret[$dbId] = $curr;
            }
        }

        return $ret;
    }

    /**
     * Overview
     * @todo
     */
    public function index()
    {
        return 'S Show API';
    }

    /**
     * Current
     * @todo
     */
    public function current()
    {
        return self::retTemp(self::$scSucceeded, 'Database only', [
            'database' => self::currentDatabase(),
        ]);
    }
}
