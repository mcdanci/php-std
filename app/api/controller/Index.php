<?php
/**
 * @copyright since 15:23 31/10/2017
 * @author <mcdanci@users.noreply.github.com>
 */
namespace app\api\controller;

use McDanci\ThinkPHP\Config;

/**
 * Overview
 * @package app\api\controller
 */
class Index extends Controller
{
    /**
     * S Show API Echo
     * @return array
     * ->status int
     * @throws \Exception
     * @todo Unit test
     */
    public function index()
    {
        return self::retTemp();
    }

    /**
     * Getting data as list of ISO 3166
     * @return array
     * ->status int
     *
     * ->info string
     *
     * ->body array
     *
     * ->-> array Tuple
     *
     * ->->->name string
     *
     * ->->->numeric string
     * @todo Unit test
     */
    public function listOptionIso3166()
    {
        $data = (new \League\ISO3166\ISO3166)->all();

        foreach ($data as &$area) {
            foreach (['alpha2', 'alpha3', 'currency'] as &$key) {
                unset($area[$key]);
            }
        }

        return self::retTemp(self::$scOK, 'OK', $data);
    }

    /**
     * @return array
     * @deprecated
     */
    public function listIso3166()
    {
        return $this->listOptionIso3166();
    }

    /**
     * Getting data as list of gender
     * @return array
     * ->status int
     *
     * ->info string
     *
     * ->body array
     *
     * ->-> array Tuple in `value: HTML`
     * @throws \Exception
     * @todo Unit test
     */
    public function listOptionGender()
    {
        return self::retTemp(self::$scOK, 'OK', Config::getByDot('option-gender'));
    }
}
