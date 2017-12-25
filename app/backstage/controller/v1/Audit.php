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
    //public function update(Request $request, $id)
    //{
    //    //
    //}

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
     * @param null|int $id
     * @return \think\Response|array
     * @todo 去掉 password
     */
    public function read($id = null)
    {
        if (is_numeric($id)) {
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
            }
        }

        return self::retTemp(self::$scNotFound);

        //$reg = Reg::get($id, ['regExhibitor', 'regVisitor']);
        ////$reg->appendRelationAttr('')
        //$reg = Reg::with()->find($id);
        //return self::retTemp(self::$scOK, null, $reg->toArray() ?: [$id]);
    }

    /**
     * 列出拒绝的缘由。
     * @return array|\think\Response
     * @throws \Exception
     */
    public function listReason()
    {
        return self::retTemp(self::$scOK, null, Reg::$mapAttrReason);
    }

    /**
     * 变更审核状态。
     * @param null $id
     * @param null $status Status {2: audit passed, 3: audit declined}
     * @param null|int|string $reason 当且仅当拒绝时：exhibitor 传入单个值，visitor 传入逗号分隔的不少于一个值；值域系 \app\backstage\controller\v1\Audit::listReason 中对应角色所有的 keys
     * @return array|\think\Response
     * @throws \Exception
     */
    public function setStatus($id = null, $status = null, $reason = null)
    {
        if (is_numeric($id) &&
            in_array($status, Reg::getRangeStatus()) &&
            $status != Reg::STATUS_UNAUDITED
            ) {
            $reg = Reg::get($id);
            if ($reg && in_array($reg['type'], Reg::getRangeType())) { // TODO
                if ($reg['status'] != Reg::STATUS_UNAUDITED) {
                    $projectName = Config::get('project_info.name') . ' Information';
                    $emailSubject = $projectName . ' Information'; // TODO
                    $recipientNameDisp = $reg->name_first ?:  $reg->name_last ?: 'registrant';

                    switch ($reg['type']) {
                        case 'exhibitor':
                            switch ($status) {
                                case Reg::STATUS_PASSED:
                                    $emailVar = [
                                        'email' => [
                                            'subject' => $emailSubject,
                                        ],
                                        'recipient_name_disp' => $recipientNameDisp,
                                        'project_name' => $projectName,
                                        'website_name' => 'www.SourceTheFuture.cc',
                                        'url' => [
                                            'img_banner' => 'https://s-show.fmnii.e13.cc/asset/img/banner.png',
                                            'registrant_sign_in' => 'https://s-show.fmnii.e13.cc/api/',
                                            'registrant_order' => 'https://s-show.fmnii.e13.cc/api/',
                                            'website' => 'https://s-show.fmnii.e13.cc/api/',
                                        ],
                                        'email_reply' => 'admin@sourcethefuture.cc',
                                    ];
                                    self::sendEmailByReg($reg, 'email/audit_approved', $emailVar);

                                    $reg->status = 'passed';
                                    $reg->save();
                                    return self::retTemp();
                                    break;
                                case Reg::STATUS_DECLINED:
                                    $reg->status = 'declined';
                                    $reg->reason = Reg::$mapAttrReason['exhibitor'][$reason];

                                    if (is_numeric($reason) && in_array($reason, array_keys(Reg::$mapAttrReason['exhibitor']))) {
                                        $emailVar = [
                                            'email' => [
                                                'subject' => $emailSubject,
                                            ],
                                            'url' => [
                                                'img_banner' => 'https://s-show.fmnii.e13.cc/asset/img/banner.png',
                                            ],
                                            'project_name' => $projectName,
                                            'email_reply' => 'admin@sourcethefuture.cc',

                                            'recipient_name_disp' => $recipientNameDisp,

                                            'company' => $reg->company,
                                            'reason' => [
                                                $reg->reason,
                                            ],
                                        ];
                                        self::sendEmailByReg($reg, 'email/audit_rejection', $emailVar);

                                        $reg->save();
                                        return self::retTemp(self::$scOK);
                                    }
                            }
                            break;
                        case 'visitor':
                            switch ($status) {
                                case Reg::STATUS_PASSED:
                                    $emailVar = [
                                        'email' => [
                                            'subject' => $emailSubject,
                                        ],
                                        'recipient_name_disp' => $recipientNameDisp,
                                        'project_name' => $projectName,
                                        'website_name' => 'www.SourceTheFuture.cc',
                                        'url' => [
                                            'img_banner' => 'https://s-show.fmnii.e13.cc/asset/img/banner.png',
                                            'registrant_sign_in' => 'https://s-show.fmnii.e13.cc/api/',
                                            'registrant_order' => 'https://s-show.fmnii.e13.cc/api/',
                                            'website' => 'https://s-show.fmnii.e13.cc/api/',
                                        ],
                                        'email_reply' => 'admin@sourcethefuture.cc',
                                    ];
                                    self::sendEmailByReg($reg, 'email/audit_approved', $emailVar);

                                    $reg->status = 'passed';
                                    $reg->save();
                                    return self::retTemp();
                                    break;
                                case Reg::STATUS_DECLINED:
                                    $reason = explode(',', $reason);
                                    if ($reason) {
                                        foreach ($reason as &$reasonEntry) {
                                            if (!in_array($reasonEntry, array_keys(Reg::$mapAttrReason['visitor']))) {
                                                return self::retTemp(self::$scNotFound, 'Param. is not correct');
                                            }
                                        }

                                        $tmpReason= [];
                                        foreach ($reason as &$reasonEntry) {
                                            $tmpReason[] = Reg::$mapAttrReason['visitor'][$reasonEntry];
                                        }

                                        $reg->status = 'declined';
                                        $reg->reason = implode(' || ', $tmpReason);

                                        $emailVar = [
                                            'email' => [
                                                'subject' => $emailSubject,
                                            ],
                                            'url' => [
                                                'img_banner' => 'https://s-show.fmnii.e13.cc/asset/img/banner.png',
                                            ],
                                            'project_name' => $projectName,
                                            'email_reply' => 'admin@sourcethefuture.cc',

                                            'recipient_name_disp' => $recipientNameDisp,

                                            'company' => $reg->company,
                                            'reason' => $tmpReason,
                                        ];

                                        self::sendEmailByReg($reg, 'email/audit_rejection', $emailVar);

                                        $reg->save();

                                        return self::retTemp(self::$scOK);
                                    }
                            }
                            break;
                    }
                }
            }
        }

        // TODO
        return self::retTemp(self::$scNotFound);
    }

    /**
     * @todo
     */
    public function exportExcel()
    {
        return [];
    }

    //region Email

    private function sendEmailByReg(Reg $reg, $temp, $emailVar)
    {
        $projectName = Config::get('project_info.name');

        $mail = new PHPMailer(true);

        try {
            // Server settings

            // TODO: 4 debug
            //$mail->SMTPDebug = 2;

            $mail->isSMTP();

            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'ssl';
            $mail->Host = Config::get('phpmailer.host');
            $mail->Username = Config::get('phpmailer.mailer.web.' . USERNAME);
            $mail->Password = Config::get('phpmailer.mailer.web.' . PASSWORD);
            $mail->Port = Config::get('phpmailer.port');

            $mail->setFrom(Config::get('phpmailer.mailer.web.' . USERNAME)); // TODO


            $mail->addAddress($reg->email);
            $mail->addBCC('15812890021@139.com');
            $mail->addBCC('13965945999@163.com');

            // Content
            $mail->isHTML(true);
            $mail->Subject = $projectName . ' Information'; // TODO

            // TODO: audit approved
            $this->assign($emailVar);
            $mail->Body = $this->fetch($temp);


            $mail->send();

            // TODO: debug
            return true;
            //return self::retTemp(self::$scOK, 'Message has been sent', $mail);
        } catch (\Exception $e) {
            // TODO: debug
            return false;
            //return self::retTemp(self::$scNotFound, 'Message could note be sent', 'Mailer error: ' . $mail->ErrorInfo);
        }
    }

    //endregion

    //endregion
}
