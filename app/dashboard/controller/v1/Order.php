<?php
/**
 * @copyright since 17:16 27/12/2017
 * @author <mc@dancis.info>
 */
namespace app\dashboard\controller\v1;

use app\common\model;
use think\File;
use think\Response;

class Order extends SignedController
{
    const DIR_UPLOAD = RUNTIME_PATH . 'file_upload';

    /**
     * 上传水单。
     * $param resource $img_file 水单图
     * @return array|\think\Response
     *
     * @throws \Exception
     * @todo 文件輸出方法
     * @todo return doc
     */
    public function uploadBillFlow()
    {
        if ($this->regId) {
            $imgFile = request()->file('img_file');

            if ($imgFile) {
                $imgFile = $imgFile
                    /**
                     * - 30 MiB
                     */
                    //->validate([
                    //    'size' => 30 * pow(2, 10 * 2),
                    //    'ext' => ['jpg', 'png', 'gif', 'bmp', 'svg', 'tiff'], /** @todo */
                    //])
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
        return self::retTemp(self::$scNotFound, null, []);
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

            if ($order) {
                $storage = model\Storage::get(['storage']);
                if ($storage) {
                    $key = $storage->key;
                    if ($key) {
                        $file = new File(self::DIR_UPLOAD . DS . $key);

                        if (file_exists($file)) {
                            header('Content-Length: ' . $file->getSize());
                            readfile($file);
                        }
                    }
                }

            }
        }

        /**
         * @todo
         */
        return Response::create(self::retTemp(self::$scNotFound), 'json', self::$scNotFound);
    }

    /**
     * 水单登记。
     * @return array|\think\Response
     * @throws \Exception
     */
    public function setOrder($receipt_img_file = null)
    {
        if ($receipt_img_file) {
            $order = model\Order::get([
                'reg_id' => $this->regId,
            ]);

            if ($order) {
                // TODO
                //$order = new model\Order([
                //    'amount' => 0.01,
                //    'bank_account_name' => 'BOC 1234 4321',
                //    'reg_id' => 11,
                //]);

                $order->receipt_img_file = $receipt_img_file;
                if ($order->save()) {
                    return self::retTemp(self::$scOK, null, ['key' => $order->save()]);
                }
            }
        }

        return self::retTemp(self::$scNotFound);
    }
}
