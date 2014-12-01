<?php
/**
 * 异步点赞组件.
 * User: heidi
 * Date: 2014/11/30
 * Time: 3:22
 */
class MAjaxVoteWidget extends CWidget{

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
    $('.add-vote').live('click',function(){
        $.post(
            '/vote/add',
            {'obj_id':{$this->obj_id},'obj_type':{$this->obj_type}},
            function(data){
                if(data.success){
                    count = $(".votes-count").text();
                    count = parseInt(count)+1;
                    $(".votes-count").text(count);
                    $('#{$this->id}').text('取消点赞');
                    $('#{$this->id}').attr('class','cancel-vote');
                }else{
                    alert(data.msg);
                }
            },
            'json'
        );
    });
    $('.cancel-vote').live('click',function(){
        $.post(
            '/vote/cancel',
            {'obj_id':{$this->obj_id},'obj_type':{$this->obj_type}},
            function(data){
                if(data.success){
                    count = $(".votes-count").text();
                    count = parseInt(count)-1;
                    $(".votes-count").text(count);
                    $('#{$this->id}').text('点赞');
                    $('#{$this->id}').attr('class','add-vote');
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
        $assetsPath = Yii::getPathOfAlias('ext.ajaxvote');
        $assetsUrl = Yii::app()->assetManager->publish($assetsPath, false, -1, YII_DEBUG);
        return $assetsUrl;
    }
}