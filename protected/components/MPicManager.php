<?php
/**
 * 图片处理类.
 * User: sunqiang3
 * Date: 2014/11/26
 * Time: 12:54
 */

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

    //获取图片web路径
    public function getWebPath($filename){
        return $this->webPath.$filename;
    }

    //生成缩略图
    public function thumb($filepath){
        return true;
    }

    //图片删除处理
    public function delete($path){
        if(file_exists($this->basePath.$path)){

        }
    }

    //图片库
    public function libs(){

    }
}