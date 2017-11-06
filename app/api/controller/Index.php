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
    //region ISO 3166

    /**
     * Process for the list of ISO 3166
     * - Description of Taiwan
     * @param $list
     * @todo Unit test
     */
    private static function modCountriesNRegions(&$list)
    {
        static $NUMERIC = '158';

        if (array_key_exists($NUMERIC, $list)) {
            $desc = explode(' ', $list[$NUMERIC]);
            $list[$NUMERIC] = reset($desc);
        }
    }

    /**
     * Getting data as list of ISO 3166
     * @return array
     * ->**status** int
     *
     * ->**body** array
     *
     * ->->**numeric**:**name** string Entry
     * @todo Unit test
     */
    public function listOptionIso3166Nov()
    {
        $list = [];

        $listOriginal = (new \League\ISO3166\ISO3166)->all();

        foreach ($listOriginal as &$entry) {
            $list[$entry['numeric']] = $entry['name'];
        }

        self::modCountriesNRegions($list);

        return ['status' => self::$scOK, 'body' => $list];
    }

    /**
     * Getting data as list of ISO 3166
     * @return array
     * ->**status** int
     *
     * ->**info** string
     *
     * ->**body** array
     *
     * ->-> array
     *
     * ->->->**name** string
     *
     * ->->->**numeric** string
     * @deprecated
     */
    public function listOptionIso3166()
    {
        $data = (new \League\ISO3166\ISO3166)->all();

        foreach ($data as &$cnr) {
            foreach (['alpha2', 'alpha3', 'currency'] as &$key) {
                unset($cnr[$key]);
            }
        }

        return self::retTemp(self::$scOK, 'OK', $data);
    }

    /**
     * Getting data as list of ISO 3166
     * @return array
     * @see \app\api\controller\Index::listOptionIso3166
     * @deprecated
     */
    public function listIso3166()
    {
        return $this->listOptionIso3166();
    }

    //endregion

    /**
     * Getting data as list of gender
     * @return array
     * ->**status** int
     *
     * ->**info** string
     *
     * ->**body** array
     *
     * ->->**value**:**HTML** array string
     * @throws \Exception
     * @todo Unit test
     */
    public function listOptionGender()
    {
        return self::retTemp(self::$scOK, 'OK', Config::getByDot('option-gender'));
    }
}
