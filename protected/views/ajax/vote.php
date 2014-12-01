<?php
if(!$is_voted):
    echo CHtml::link('点赞','javascript:void(0);',
        array('class'=>'add-vote','obj_id'=>$obj_id,'obj_type'=>$obj_type));
else:
    echo CHtml::link('取消点赞','javascript:void(0);',
        array('class'=>'cancel-vote','obj_id'=>$obj_id,'obj_type'=>$obj_type));
endif;
?>(<span class="votes-count"><?php echo $votes;?></span>)
<?php $this->widget('ext.ajaxvote.MAjaxVoteWidget',array(
    'id'=>'do-vote'))?>