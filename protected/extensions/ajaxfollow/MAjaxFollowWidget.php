<?php
/**
 * 异步点赞组件.
 * User: heidi
 * Date: 2014/11/30
 * Time: 3:22
 */
class MAjaxFollowWidget extends CWidget{

    public $id;
    public $obj_id;
    public $obj_type;

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
    }

    /**
     * 运行组件.
     */
    public function run()
    {
        $script = <<<FUL
$(function () {
    $('.add-follow').live('click',function(){
        $.post(
            '/follow/add',
            {'obj_id':{$this->obj_id},'obj_type':{$this->obj_type}},
            function(data){
                if(data.success){
                    count = $(".follows-count").text();
                    count = parseInt(count)+1;
                    $(".follows-count").text(count);
                    $('#{$this->id}').text('取消关注');
                    $('#{$this->id}').attr('class','cancel-follow');
                }else{
                    alert(data.msg);
                }
            },
            'json'
        );
    });
    $('.cancel-follow').live('click',function(){
        $.post(
            '/follow/cancel',
            {'obj_id':{$this->obj_id},'obj_type':{$this->obj_type}},
            function(data){
                if(data.success){
                    count = $(".follows-count").text();
                    count = parseInt(count)-1;
                    $(".follows-count").text(count);
                    $('#{$this->id}').text('关注');
                    $('#{$this->id}').attr('class','add-follow');
                }else{
                    alert(data.msg);
                }
            },
            'json'
        );
    });
});
FUL;

        /** @var CClientScript $cs */
        $cs = Yii::app()->getClientScript();
        $cs->registerScript($this->id, $script, CClientScript::POS_READY);
        //$cs->registerScriptFile($this->assetsUrl.'/lang/'.$this->language.'.js', CClientScript::POS_HEAD);
    }

    public function getAssetsUrl()
    {
        $assetsPath = Yii::getPathOfAlias('ext.ajaxfollow');
        $assetsUrl = Yii::app()->assetManager->publish($assetsPath, false, -1, YII_DEBUG);
        return $assetsUrl;
    }
}