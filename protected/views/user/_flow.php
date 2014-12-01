<?php
/* @var $this UserController */
/* @var $data User */
?>

<div class="view">

    <?php if(!$data->obj_status):?>
    [草稿]
    <?php endif;?>
	<b><?php echo CHtml::encode($data->user->name); ?></b>
    于
    <i><?php echo date('Y-m-d H:i:s',$data->log_time);?></i>
    <?php echo Yii::t('opt',OptType::get($data->opt_type));?><?php echo Yii::t('item',ObjType::get($data->obj_type));?>
	:
    <?php echo CHtml::link($data->obj_title,'/'.ObjType::get($data->obj_type).'/'.$data->obj_id);?>

</div>