<?php

namespace app\backstage\controller\v1;

use app\common\model\Common;
use app\common\model\Reg;
use McDanci\ThinkPHP\Config;
use McDanci\Util\UCPaaS\UCPaaS;
use PHPMailer\PHPMailer\PHPMailer;
use think\db\Query;
use think\Request;

/**
 * Class Audit
 * @package app\backstage\controller\v1
 * @todo
 */
class Audit extends SignedController
{
    //region Debug Original

    /**
     * 显示资源列表
     * @return \think\Response
     * @deprecated
     * @todo
     */
    public function _main()
    {
        new \think\Response();
        return null;
    }

    /**
     * 显示创建资源表单页.
     * @deprecated
     * @return \think\Response
     */
    public function create()
    {
    }

    /**
     * 保存新建的资源
     * @deprecated
     * @param  \think\Request $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     * @deprecated
     * @param  int $id
     * @return \think\Response
     */
    public function edit($id)
    {
    }

    /**
     * 保存更新的资源
     * @deprecated
     * @param  \think\Request $request
     * @param  int $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     * @deprecated
     * @param  int $id
     * @return \think\Response
     */
    public function delete($id)
    {
    }

    /**
     * @return bool
     * @deprecated
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

            // TODO: audit approved
            //$this->assign([
            //    'email' => [
            //        'subject' => $subject,
            //    ],
            //    'recipient_name_disp' => 'first name' ?:  'last name' ?: 'registrant',
            //    'project_name' => Config::get('project_info.name'),
            //    'website_name' => 'www.SourceTheFuture.cc',
            //    'url' => [
            //        'img_banner' => 'https://s-show.fmnii.e13.cc/asset/img/banner.png',
            //        'registrant_sign_in' => 'https://s-show.fmnii.e13.cc/api/',
            //        'registrant_order' => 'https://s-show.fmnii.e13.cc/api/',
            //        'website' => 'https://s-show.fmnii.e13.cc/api/',
            //    ],
            //        'email_reply' => 'admin@sourcethefuture.cc',
            //]);
            //echo $mail->Body = $this->fetch('email/audit_approved');

            // TODO: audit rejection
            //$this->assign([
            //    'email' => [
            //        'subject' => $subject,
            //    ],
            //    'url' => [
            //        'img_banner' => 'https://s-show.fmnii.e13.cc/asset/img/banner.png',
            //    ],
            //    'project_name' => Config::get('project_info.name'),
            //    'email_reply' => 'admin@sourcethefuture.cc',
            //
            //    'recipient_name_disp' => 'first name' ?:  'last name' ?: 'registrant',
            //]);
            //echo $mail->Body = $this->fetch('email/audit_rejection');

            // TODO: order paid exhibitor
            //$this->assign([
            //    'email' => [
            //        'subject' => $subject,
            //    ],
            //    'url' => [
            //        'img_banner' => 'https://s-show.fmnii.e13.cc/asset/img/banner.png',
            //        'website' => 'https://s-show.fmnii.e13.cc/api/',
            //    ],
            //    'website_name' => 'www.SourceTheFuture.cc',
            //
            //    'project_name' => Config::get('project_info.name'),
            //    'email_reply' => 'admin@sourcethefuture.cc',
            //
            //    'recipient_name_disp' => 'first name' ?:  'last name' ?: 'registrant',
            //]);
            //echo $mail->Body = $this->fetch('email/exb_payment'); // TODO

            // TODO: reg 2 exhibitor
            //$this->assign([
            //    'email' => [
            //        'subject' => $subject,
            //    ],
            //    'recipient_name_disp' => 'first name' ?:  'last name' ?: 'registrant',
            //    'recipient_email_addr' => 'wong.zain@example.com',
            //    'project_name' => Config::get('project_info.name'),
            //
            //    'url' => [
            //        'img_banner' => 'https://s-show.fmnii.e13.cc/asset/img/banner.png',
            //    ],
            //]);
            //echo $mail->Body = $this->fetch('email/reg2exhibitor');

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

    //region Main

    /**
     * List registrant.
     * @param null|int $page *optional* 页码
     * @param null|int $per_page *optional* 每页条目计数最大值
     *
     * @param null|int $type *optional* `{1: exhibitor, 2: visitor, 3: admin}`
     * @param null|int $status *optional* ` {1: unaudited, 2: audit passed, 3: audit declined}`
     * @param null|string $search *optional*
     * @todo
     *
     * @return array
     * @throws \Exception
     */
    public function main($type = null, $status = null, $search = null)
    {
        $cond = [];
        $reg = new Reg();

        $input = [
            'type' => $this->request->param('type/d') ?: null,
            'status' => $this->request->param('status/d') ?: null,
            'search' => $this->request->param('search/s') ?: null,
        ];

        foreach (['status', 'type'] as &$searchItem) {
            $methodRangeGetterName = 'getRange' . $searchItem;

            if ($input[$searchItem] !== null && in_array($input[$searchItem], Reg::$methodRangeGetterName())) {
                $cond[$searchItem] = $input[$searchItem];
            }
        }
        if ($input['search'] !== null) {
            $cond[implode('|', ['email', 'name_first', 'name_last'])] = ['like', '%' . $input['search'] . '%'];
        }
        if (!count($cond)) {
            $cond = true;
        }

        $result = $reg->field([
            'id',
            'created',
            'email',
            'type',
            'company',
            'city',
            'status',
        ])
            ->where($cond)
            ->order(['id' => Reg::ORDER_DESC])
            ->paginate(Common::getBRowMax());

        return self::retTemp(self::$scOK, null, $result->toArray());
    }

    /**
     * Get profile of registrant.
     * @param int $id
     * @return \think\Response|array
     * @todo 去掉 password
     */
    public function read($id)
    {
        $reg = new Reg();
        $result = $reg->field('type')->find($id);

        if ($result) {
            $relationSet = [];

            switch ($result->toArray()['type']) {
                case 'exhibitor':
                    $relationSet[] = 'regExhibitor';
                    break;
                case 'visitor':
                    $relationSet[] = 'regVisitor';
                    break;
            }

            return self::retTemp(self::$scOK, null, $reg->get(function (Query $query) {
                $query->field(['password'], true)->where(['id' => $this->request->param('id')]); // TODO
            }, $relationSet)->toArray());
        } else {
            return self::retTemp(self::$scNotFound);
        }

        //$reg = Reg::get($id, ['regExhibitor', 'regVisitor']);
        ////$reg->appendRelationAttr('')
        //$reg = Reg::with()->find($id);
        //return self::retTemp(self::$scOK, null, $reg->toArray() ?: [$id]);
    }

    /**
     * @todo
     */
    public function exportExcel()
    {
    }

    //endregion
}
