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
        var vote_link = this;
        var obj_id = $(vote_link).attr('obj_id');
        var obj_type = $(vote_link).attr('obj_type');
        var votes_count = $(vote_link).next('span.votes-count');
        var count = $(votes_count).text();
        $.post(
            '/vote/add',
            {'obj_id':obj_id,'obj_type':obj_type},
            function(data){
                if(data.success){
                    count = parseInt(count)+1;
                    $(votes_count).text(count);
                    $(vote_link).text('取消点赞');
                    $(vote_link).attr('class','cancel-vote');
                }else{
                    alert(data.msg);
                }
            },
            'json'
        );
    });
    $('.cancel-vote').live('click',function(){
        var vote_link = this;
        var obj_id = $(vote_link).attr('obj_id');
        var obj_type = $(vote_link).attr('obj_type');
        var votes_count = $(this).next('span.votes-count');
        var count = $(votes_count).text();
        $.post(
            '/vote/cancel',
            {'obj_id':obj_id,'obj_type':obj_type},
            function(data){
                if(data.success){
                    count = parseInt(count)-1;
                    $(votes_count).text(count);
                    $(vote_link).text('点赞');
                    $(vote_link).attr('class','add-vote');
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