<?php
/**
 * @copyright since 15:23 31/10/2017
 * @author <mcdanci@users.noreply.github.com>
 */
namespace app\api\controller;

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
     * ->-> array tuple
     *
     * ->->->name string
     *
     * ->->->numeric string
     * @todo Unit test
     */
    public function listIso3166()
    {
        $data = (new \League\ISO3166\ISO3166)->all();

        foreach ($data as &$area) {
            unset($area['alpha2'], $area['alpha3'], $area['currency']);
        }

        return self::retTemp(self::$scOK, 'OK', $data);
    }
}
