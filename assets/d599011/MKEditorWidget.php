<?php

/**
 * Kindeditor编辑器输入组件
 * @author:http://www.lishiz.com
 */

class MKEditorWidget extends CInputWidget
{
    public $id;
    public $language = 'zh_CN';
    public $paramOptions = '{}';

    /**
     * 初始化组件.
     */
    public function init()
    {
        // 阻止从命令行执行.
        if (Yii::app() instanceof CConsoleApplication)
            return;

        /** @var CClientScript $cs */
        $cs = Yii::app()->getClientScript();
        $cs->registerScriptFile($this->assetsUrl.'/assets/js/kindeditor.js', CClientScript::POS_HEAD);
        $cs->registerCssFile($this->assetsUrl.'/assets/css/default.css', CClientScript::POS_HEAD);
    }

    /**
     * 运行组件.
     */
    public function run()
    {
        $script = "KindEditor.ready(function(K){window.editor=K.create('#".$this->id."',".$this->paramOptions.");});";
        /** @var CClientScript $cs */
        $cs = Yii::app()->getClientScript();
        $cs->registerScript($this->id, $script, CClientScript::POS_READY);
        $cs->registerScriptFile($this->assetsUrl.'/assets/lang/'.$this->language.'.js', CClientScript::POS_HEAD);
    }

    public function getAssetsUrl()
    {
        $assetsPath = Yii::getPathOfAlias('ext.editor');
        $assetsUrl = Yii::app()->assetManager->publish($assetsPath, false, -1, YII_DEBUG);
        return $assetsUrl;
    }
}

?>