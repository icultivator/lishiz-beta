<?php
/* @var $this BookController */
/* @var $model Book */

$this->breadcrumbs=array(
	'Books'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Book', 'url'=>array('index')),
	array('label'=>'Create Book', 'url'=>array('create')),
	array('label'=>'Update Book', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Book', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Book', 'url'=>array('admin')),
);
?>

<h1><?php echo $model->title; ?></h1>

<div class="header"></div>

<div class="content">
    <?php echo CHtml::image($model->cover);?><br/>
    <?php echo $model->content;?>
</div>

<div class="footer">
    <div class="tags">
        标签：<?php echo $model->tags;?>
    </div>
    <?php $this->renderPartial('/ajax/vote',
        array('obj_id'=>$model->id,'obj_type'=>$model->obj_type,'votes'=>$model->votes,'is_voted'=>$model->isVoted()))?>
    <?php $this->renderPartial('/ajax/collect',
        array('obj_id'=>$model->id,'obj_type'=>$model->obj_type,'collects'=>$model->collects,'is_collected'=>$model->isCollected()))?>
</div>

<div class="comments">
    <?php $this->renderPartial('/comment/index',
        array('comments'=>$comments,'obj_id'=>$model->id,'obj_type'=>$model->obj_type,'author_id'=>$model->user_id))?>
</div>
