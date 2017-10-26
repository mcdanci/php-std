<?php
/**
 * @copyright since 11:04 21/10/2017
 * @author <mcdanci@users.noreply.github.com>
 */
namespace app\api\controller;

//region TODO: check
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use think\Config;
use think\Db;
//endregion

/**
 * Registration for Stage 1
 * @package app\api\controller
 */
class Registration extends Controller
{
    //region Common

    /**
     * String to digit within array
     * @param array $array
     * @return array
     * @throws \Exception
     */
    private static function string2intInArray(&$array)
    {
        foreach ($array as &$item) {
            if (is_numeric($item)) {
                $item = (int)$item;
            } else {
                throw new \Exception('error');
            }
        }

        return $array;
    }

    /**
     * For giving tip to user after submitted
     * @param string $message
     * @param null|string $url
     * @see \traits\controller\Jump::success
     */
    private function successfulTip($message = '', $url = null)
    {
        config('default_return_type', 'html');
        $this->success($message, $url);
    }

    //endregion

    //region Application Common

    /**
     * Common type definition
     */
    const
        COMMON_TYPE_EXHIBITOR = 1,
        COMMON_TYPE_VISITOR = 2;

    /**
     * @var array Attr. for common
     */
    private static $paramCommon = [
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

    /**
     * @var array Attr. for exhibitor
     */
    private static $paramExhibitor = [
        'c_opf',
        'mpt',
        'mc',
        'tse',
    ];

    /**
     * @var array Attr. for exhibitor
     */
    private static $paramVisitor = [
        'job_function',
        'brand',
        'f_man',
    ];

    /**
     * @var array Map for attr which is using in email
     */
    private static $paramMap;

    /**
     * @var array Param. list used by current object
     */
    private $paramList;

    /**
     * Getting description of gender
     * @param array $data
     *
     * Key | Value
     * --- | ---
     * 1 | Mrs.
     * 2 | Mr.
     */
    private static function getGenderDesc(&$data)
    {
        if (array_key_exists('gender', $data)) {
            $data['gender'] = ($data['gender'] == 2) ? 'Mr.' : 'Mrs.';
        }
    }

    /**
     * Getting description of country
     *
     * `iso3166`
     * @param array $data
     */
    private static function getCountryDesc(&$data)
    {
        if (array_key_exists('iso3166', $data)) {
            $data['iso3166'] = (new \League\ISO3166\ISO3166)->numeric((string)$data['iso3166'])['name'];
        }
    }

    /**
     * Sept. categories
     * @param string $dataIso3166
     * @return array
     * @throws \Exception
     */
    private static function getCategory($dataIso3166)
    {
        $dataArr = [];

        if (strlen($dataIso3166)) {
            $dataArr = explode(',', $dataIso3166);

            if (is_array($dataArr)) {
                self::string2intInArray($dataArr);
            } else {
                $dataArr = [];
            }
        }

        return $dataArr;
    }

    /**
     * Sept. categories and return category description
     * @param array $data
     */
    private static function getCategoryDesc(&$data)
    {
        if (array_key_exists('cat', $data)) {
            $desc = [];

            $dataArr = self::getCategory($data['cat']);

            if ($dataArr) {
                for ($counter = 1; $counter < count(Config::get('category_desc')) + 1; $counter++) {
                    if (in_array($counter, $dataArr)) {
                        $desc[] = Config::get('category_desc.' . $counter);
                    }
                }

                $desc = implode(', ', $desc);

                $data['cat'] = $desc;
            } else {
                $data['cat'] = '';
            }
        }
    }

    /**
     * Unset password (from email)
     * @param array $data
     */
    private static function emailUnset(&$data)
    {
        if (array_key_exists('password', $data)) {
            unset($data['password']);
        }
    }

    /**
     * Email data process
     * @param array $data
     */
    private static function emailProcessSet(&$data)
    {
        self::getGenderDesc($data);
        self::getCountryDesc($data);
        self::getCategoryDesc($data);
        self::emailUnset($data);
    }

    /**
     * Sending email
     * @param $emailBody
     * @param $emailSubject
     * @return array
     * @todo check
     */
    private static function sendEmail($emailBody, $emailSubject)
    {
        $emailAddrMailer = Config::get('phpmailer.username');
        $emailAddr = Config::get('phpmailer.addr2b_sent');

        // Begin
        $mail = new PHPMailer(true);

        try {
            // Server settings
            //$mail->SMTPDebug = 2;
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = Config::get('phpmailer.host');
            $mail->SMTPAuth = true;
            $mail->Username = $emailAddrMailer;
            $mail->Password = Config::get('phpmailer.password');
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            // Recipients
            $mail->setFrom($emailAddrMailer, 'Mailer');
            $mail->addAddress($emailAddr, 'Recipient');
            $mail->addReplyTo($emailAddrMailer, 'Reply to Address');
            $mail->addCC($emailAddr);
            $mail->addBCC($emailAddr);

            $mail->isHTML(true);
            $mail->Subject = $emailSubject;
            $mail->Body = '<pre>' . $emailBody . '</pre>';
            $mail->AltBody = $emailBody;

            $mail->send();

            return [
                'status' => 200,
                'info' => 'Message has been sent',
                'body' => $mail,
            ];
        } catch (Exception $e) {
            return [
                'status' => 500,
                'info' => 'Message could note be sent',
                'body' => 'Mailer error: ' . $mail->ErrorInfo,
            ];
        }
    }

    /**
     * Setup var.
     * @see \app\api\controller\Registration::$paramMap
     */
    protected function _initialize()
    {
        parent::_initialize();
        self::$paramMap = Config::get('map_attr_desc');
    }

    //endregion

    //region Exhibitor

    private static $emailExhibitorBody = <<<EOT
Dear Administrator,

Please notice that you have obtained a new exhibitor application.

Exhibitor registration information:

EOT;

    /**
     * Sending exhibitor registration successful email to administrator
     * @param $data
     * @return mixed
     */
    private static function exhibitorEmail($data)
    {
        $content = '';

        self::emailProcessSet($data);

        // content
        foreach ($data as $key => &$val) {
            $content .= self::$paramMap[$key] . ': ' . $val . PHP_EOL;
        }

        self::$emailExhibitorBody .= $content;
        self::sendEmail(self::$emailExhibitorBody, 'Fmnii S Show Exhibitor Registration');

        return $data;
    }

    /**
     * exhibitor process
     * @todo
     */
    public function exhibitor()
    {
        $data = $swap = [];
        $this->paramList = array_merge(self::$paramCommon, self::$paramExhibitor);

        // input process
        foreach ($this->paramList as &$param) {
            $value = input($param);
            if (strlen($value)) {
                $data[$param] = $value;
            }
        }

        // save to database
        $data2 = $data;
        $data2['created'] = self::datetimeNow();
        $data2['type'] = self::COMMON_TYPE_EXHIBITOR;
        foreach (self::$paramExhibitor as &$item) {
            if (array_key_exists($item, $data2)) {
                $swap[$item] = $data2[$item];
                unset($data2[$item]); // todo: need or not?
            }
        }
        $result[] = Db::name('common')->insert($data2);

        $swap['common_id'] = Db::name('common')->getLastInsID();
        $result[] = Db::name('exhibitor')->insert($swap);

        // Send email
        $data = self::exhibitorEmail($data);

        $this->successfulTip('Submitted successful.');
        //return [
        //    'status' => 200,
        //    'body' => [$data, $result],
        //];
    }

    //endregion

    //region Visitor

    private static $emailVisitorBody = <<<EOT
Dear Administrator,

Please notice that you have obtained a new visitor application.

Exhibitor registration information:

EOT;

    /**
     * Sending visitor registration successful email to administrator
     * @param $data
     * @return mixed
     */
    private static function visitorEmail($data)
    {
        $content = '';

        self::emailProcessSet($data);

        // content
        foreach ($data as $key => &$val) {
            $content .= self::$paramMap[$key] . ': ' . $val . PHP_EOL;
        }

        self::$emailVisitorBody .= $content;
        self::sendEmail(self::$emailVisitorBody, 'Fmnii S Show Visitor Registration');

        return $data;
    }

    /**
     * Visitor process
     * @todo
     */
    public function visitor()
    {
        $data = [];
        $this->paramList = array_merge(self::$paramCommon, self::$paramVisitor);

        // input process
        foreach ($this->paramList as &$param) {
            $value = input($param);
            if (strlen($value)) {
                $data[$param] = $value;
            }
        }

        // save to database
        $data2 = $data;
        $data2['created'] = self::datetimeNow();
        $data2['type'] = self::COMMON_TYPE_VISITOR;
        foreach (self::$paramVisitor as &$item) {
            if (array_key_exists($item, $data2)) {
                $swap[$item] = $data2[$item];
                unset($data2[$item]); // todo: need or not?
            }
        }
        $result[] = Db::name('common')->insert($data2);

        $swap['common_id'] = Db::name('common')->getLastInsID();
        $result[] = Db::name('visitor')->insert($swap);

        // Send email
        $data = self::visitorEmail($data);

        $this->successfulTip('Submitted successful.');
        //return [
        //    'status' => 200,
        //    'body' => [$data],
        //];
    }

    //endregion
}
