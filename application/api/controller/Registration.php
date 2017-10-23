<?php
/**
 * @copyright since 11:04 21/10/2017
 * @author <mcdanci@users.noreply.github.com>
 */
namespace app\api\controller;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use think\Config;
use think\Db;

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

    private static $PARAM_MAP = [
        'name_first' => 'First Name',
        'name_last' => 'Last Name',
        'gender' => 'Gender',
        'email' => 'Email',
        'tel' => 'Telephone',
        'tel_cell' => 'Cell Phone',
        'company' => 'Company Name',
        'street' => 'Street',
        'city' => 'City',
        'state' => 'State (Required for U.S. and Canada Only)',
        'zip' => 'Zip Code',
        'iso3166' => 'Country',
        'website' => 'Company Website',
        'cat' => 'Category',

        'c_opf' => 'Country(ies) with own production facility',
        'mpt' => 'Major Product Type(s)',
        'mc' => 'Major Customer(s)',
        'tse' => 'What other trade shows do you exhibit with (if any)',
    ];

    private $paramList;

    private static function sendEmail($emailBody)
    {
        $emailAddrMailer = Config::get('phpmailer.username');
        $emailAddr = Config::get('phpmailer.addr2b_sent');

        // Begin
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->SMTPDebug = 2;
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
            $mail->Subject = 'Fmnii S Show Subject';
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

    //region Exhibitor

    private static function exhibitorEmail($data)
    {
        $content = $emailBody = '';

        // Data process, rip of dictionary items
        // - Gender
        if (array_key_exists('gender', $data)) {
            $data['gender'] = ($data['gender'] == 2) ? 'Mr.' : 'Mrs.';
        }
        // - Country (`iso3166`)
        if (array_key_exists('iso3166', $data)) {
            $data['iso3166'] = (new \League\ISO3166\ISO3166)->numeric((string)$data['iso3166'])['name'];
        }
        // - TODO: Category

        // - Password
        if (array_key_exists('password', $data)) {
            unset($data['password']);
        }

        // Content
        foreach ($data as $key => &$val) {
            $content .= self::$PARAM_MAP[$key] . ': ' . $val . PHP_EOL;
        }

        $emailBody = 'Dear Administrator,

Please notice that you have obtained a new exhibitor application.

Exhibitor registration information:
' . $content;
        self::sendEmail($emailBody);

        return $data;
    }

    public function exhibitor()
    {
        $data = $swap = [];
        $this->paramList = array_merge(self::$PARAM_COMMON, self::$PARAM_EXHIBITOR);

        // input process
        foreach ($this->paramList as &$param) {
            $value = input($param);
            if (strlen($value)) {
                $data[$param] = $value;
            }
        }

        // save to database
        $data2 = $data;
        foreach (self::$PARAM_EXHIBITOR as &$item) {
            if (array_key_exists($item, $data2)) {
                $swap[$item] = $data2[$item];
                unset($data2[$item]); // todo: need or not?
            }
        }
        $result[] = Db::name('common')->insert($data2);

        $swap['common_id'] = Db::name('common')->getLastInsID();
        $result[] = Db::name('exhibitor')->insert($swap);

        $data = self::exhibitorEmail($data);

        return [
            'status' => 200,
            'body' => [$data, $result],
        ];
    }

    //endregion

    //region Visitor

    private static function visitorEmail($data)
    {
    }

    public function visitor()
    {
        $data = [];
        $this->paramList = array_merge(self::$PARAM_COMMON, self::$PARAM_VISITOR);

        // input process
        foreach ($this->paramList as &$param) {
            $value = input($param);
            if (strlen($value)) {
                $data[$param] = $value;
            }
        }

        self::exhibitorEmail($data);

        return [
            'status' => 200,
            'body' => $this->paramList,
        ];
    }

    //endregion
}
