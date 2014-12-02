<?php
/**
 * 图片处理类.
 * User: sunqiang3
 * Date: 2014/11/26
 * Time: 12:54
 */
Yii::import('ext.thumbnail.MPhpThumb');
class MPicManager{
    private $basePath = '';
    private $localPath = '';
    private $webPath = '';

    /**
     * 构造函数
     * @param $mid
     */
    public function __construct(){
        $this->basePath = dirname(__FILE__).'/../../';
        $this->webPath = '/images/user/'.date('Y/m/d/',time());
        $this->localPath = $this->basePath.$this->webPath;
        if(!file_exists($this->localPath)){
            mkdir($this->localPath,0755,true);
        }
    }

    /**
     * 图片上传处理
     * 参数：用户ID和图片名称
     */
    public function upload($filename){
        return true;
    }

    //获取图片本地路径
    public function getLocalPath($filename){
        return $this->localPath.$filename;
    }

    public function getLocalPath2($webpath){
        return $this->basePath.$webpath;
    }

    //获取图片web路径
    public function getWebPath($filename){
        return $this->webPath.$filename;
    }

    public function getSize($filepath){
        $arrImageInfo = getimagesize($filepath);
        return $arrImageInfo;
    }

    //生成缩略图
    public function thumb($filepath,$width=0,$height=0){
        if($width==0 || $height==0){
            return false;
        }
        try{
            $thumb = new MPhpThumb();
            $thumb->init();
            $filepath_1 = $filepath.'_'.$width.'x'.$height.'.'.'jpg';
            $thumb->create($filepath)->resize($width,$height)->save($filepath_1);
        }catch(Exception $ex){
            return false;
        }
        return true;
    }

    public static function getThumbPath($webpath,$width,$height,$extension='jpg'){
        return $webpath.'_'.$width.'x'.$height.'.'.$extension;
    }

    public function crop($filepath,$x,$y,$w,$h){
        try{
            $thumb = new MPhpThumb();
            $thumb->init();
            $thumb->create($filepath)->crop($x,$y,$w,$h)->save($filepath);
        }catch (Exception $ex){
            return false;
        }
        return true;
    }

    //图片删除处理
    public function delete($webPath){
        if(file_exists($this->getLocalPath2($webPath))){
            @unlink($this->getLocalPath2($webPath));
        }
    }

    public function download($imgUrl,$fileName){
        if (trim($imgUrl) == '') {
            return false;
        }

        //获取远程文件
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $imgUrl);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
        $img = curl_exec($ch);
        curl_close($ch);

        $fp2 = @fopen($this->getLocalPath($fileName) . $fileName, 'a');
        fwrite($fp2, $img);
        fclose($fp2);
        unset($img);

        return true;
    }

    //图片库
    public function libs(){

    }
}