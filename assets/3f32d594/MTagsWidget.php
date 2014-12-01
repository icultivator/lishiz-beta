<?php

/**
 * TagsInput标签输入组件
 * @author:http://www.lishiz.com
 */

class MTagsWidget extends CInputWidget
{
    public $id;

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
        $cs->registerScriptFile($this->assetsUrl.'/jquery.tagsinput.min.js', CClientScript::POS_HEAD);
        $cs->registerScriptFile($this->assetsUrl.'/jquery.tagsinput.css', CClientScript::POS_HEAD);
    }

    /**
     * 运行组件.
     */
    public function run()
    {
        $script = "$('#".$this->id."').tagsInput();";
        /** @var CClientScript $cs */
        $cs = Yii::app()->getClientScript();
        $cs->registerScript($this->id, $script, CClientScript::POS_READY);
    }

    public function getAssetsUrl()
    {
        $assetsPath = Yii::getPathOfAlias('ext.tagsinput');
        $assetsUrl = Yii::app()->assetManager->publish($assetsPath, false, -1, YII_DEBUG);
        return $assetsUrl;
    }
}

?>