<?php
if(!$is_voted):
    echo CHtml::link('点赞','javascript:void(0);',array('class'=>'add-vote','id'=>'do-vote'));
else:
    echo CHtml::link('取消点赞','javascript:void(0);',array('class'=>'cancel-vote','id'=>'do-vote'));
endif;
?>(<span class="votes-count"><?php echo $votes;?></span>)
<?php $this->widget('ext.ajaxvote.MAjaxVoteWidget',array(
    'id'=>'do-vote','obj_id'=>$obj_id,'obj_type'=>$obj_type))?>