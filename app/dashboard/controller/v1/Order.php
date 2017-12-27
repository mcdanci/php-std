<?php
/**
 * @copyright since 17:16 27/12/2017
 * @author <mc@dancis.info>
 */
namespace app\dashboard\controller\v1;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use think\Session;

class Order extends SignedController
{
    /**
     * @return array|\think\Response
     * @throws \Exception
     */
    public function uploadBillFlow()
    {
        $file = request()->file('img_file');

        // 移动到框架应用根目录/public/uploads/ 目录下
        if($file){
            $info = $file->move(ROOT_PATH . 'runtime' . DS . 'temp');
            if($info){
                echo $info->getExtension();
                echo $info->getSaveName();
                echo $info->getFilename();
                return self::retTemp(self::$scOK, null, [
                    $info->getExtension(),
                    $info->getSaveName(),
                    $info->getFilename()
                ]);
            }else{
                return self::retTemp(self::$scOK, null, [
                    $file->getError(),
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
}
