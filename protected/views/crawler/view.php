<?php
/* @var $this CrawlerController */
/* @var $model Crawler */

$this->breadcrumbs=array(
	'Crawlers'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Crawler', 'url'=>array('index')),
	array('label'=>'Create Crawler', 'url'=>array('create')),
	array('label'=>'Update Crawler', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Crawler', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Crawler', 'url'=>array('admin')),
);
?>

<h1>View Crawler #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'description',
		'site',
		'list',
		'detail',
		'detail_title',
		'detail_content',
		'detail_cover',
		'detail_tags',
		'user_id',
		'create_time',
		'last_update',
	),
)); ?>
