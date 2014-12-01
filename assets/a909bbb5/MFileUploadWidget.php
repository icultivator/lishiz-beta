<?php
/**
 * 文件上传组件
 * @author:www.lishiz.com
 */

class MFileUploadWidget extends CInputWidget
{
    public $id;
    public $cover = 'cover';
    public $preview = 'preview';
    public $request = '/post/upload';
    public $avatar = '';

    /**
     * 初始化组件
     */
    public function init()
    {
        // 阻止从命令行执行.
        if (Yii::app() instanceof CConsoleApplication)
            return;

        /** @var CClientScript $cs */
        $cs = Yii::app()->getClientScript();
        $cs->registerScriptFile($this->assetsUrl.'/assets/js/jquery.ui.widget.js', CClientScript::POS_HEAD);
        $cs->registerScriptFile($this->assetsUrl.'/assets/js/jquery.iframe-transport.js', CClientScript::POS_HEAD);
        $cs->registerScriptFile($this->assetsUrl.'/assets/js/jquery.fileupload.js', CClientScript::POS_HEAD);
    }

    /**
     * 运行组件.
     */
    public function run()
    {

        if($this->avatar=='avatar'){
            $script = <<<FUL
$(function () {
    $('#{$this->id}').fileupload({
        dataType: 'json',
        url: '{$this->request}',
        success: function (data) {
            $('#{$this->avatar}').attr('value',data.avatar);
            $('#{$this->preview}').attr('src',data.avatar);
        }
    });
});
FUL;
        }else{
            $script = <<<FUL
$(function () {
    $('#{$this->id}').fileupload({
        dataType: 'json',
        url: '{$this->request}',
        success: function (data) {
            $('#{$this->cover}').attr('value',data.cover);
            $('#{$this->preview}').html('<img src="'+data.cover+'" style="width:200px;height:150px;"/>');
        }
    });
});
FUL;
        }

        /** @var CClientScript $cs */
        $cs = Yii::app()->getClientScript();
        $cs->registerScript($this->id, $script, CClientScript::POS_READY);
        //$cs->registerScriptFile($this->assetsUrl.'/lang/'.$this->language.'.js', CClientScript::POS_HEAD);
    }

    public function getAssetsUrl()
    {
        $assetsPath = Yii::getPathOfAlias('ext.fileupload');
        $assetsUrl = Yii::app()->assetManager->publish($assetsPath, false, -1, YII_DEBUG);
        return $assetsUrl;
    }
}

?>