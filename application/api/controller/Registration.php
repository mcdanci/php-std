<?php
/**
 * @copyright since 11:04 21/10/2017
 * @author <mcdanci@users.noreply.github.com>
 */
namespace app\api\controller;

class Registration extends Controller
{
    private static $PARAM_COMMON = [
        'name_first',
        'name_last',
        'gender',
        'email',
        'tel',
        'tel_cell',
        'company',
        'street',
        'city',
        'state',
        'zip',
        'iso3166',
        'website',
        'cat',
        'password',
    ];

    private static $PARAM_EXHIBITOR = [
        'c_opf',
        'mpt',
        'mc',
        'tse',
    ];
    private static $PARAM_VISITOR = [
        'job_function',
        'brand',
        'f_man',
    ];

    private $paramList;

    private static function exhibitorEmail($data)
    {
        
    }

    public function exhibitor()
    {
        $this->paramList = array_merge(self::$PARAM_COMMON, self::$PARAM_EXHIBITOR);

        $data = [];

        foreach ($this->paramList as &$param) {
            $value = input($param);
            if (strlen($value)) {
                $data[$param] = $value;
            }
        }

        self::exhibitorEmail($data);

        return [
            'status' => 200,
            'info' => 'OK',
            'body' => $data,
        ];
    }

    public function visitor()
    {
        $this->paramList = array_merge(self::$PARAM_COMMON, self::$PARAM_VISITOR);

        return [
            'status' => 200,
            'body' => $this->paramList,
        ];
    }
}
