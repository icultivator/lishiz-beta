<?php
/* @var $this VideoController */
/* @var $model Video */

$this->breadcrumbs=array(
	'Videos'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Video', 'url'=>array('index')),
	array('label'=>'Create Video', 'url'=>array('create')),
	array('label'=>'Update Video', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Video', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Video', 'url'=>array('admin')),
);
?>

<h1><?php echo $model->title; ?></h1>

<div class="header">
    由
    <b><?php echo $model->user->name?></b>
    创建于
    <i><?php echo date('Y-m-d H:i:s',$model->create_time)?></i>
</div>

<div class="content">
    <?php echo CHtml::image($model->cover);?><br>
    <?php echo $model->content;?>
</div>

<div class="footer">
    <?php echo $model->tags;?>
    <?php $this->renderPartial('/ajax/vote',
        array('obj_id'=>$model->id,'obj_type'=>$model->obj_type,'votes'=>$model->votes,'is_voted'=>$model->isVoted()))?>
    <?php $this->renderPartial('/ajax/collects',
        array('obj_id'=>$model->id,'obj_type'=>$model->obj_type,'collects'=>$model->collects,'is_collected'=>$model->isCollected()))?>
</div>

<div class="comments">
    <?php $this->renderPartial('/comment/index',
        array('comments'=>$comments,'obj_id'=>$model->id,'obj_type'=>$model->obj_type,'author_id'=>$model->user_id))?>
</div>
