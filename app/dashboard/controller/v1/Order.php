<?php
/**
 * @copyright since 17:16 27/12/2017
 * @author <mc@dancis.info>
 */
namespace app\dashboard\controller\v1;

use app\common\model;
use McDanci\ThinkPHP\Config;
use think\File;
use think\Response;

class Order extends SignedController
{
    //region Common

    const TIP_ACCESS_VISITOR = 'Visitor access only';

    const DIR_UPLOAD = RUNTIME_PATH . 'file_upload';

    /**
     * @var null|model\Order
     */
    protected $order;

    //endregion

    //region Checkout

    /**
     * Set bank account name.
     * @param null|string $bank_account_name Bank account name
     * @return array|Response
     */
    public function setBankAccountName($bank_account_name = null)
    {
        try {
            self::checkInputString($bank_account_name, 'bank account name');
        } catch (\RuntimeException $exception) {
            return self::retTemp(self::$scNotFound, $exception->getMessage());
        }

        $this->order = model\Order::get(['reg_id' => $this->regId]);

        if ($this->order) {
            $data = $this->order->toArray();
            if (array_key_exists('bank_account_name', $data)) {
                if ($data['bank_account_name']) {
                    return self::retTemp(self::$scNotFound, 'Bank account name already been set');
                } else {
                    $result = $this->order->save(['bank_account_name' => $bank_account_name]);

                    if ($result) {
                        return self::retTemp(self::$scOK, $this->order->bank_account_name);
                    }
                }
            }
        }

        return self::retTemp(self::$scNotFound);
    }

    /**
     * On checkout.
     * @return array|Response
     * @todo amount total
     * @todo booth type
     * @todo booth size (ordered booth count)
     * @todo booth zone
     * @todo bank account name
     * @todo booth number (list)
     */
    public function getOrderInfo()
    {
        if ($this->regId) {
            $this->order = model\Order::get(['reg_id' => $this->regId]);

            if ($this->order) {
                return self::retTemp(self::$scOK, null, $this->order->toArray());
            }
        }

        return self::retTemp(self::$scNotFound);
    }

    //endregion

    //region Direct bank transfer

    /**
     * Get information of direct bank transfer instruction.
     * @return array|Response
     */
    public function getDBTInfo()
    {
        return self::retTemp(self::$scOK, null, Config::get('dbt_info'));
    }

    /**
     * 上传水单。
     * $param resource $img_file 水单图
     * @param null| $reg_id registrant ID *optional*
     * @return array|\think\Response
     * @throws \Exception
     * @todo 文件輸出方法
     * @todo return doc
     * @todo $reg_id not safe
     */
    public function uploadBillFlow($reg_id = null)
    {
        if (!$this->regId) {
            if ($reg_id) {
                $this->regId = $reg_id;
            } else {
                return self::retTemp(self::$scNotFound, Config::get('msg_dashboard.reg_id_empty'));
            }
        }


        $imgFile = request()->file('img_file');

        if ($imgFile) {
            $imgFile = $imgFile
                /**
                 * - 30 MiB
                 */
                ->validate([
                    'size' => 30 * pow(2, 10 * 2),
                    'ext' => ['jpg', 'png', 'gif', 'bmp', 'svg', 'tiff'], /** @todo */
                ])
                ->rule('md5')
                ->move(RUNTIME_PATH . 'file_upload');

            if ($imgFile) {
                $key = $imgFile->getSaveName();
                $storage = new model\Storage([
                    'key' => $key,
                    'file_ref' => $key,
                    //'o_filename' => '', // TODO
                ]);
                if ($storage->save()) {
                    return self::retTemp(self::$scOK, null, [
                        'key' => $key,
                    ]);
                }
            } else {
                return self::retTemp(self::$scNotFound, null, [
                    $imgFile->getError(),
                    //'info' => $info,
                    //$_FILES['bill_water'],
                    //$_FILES,
                    //'info' => is_uploaded_file($_FILES['bill_water']),
                ]);
            }
        }

        ///* PUT data comes in on the stdin stream */
        //$putdata = fopen("php://stdin", "r");
        //
        ///* Open a file for writing */
        //$fp = fopen('image_aaa_'.Session::get('reg_id').'.jpg', "w");
        //
        ///* Read the data 1 KB at a time
        //   and write to the file */
        //while ($data = fread($putdata, 1024))
        //    fwrite($fp, $data);
        //
        ///* Close the streams */
        //fclose($fp);
        //fclose($putdata);
        //if (is_uploaded_file($_FILES['file']['tmp_name'])) {
        //    $info = "File ". $_FILES['file']['name'] ." uploaded successfully.\n";
        //    $info .= "Displaying contents\n";
        //    readfile($_FILES['file']['tmp_name']);
        //} else {
        //    $info = "Possible file upload attack: ";
        //    $info .= "filename '". $_FILES['userfile']['tmp_name'] . "'.";
        //}
        return self::retTemp(self::$scNotFound, null, [
            $this->regId,
            RUNTIME_PATH . 'file_upload',
        ]);
    }

