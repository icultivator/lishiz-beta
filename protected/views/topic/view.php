<?php
/* @var $this TopicController */
/* @var $model Topic */

$this->breadcrumbs=array(
	'Topics'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Topic', 'url'=>array('index')),
	array('label'=>'Create Topic', 'url'=>array('create')),
	array('label'=>'Update Topic', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Topic', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Topic', 'url'=>array('admin')),
);
?>

<h1><?php echo $model->title; ?></h1>

<div class="header">
    本话题创建于
    <i><?php echo date('Y-m-d',$model->create_time)?></i>
</div>

<div class="content">
    <?php echo $model->content;?>
</div>

<div class="footer">
    <?php echo $model->tags;?>
    <?php $this->renderPartial('/ajax/vote',
        array('obj_id'=>$model->id,'obj_type'=>$model->obj_type,'votes'=>$model->votes,'is_voted'=>$model->isVoted()))?>
    <?php $this->renderPartial('/ajax/follow',
        array('obj_id'=>$model->id,'obj_type'=>$model->obj_type,'follows'=>$model->follows,'is_followed'=>$model->isFollowed()))?>
</div>

<div class="comments">
    <?php $this->renderPartial('/comment/index',
        array('comments'=>$comments,'obj_id'=>$model->id,'obj_type'=>$model->obj_type,'author_id'=>$model->user_id))?>
</div>
