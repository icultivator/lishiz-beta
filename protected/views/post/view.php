<?php
/* @var $this PostController */
/* @var $model Post */

Yii::app()->clientScript->registerCoreScript('jquery');

$this->breadcrumbs=array(
	'Posts'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Post', 'url'=>array('index')),
	array('label'=>'Create Post', 'url'=>array('create')),
	array('label'=>'Update Post', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Post', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Post', 'url'=>array('admin')),
);
?>

<h1><?php echo $model->title; ?></h1>
<?php if($model->summary):?>
<div class="post-summary" style="background: #eee;margin: 10px 0;padding: 10px;">
    导读:<?php echo $model->summary;?>
</div>
<?php endif;?>

<div class="post-content" style="text-indent: 26px;">
    <?php if($model->cover_in_post==1):?>
        <?php echo CHtml::image($model->cover);?>
    <?php endif;?>
    <?php echo $model->content;?>
</div>

<div class="post-footer" style="background: #eee;margin: 10px 0;padding: 10px;">
    发表于<?php echo date('Y-m-d',$model->create_time)?>，已有<?php echo $model->views;?>次浏览，标签：<?php echo $model->tags;?>
    <?php $this->renderPartial('/ajax/vote',
        array('obj_id'=>$model->id,'obj_type'=>$model->obj_type,'votes'=>$model->votes,'is_voted'=>$model->isVoted()))?>
    <?php $this->renderPartial('/ajax/collect',
        array('obj_id'=>$model->id,'obj_type'=>$model->obj_type,'collects'=>$model->collects,'is_collected'=>$model->isCollected()))?>
</div>

<div class="comments">
    <?php $this->renderPartial('/comment/index',
        array('comments'=>$comments,'obj_id'=>$model->id,'obj_type'=>$model->obj_type,'author_id'=>$model->user_id))?>
</div>


