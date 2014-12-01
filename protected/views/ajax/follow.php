<?php
if(!$is_followed):
    echo CHtml::link('关注','javascript:void(0);',array('class'=>'add-follow','id'=>'do-follow'));
else:
    echo CHtml::link('取消关注','javascript:void(0);',array('class'=>'cancel-follow','id'=>'do-follow'));
endif;
?>(<span class="follows-count"><?php echo $follows;?></span>)
<?php $this->widget('ext.ajaxfollow.MAjaxFollowWidget',array(
    'id'=>'do-follow','obj_id'=>$obj_id,'obj_type'=>$obj_type))?>