    /**
     * 删除水单资源。
     * @param $key
     * @return array|\think\Response
     * @throws \Exception
     */
    public function deleteBillFlow($key = null)
    {
        if ($key) {
            $storage = model\Storage::get(['key' => $key]);

            if ($storage) {
                $result = $storage->delete();

                if ($result) {
                    return self::retTemp(self::$scOK, null, [$result]);
                }
            }
        }

        return self::retTemp(self::$scNotFound);
    }

    /**
     * @return Response|\think\response\Json|\think\response\Jsonp|\think\response\Redirect|\think\response\View|\think\response\Xml
     * @throws \Exception
     * @todo
     */
    public function readFileBillFlow()
    {
        if ($this->regId) {
            $order = model\Order::get(['reg_id' => $this->regId]);

            if ($order && array_key_exists('receipt_img_file', $order->getData())) {
                $storage = model\Storage::get(['key' => $order['receipt_img_file']]);
                if ($storage) {
                    $file_ref = $storage->file_ref;
                    if ($file_ref) {
                        $fileName = self::DIR_UPLOAD . DS . $file_ref;

                        $file = new File($fileName);

                        if ($file->isFile()) {
                            header('Content-Length: ' . $file->getSize());
                            readfile($fileName);
                            return null;
                        } else {
                            return self::retTemp(self::$scNotFound, 4);
                        }
                    } else {
                        return self::retTemp(self::$scNotFound, 3);
                    }
                } else {
                    return self::retTemp(self::$scNotFound, 2);
                }

            } else {
                return self::retTemp(self::$scNotFound, 1);
            }
        }

        /**
         * @todo
         */
        return Response::create(self::retTemp(self::$scNotFound, 0), 'json', self::$scNotFound);
    }

    //endregion

    //region Order confirmation

    /**
     * Set bank receipt.
     * @param null|string $receipt_img_file Receipt image file
     * @return array|\think\Response
     * @throws \Exception
     */
    public function setOrder($receipt_img_file = null)
    {
        try {
            self::checkInputString($receipt_img_file, 'receipt image file');
        } catch (\RuntimeException $exception) {
            return self::retTemp(self::$scOK, $exception->getMessage());
        }

        if (is_string($receipt_img_file) && strlen($receipt_img_file)) {
            $order = model\Order::get(['reg_id' => $this->regId]);

            if ($order) {
                if ($order['status'] == $order::STATUS_UNPAID) {
                    $input['status'] = $order::STATUS_RECEIPT_UPLOADED;
                    // TODO: could be opt by checking storage

                    $result = $order->save([
                        'status' => $order::STATUS_RECEIPT_UPLOADED,
                        'receipt_img_file' => $receipt_img_file,
                    ]);

                    if ($result) {
                        return self::retTemp(self::$scOK, null, ['key' => $order->save()]);
                    }
                } else {
                    return self::retTemp(
                        self::$scNotFound,
                        'Order is not in correct status for this action'
                    );
                }
            } else {
                return self::retTemp(self::$scNotFound, 'No order existence');
            }
        }

        return self::retTemp(self::$scNotFound);
    }

    //endregion
}
