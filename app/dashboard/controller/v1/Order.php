<?php
/**
 * @copyright since 17:16 27/12/2017
 * @author <mc@dancis.info>
 */
namespace app\dashboard\controller\v1;

class Order extends SignedController
{
    /**
     * 上传水单。
     * @return array|\think\Response
     * @throws \Exception
     */
    public function uploadBillFlow()
    {
        $imgFile = request()->file('img_file');

        if ($imgFile) {
            $imgFile = $imgFile->move(RUNTIME_PATH . 'file_upload');

            if ($imgFile) {
                return self::retTemp(self::$scOK, null, [
                    $imgFile->getSaveName(),
                ]);
            } else {
                return self::retTemp(self::$scOK, null, [
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
        return self::retTemp(self::$scNotFound, null, []);
    }

    /**
     * @todo image file
     */
    public function setOrder()
    {
        $order = new \app\common\model\Order([
            'amount' => 0.01,
            'bank_account_name' => 'BOC 1234 4321',
            'reg_id' => 11,
            ]);
        return self::retTemp(self::$scOK, null, [$order->save()]);
    }

    public function debug()
    {
        return self::retTemp(self::$scOK, null, [
            $this->request->host()
        ]);
    }
}
