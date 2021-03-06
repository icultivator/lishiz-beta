<?php
/**
 * Created by PhpStorm.
 * User: sunqiang3
 * Date: 2014/12/1
 * Time: 13:05
 */
class MAvatarCropWidget extends CWidget{
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
        $cs->registerScriptFile($this->assetsUrl.'/js/jquery.imgareaselect.min.js', CClientScript::POS_HEAD);
    }

    /**
     * 运行组件.
     */
    public function run()
    {
        $script = <<<AVATOR
    var thumb_width = 100;
    var thumb_height = 100;
    var current_large_image_width = 250;
    var current_large_image_height = 250;
    $(window).load(function () {
        $("#thumbnail").imgAreaSelect({ aspectRatio: "1:thumb_height/thumb_width", onSelectChange: preview });
    });
    $(document).ready(function () {
        $("#save_thumb").click(function() {
            var x1 = $("#x1").val();
            var y1 = $("#y1").val();
            var x2 = $("#x2").val();
            var y2 = $("#y2").val();
            var w = $("#w").val();
            var h = $("#h").val();
            if(x1=="" || y1=="" || x2=="" || y2=="" || w=="" || h==""){
                alert("You must make a selection first");
                return false;
            }else{
                return true;
           }
        });
    });
    function preview(img, selection) {
        var scaleX = thumb_width / selection.width;
        var scaleY = thumb_height / selection.height;

        $('#thumbnail + div > img').css({
            width: Math.round(scaleX * current_large_image_width) + 'px',
            height: Math.round(scaleY * current_large_image_height) + 'px',
            marginLeft: '-' + Math.round(scaleX * selection.x1) + 'px',
            marginTop: '-' + Math.round(scaleY * selection.y1) + 'px'
        });
        $('#x1').val(selection.x1);
        $('#y1').val(selection.y1);
        $('#x2').val(selection.x2);
        $('#y2').val(selection.y2);
        $('#w').val(selection.width);
        $('#h').val(selection.height);
    }
AVATOR;

        /** @var CClientScript $cs */
        $cs = Yii::app()->getClientScript();
        $cs->registerScript($this->id, $script, CClientScript::POS_READY);
    }

    public function getAssetsUrl()
    {
        $assetsPath = Yii::getPathOfAlias('ext.avatar');
        $assetsUrl = Yii::app()->assetManager->publish($assetsPath, false, -1, YII_DEBUG);
        return $assetsUrl;
    }
}