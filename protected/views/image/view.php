<?php
/* @var $this ImageController */
/* @var $model Image */

$this->breadcrumbs=array(
	'Images'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Image', 'url'=>array('index')),
	array('label'=>'Add Image', 'url'=>array('addimage','id'=>$model->id)),
	array('label'=>'Update Image', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Image', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Image', 'url'=>array('admin')),
);
?>

<h1>图片集 #<?php echo $model->title; ?></h1>

<div class="header">
    由<?php echo $model->user->name;?>创建于<i><?php echo date('Y-m-d H:i:s',$model->create_time)?></i>
</div>

<div class="content">

</div>

<div class="footer">
    标签：<?php echo $model->tags;?>
</div>
