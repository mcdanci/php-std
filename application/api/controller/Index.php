<?php
/**
 * @copyright since 10:53 20/10/2017
 * @author <mcdanci@users.noreply.github.com>
 */
namespace app\api\controller;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Index extends Controller
{
    private static $EMAIL_TEMPLATE = <<<EOT
Dear administrator,

Please notice thar you have obtained a new {role} application.

{ROLE} registration information:
{body}
EOT;

    private static $MAP_EXHIBITOR = [
        'exhibitor',
        'visitor',
    ]; // TODO

    /**
     * S Show Server Example
     * @return array
     * @return int $-status
     * @return string $-info
     * @return string $-body
     */
    public function index()
    {
        return [
            'status' => 200,
            'info' => 'OK',
            'body' => 'S Show Server',
        ];
    }

    /**
     * 获取 ISO 3166 清单
     * @return array
     * @return int $-status
     * @return string $-info
     * @return array $-body
     * @return array $-- tuple
     * @return array $--name
     * @return array $--numeric
     */
    public function listIso3166()
    {
        $data = (new \League\ISO3166\ISO3166)->all();

        foreach ($data as &$area) {
            unset($area['alpha2'], $area['alpha3'], $area['currency']);
        }

        return [
            'status' => 200,
            'info' => 'OK',
            'body' => $data,
        ];
    }

    /**
     * @return array
     * @link http://www.thinkphp.cn/topic/43753.html
     */
    public function dbgSendMail($email_addr)
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

            // Attachments
            $mail->addAttachment(__FILE__, 'Yours.php');

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Fmnii S Show Subject';
            $mail->Body = '<h1>Hello, buddy</h1>';
            $mail->AltBody = 'Guy!';

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
     * @return array
     * @deprecated
     */
    public function message()
    {
        return [
            'status' => [
                'code' => 200,
                'message' => 'OK',
            ],
            'info' => null, // Fmnii
            'header' => [ // optional
                null,
                null,
            ],
            'content' => null, // CT
            'msg' => null, // CT
            'body' => new \stdClass(),
        ];
    }
}
