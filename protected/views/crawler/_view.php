<?php
/* @var $this CrawlerController */
/* @var $data Crawler */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('site')); ?>:</b>
	<?php echo CHtml::encode($data->site); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('list')); ?>:</b>
	<?php echo CHtml::encode($data->list); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('detail')); ?>:</b>
	<?php echo CHtml::encode($data->detail); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('detail_title')); ?>:</b>
	<?php echo CHtml::encode($data->detail_title); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('detail_content')); ?>:</b>
	<?php echo CHtml::encode($data->detail_content); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('detail_cover')); ?>:</b>
	<?php echo CHtml::encode($data->detail_cover); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('detail_tags')); ?>:</b>
	<?php echo CHtml::encode($data->detail_tags); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_time')); ?>:</b>
	<?php echo CHtml::encode($data->create_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('last_update')); ?>:</b>
	<?php echo CHtml::encode($data->last_update); ?>
	<br />

	*/ ?>

</div>