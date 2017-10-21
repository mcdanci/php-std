<?php
/**
 * @copyright since 11:04 21/10/2017
 * @author <mcdanci@users.noreply.github.com>
 */
namespace app\api\controller;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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

    private static function exhibitorEmail($data, $email_addr = '15812890021@qq.com')
    {
        static $mailerEmailAddr = 'web@fmnii.com';

        // Begin
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->SMTPDebug = 2;
            $mail->isSMTP();
            $mail->Host = 'smtp.exmail.qq.com';
            $mail->SMTPAuth = true;
            $mail->Username = $mailerEmailAddr;
            $mail->Password = '@Fmnii789';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            // Recipients
            $mail->setFrom($mailerEmailAddr, 'Mailer');
            $mail->addAddress($email_addr, 'Recipient');
            $mail->addReplyTo($mailerEmailAddr, 'Reply to Address');
            $mail->addCC($email_addr);
            $mail->addBCC($email_addr);

            // Content
            $content = '';
            foreach ($data as $key => &$val) {
                $content .= $key . ': ' . $val . PHP_EOL;
            }

            $mail->isHTML(true);
            $mail->Subject = 'Fmnii S Show Subject';
            $mail->Body = '<h1>Hello, buddy</h1>' . '<pre>' . $content . '</pre>';
            $mail->AltBody = 'Guy!' . print_r($data);

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
