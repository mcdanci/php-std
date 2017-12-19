<?php

namespace app\backstage\controller\v1;

use app\common\model\Reg;
use McDanci\ThinkPHP\Config;
use PHPMailer\PHPMailer\PHPMailer;
use think\Request;

/**
 * Class Audit
 * @package app\backstage\controller\v1
 * @todo
 */
class Audit extends SignedController
{
    //region Original

    /**
     * 显示资源列表
     *
     * @return \think\Response
     * @todo
     */
    public function _main()
    {
        new \think\Response();
        return null;
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
    }

    /**
     * @return bool
     * @throws \PHPMailer\PHPMailer\Exception
     * @todo
     */
    public function ahaha($subject = 'ahaha')
    {
        Config::set(RETURN_TYPE_DEFAULT, 'html');

        $mail = new PHPMailer(true);

        try {
            //static $RECIPIENT_TYPE_MAP = [
            //    'to' => 'addAddress',
            //    'cc' => 'addCC',
            //    'bcc' => 'addBCC',
            //];

            // Server settings

            // TODO: 4 debug
            $mail->SMTPDebug = 2;

            $mail->isSMTP();

            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'ssl';
            $mail->Host = Config::get('phpmailer.host');
            $mail->Username = Config::get('phpmailer.mailer.admin.' . USERNAME);
            $mail->Password = Config::get('phpmailer.mailer.admin.' . PASSWORD);
            $mail->Port = Config::get('phpmailer.port');

            $mail->setFrom(Config::get('phpmailer.mailer.admin.' . USERNAME)); // TODO


            // Recipients
            //$recipientTypeList = array_keys($RECIPIENT_TYPE_MAP);
            //$confRecipient = Config::get('phpmailer.recipient');
            //
            //foreach (array_keys($confRecipient) as &$confRecipientType) {
            //    if (in_array($confRecipientType, $recipientTypeList, true)) {
            //        foreach ($confRecipient[$confRecipientType] as &$recipient) {
            //            $mail->{$RECIPIENT_TYPE_MAP[$confRecipientType]}($recipient);
            //        }
            //    }
            //}
            $mail->addAddress('13965945999@163.com');
            $mail->addAddress('15812890021@139.com');

            // Content
            $mail->isHTML(true);
            $mail->Subject = $subject;

            // TODO
            $this->assign([
                'recipient_name_disp' => 'first name' ?:  'last name' ?: 'registrant',
                'project_name' => Config::get('project_info.name'),
                'website_name' => 'www.SourceTheFuture.cc',
                'url' => [
                    'img_banner' => 'img/banner.png',
                    'registrant_sign_in' => 'https://s-show.fmnii.e13.cc/api/',
                    'registrant_order' => 'https://s-show.fmnii.e13.cc/api/',
                    'website' => 'https://s-show.fmnii.e13.cc/api/',
                    'email_reply' => 'admin@sourcethefuture.cc',
                ],
            ]);
            echo $mail->Body = $this->fetch('email/audit_app');

            $mail->send();

            // TODO: debug
            //return true;
            return '11111111111111111111111';
            //return self::retTemp(self::$scOK, 'Message has been sent', $mail);
        } catch (\Exception $e) {
            // TODO: debug
            //return false;
            return '0000000000000000000000';
            //return self::retTemp(self::$scNotFound, 'Message could note be sent', 'Mailer error: ' . $mail->ErrorInfo);
        }
    }

    //endregion

    /**
     * @return false|\PDOStatement|string|\think\Collection
     * @todo perpage @ header
     *
     */
    public function main($page = 1, $pageRow = null)
    {
        if ($pageRow === null) {
            $pageRow = Config::get('paginate.list_rows');
        }

        // TODO: ORDER
        $result = Reg::getByStatus(Reg::STATUS_UNAUDITED)
            ->field('password', true)
            ->where(['status' => Reg::STATUS_UNAUDITED])
            ->order(['id' => Reg::ORDER_DESC])
            ->paginate($pageRow)->each(function ($item, $key) {
                return $item;
            });

        return $result;

        //return self::retTemp(self::$scOK, null, $data);
    }
}
