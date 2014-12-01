<?php
/* @var $this VideoController */
/* @var $data Video */
?>

<div class="view">

    <b><?php echo CHtml::encode($data->getAttributeLabel('cover')); ?>:</b>
    <?php echo CHtml::image(CHtml::encode($data->cover)); ?>
    <br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title'), array('view', 'id'=>$data->id)); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->title),'/video/'.$data->id); ?>
	<br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('category')); ?>:</b>
    <?php echo Yii::app()->params['video_type'][CHtml::encode($data->category)]; ?>
    <br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tags')); ?>:</b>
	<?php echo CHtml::encode($data->tags); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('votes')); ?>:</b>
	<?php echo CHtml::encode($data->votes); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('views')); ?>:</b>
	<?php echo CHtml::encode($data->views); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comments')); ?>:</b>
	<?php echo CHtml::encode($data->comments); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_time')); ?>:</b>
	<?php echo CHtml::encode($data->create_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('last_update')); ?>:</b>
	<?php echo CHtml::encode($data->last_update); ?>
	<br />

	*/ ?>

</div>