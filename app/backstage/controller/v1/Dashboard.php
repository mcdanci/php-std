<?php
/**
 * @copyright since 9:24 22/12/2017
 * @author <mc@dancis.info>
 */
namespace app\backstage\controller\v1;

use think\Session;

class Dashboard extends SignedController
{
    /**
     * @return array
     * @throws \Exception
     * @deprecated
     * @todo
     */
    public function main()
    {
        return self::retTemp();
    }

    /**
     * List overview information.
     * @return array
     * ->**body** `array`
     *
     * ->->**amount_paid** `float`
     *
     * ->->**registrant** `array`
     *
     * ->->->**exhibitor** `array`
     *
     * ->->->->**amount_paid** `float`
     *
     * ->->->->**order** `array`
     *
     * ->->->->->**count** `array`
     *
     * ->->->->->->**total** `float`
     *
     * ->->->->->->**unpaid** `float`
     *
     * ->->->**visitor** `array`
     * @throws \Exception
     * @todo
     */
    public function getOverviewInfo()
    {
        return self::retTemp(self::$scOK, null, [
            'amount_paid' => 0,
            'registrant' => [
                'exhibitor' => [
                    'amount_paid' => 0,
                    'order' => [
                        'count' => [
                            'total' => 0,
                            'unpaid' => 0,
                        ],
                    ],
                ],
                'visitor' => [
                    'amount_paid' => 0,
                    'order' => [
                        'count' => [
                            'total' => 0,
                            'unpaid' => 0,
                        ],
                    ],
                ],
            ],
        ]);
    }

    /**
     * 登出。
     * @return array
     * @throws \Exception
     */
    public function SignOut()
    {
        Session::clear();
        return self::retTemp(self::$scOK);
    }
}
