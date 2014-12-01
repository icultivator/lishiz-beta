<?php
if(!$is_collected):
    echo CHtml::link('收藏','javascript:void(0);',array('class'=>'add-collect','id'=>'do-collect'));
else:
    echo CHtml::link('取消收藏','javascript:void(0);',array('class'=>'cancel-collect','id'=>'do-collect'));
endif;
?>(<span class="collects-count"><?php echo $collects;?></span>)
<?php $this->widget('ext.ajaxcollect.MAjaxCollectWidget',array(
    'id'=>'do-collect','obj_id'=>$obj_id,'obj_type'=>$obj_type))?>